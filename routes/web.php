<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Http\Controllers\JobController;

//Route::get('/', function () {
 //   return view('home');
//});
Route::get('test',function(){
    return new \App\Mail\JobPosted();
});

Route::view('/','home');
Route::view('/about','about');

/**Route::controller(JobController::class)->group(function(){
    Route::get('/jobs',[JobController::class,'index']);
    Route::get('/jobs/create',[JobController::class,'create']);
    Route::get('/jobs/{job}', [JobController::class,'show']);
    Route::get('/jobs/{job}/edit', [JobController::class,'edit']);
    Route::post('/jobs',[JobController::class,'store']);
    Route::patch('/jobs/{job}',[JobController::class,'update']);
    Route::delete('/jobs/{job}',[JobController::class,'destroy']);
});**/

//REFER TO LESSON 19 FOR MORE INFO
Route::resource('job',JobController::class);
//USED IN CASE YOU DON'T WANT TO USE ALL THE RESOURCE CONTROLLER ACTIONS
/**Route::resource('jobs',JobController::class,[
    'except'=>['edit']
]);
**/

 