<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
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
        return view('jobs.edit',['job' => $job]);
    }

    public function destroy(Job $job){
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
        Job::create([
            'title'=>request('title'),//these attributes are defined in the name attribute of the input tag.
            'salary'=>request('salary'),
            'employer_id'=>1
        ]);
        return redirect('/jobs');
    }
}
