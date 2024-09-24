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
    $jobs=Job::with('employer')->latest()->paginate(4);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/create',function(){
    return view('jobs.create');

});


Route::get('/jobs/{id}', function($id){

        $job = Job::find($id);
        return view('jobs.show',['job' => $job]);
    });


Route::get('/jobs/{id}/edit', function($id){

    $job = Job::find($id);
    return view('jobs.edit',['job' => $job]);
});






Route::post('/jobs',function(){
    //dd(request()->all());confirms the request attributes.
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
});


    
Route::patch('/jobs/{id}',function($id){
    //dd(request()->all());confirms the request attributes.
    request()->validate([
        'title'=>['required','min:3'],  
        'salary'=>['required','integer']
    ]);

    $job=Job::findorFail($id);

    $job->update([
        'title'=>request('title'),
        'salary'=>request('salary')
    ]);

    return redirect('/jobs/'.$job->id); 
});


   
Route::delete('/jobs/{id}',function($id){
    //dd(request()->all());confirms the request attributes.
    Job::findorFail($id)->delete();

    return redirect('/jobs'); 
});
    


 