<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\JobPosted;
use Illuminate\Support\Facades\Mail;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;



class JobController extends Controller
{
    public function index(){
        $jobs=Job::with('employer')->latest()->paginate(4);

        return view('jobs.index', [
            'jobs' => $jobs
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
 
       Gate::authorize('edit-job',$job);
       //automatically generates the 403 error page if false.
 


       //if(Gate::allows/denies('edit-job',$job)){
            //user defined response. Might be a custom error page or a redirect
        //};

        return view('jobs.edit',['job' => $job]);
    }

    public function destroy(Job $job){
        Gate::authorize('delete-job',$job);
        $job->delete();
        return redirect('/jobs'); 
    }

    public function update(Job $job){
        request()->validate([
            'title'=>['required','min:3'],  
            'salary'=>['required','integer']
        ]);
    
        $job->update([
            'title'=>request('title'),
            'salary'=>request('salary')
        ]);
    
        return redirect('/jobs/'.$job->id); 

    }
    public function store(){
        request()->validate([
            'title'=>['required','min:3'],  
            'salary'=>['required','integer']
        ]);
        $job=Job::create([
            'title'=>request('title'),//these attributes are defined in the name attribute of the input tag.
            'salary'=>request('salary'),
            'employer_id'=>1
        ]);

       $user_mails=User::all()->pluck('email');
     
        /**Mail::to($job->employer->user)->send(
        *   new JobPosted($job)
        *);
        **/
        
        Mail::to($user_mails)->send(
            new JobPosted($job)
        );
         
    
        return redirect('/jobs');
    }
}
