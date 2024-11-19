<?php

namespace App\Http\Controllers;

use App\Mail\JobApproved;
use Illuminate\Http\Request;
use App\Mail\JobPosted;
use App\Mail\Response;
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

    public function devicesearch(Request $request)
    {
        $query=$request->input('query');
        $results=Job::with('employer')->where('device_model','like', '%'.$query.'%')->get();
        return view('search.results',[
            'results'=> $results
        ]);
    }
    public function companysearch(Request $request)
    {
        $query=$request->input('query2');
        $results=Employer::with('jobs')->where('employer_name','like', '%'.$query.'%')->get();
        return view('search.results2',[
            'results'=> $results
        ]);
    }

    public function search2(Request $request)
    {
        $query=$request->input('query2');
        $results=Job::with('Employer')
        ->where('organization','like', '%'.$query.'%')
        ->get();
        return view('search.results',[
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
            'approval'=>request('approval')
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
        $user_id=Auth::user()->id;
        $email=Auth::user()->email;
    
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
}
