<?php

namespace App\Http\Controllers;

use App\Mail\JobApproved;
use Illuminate\Http\Request;
use App\Mail\JobPosted;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use App\Models\Job;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Jobs\SendMailJob;



class JobController extends Controller
{
    public function index(){
        $jobs=Job::with('employer')->latest()->paginate(4);

        return view('jobs.index', [
            'jobs' => $jobs
    ]);
    }

    
    public function employer_index(){
        $employer=Employer::where('user_id',Auth::id())->first();
        if($employer){
            $jobs=Job::where('employer_id',$employer->id)
            ->with('employer')
            ->latest()
            ->paginate(4);
        }

        return view('jobs.index',[
            'jobs'=>$jobs
        ]);
    }

    public function employee_index(){
        $user_id=Auth::id();
        $jobs=Job::where('user_id',$user_id)
            ->with('employer')
            ->latest()
            ->paginate(4);
            
       
        return view('jobs.index',[
            'jobs'=>$jobs
        ]);
    }
    
    public function devicesearch(Request $request)
    {
        $query=$request->input('query');
        $results=Job::with('employer')->where('device_model','like', '%'.$query.'%')->get();
        return view('search.results',[
            'results'=> $results
        ]);
    }
    public function billed_jobs()
    {
        $employer=Employer::where('user_id',Auth::user()->id)->first();
        if($employer) {
            $jobs=Job::where('repair_status','repaired');
        }
        return view('billing.billing',['jobs'=>$jobs]);
    }


    public function companysearch(Request $request)
    {
        $query=$request->input('query2');
        $results=Employer::with('jobs')->where('employer_name','like', '%'.$query.'%')->get();
        return view('search.results2',[
            'results'=> $results
        ]);
    }
 

    public function create(){
        return view('jobs.create');
    }

    public function show(Job $job){
        return view('jobs.show',['job' => $job]);
    }



    public function edit(Job $job){

    /**  DEFINED IT IN THE APPSERVICE PROVIDER FOR GLOBAL ACCESS
    *    Gate::define('edit-job',function(User $user, Job $job){
    *          return $job->employer->user->is($user);
    *      });//checks if the authorized user is the currently logged in user.
    */
    //THE GATE FACADE IMPLICITLY DOES THIS, ITS DOESN'T NEED TO BE DEFINED EXPLICITLY WHEN DALING WITH GATES.
    /**  if (Auth::guest()) {
    *        redirect('/login');
    *}
    */

/**
 *      if($job->employer->user->isNot(Auth::user())){
 *          abort(403);
 *       }
 */
 
       Gate::authorize('respond-job',$job);
       //automatically generates the 403 error page if false.
 


       //if(Gate::allows/denies('edit-job',$job)){
            //user defined response. Might be a custom error page or a redirect
        //};

        return view('jobs.edit',['job' => $job]);
    }

    public function destroy(Job $job){
        Gate::authorize('delete-job');
        $job->delete();
        return redirect('/jobs'); 
    }

    public function update(Job $job){
     
        request()->validate([
            'device_model'=>['required','min:3'],  
            'issue'=>['required']
        ]);
    
        $job->update([
            'device_model'=>request('device_model'),
            'issue'=>request('issue'),
            'response'=>request('response'),
            'billing'=>request('billing'),
            'approval'=>request('approval'),
            'repair_status'=>request('repair_status')
        ]);

        $user_mail=$job->employer->user->email;
        if($job['response'] !== null && $job['approval']!== 'approved'){
            SendMailJob::dispatch($user_mail,$job);
        }
        elseif($job['approval']==='approved'){
            Mail::to('admin101@gmail.com')
            ->queue(new JobApproved($job));
        }

        
    
        return redirect('/jobs/'.$job->id)->with('success','Job status has been successfully updated.'); 

    }
    public function store(){
        request()->validate([
            'device_model'=>['required','min:3'],  
            'issue'=>['required']
        ]);
        $user_id=Auth::id();
        $email=Auth::email();
    
        $domain = substr(strrchr($email, "@"), 1);
        $employerId = null;
        if($domain === 'wfp.org'){
            $employerId = 1;
        }elseif($domain === 'un.org'){
            $employerId = 4;
        }elseif($domain === 'gmail.com'){
            $employerId = 3;
            }
      
        
        
        $job=Job::create([
            'device_model'=>request('device_model'),//these attributes are defined in the name attribute of the input tag.
            'issue'=>request('issue'),
            'employer_id'=>$employerId,
            'user_id'=>$user_id
        ]);

       //sect 1//$user_mails=User::all()->pluck('email')->toArray();
     
        /**Mail::to($job->employer->user)->send(
        *   new JobPosted($job)
        *);
        **/
        
        
        
        Mail::to($email)->queue(
            new JobPosted($job)
        );
        

        //sect1//SendMailJob::dispatch($user_mails,$job);
    
        return redirect('/')->with('success', 'Job has been successfully posted for review');

    }
    public function view_billings()
    {
        $employer=Employer::where('user_id',Auth::user()->id)->first();
        if($employer)
        {
          $jobs=Job::where('repair_status','repaired')->get();
        }

        return view('billing.billing',[
            'jobs'=>$jobs,
            'employer'=>$employer
        ]);
    }
}
