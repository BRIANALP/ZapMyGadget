<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

//Route::get('/job', function () {//function to be returned on visiting the about/on getting a get request to the about page, trigger the function.
//   return 'Jobs page';
//});//we return ARRAYS AND STRINGS INSTEAD OF VIEWS WHEN HANDLING APIS

Route::get('/jobs',function (){
    $jobs=Job::with('employer')->paginate(4);

    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function($id){

        $job = Job::find($id);
        return view('job',['job' => $job]);//return job and pass through our job to the view $job i.e job.blade.php
    });
    


 