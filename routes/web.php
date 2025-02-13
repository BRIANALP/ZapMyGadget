<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SearchController;


//Route::get('/', function () {
 //   return view('home');
//});



Route::view('/','home');
Route::view('/about','about');
Route::get('/register',function(){
    return view('auth.register');
});
Route::post('/auth',function(){
    $attributes=request()->validate([
        'name'=>['required','min:3'],  
        'email'=>'email:rfc',
        'password'=>['required','confirmed',Password::min(2)]//->uncompromised()
        //->letters()
        //->numbers()
        //->symbols()
        //]
    ]);
   
    $user=User::create($attributes);
    Auth::login($user);
    return redirect('/jobs');
});

Route::get('/login',function(){
    return view('auth.login');
})->name('login');

Route::post('/session',function(){
    //validation
    $val_login_details=request()->validate([
        'email'=>['required','email'],
        'password'=>['required']
    ]);

    //Attempt to log in user
    //Auth::attempt() is a function that attempts to login the user by comparing details
    //provided and details in the database
    if(!Auth::attempt($val_login_details)){
        throw ValidationException::withMessages([
              "password"=>'Incorrect login details'
        ]);   
    }

    //regenerate session token
    request()->session()->regenerate();

    return redirect('/');
});

Route::post('/logout',function(User $user){
    Auth::logout();
    return redirect('/');
});



//AUTHORIZATION TO PERFORM PARTICULAR CONTROLLER ACTIONS 
Route::get('/jobs',[JobController::class,'index']);
Route::get('/employer_jobs',[JobController::class,'employer_index']);
Route::get('/employee_jobs',[JobController::class,'employee_index']);
Route::get('/jobs/create',[JobController::class,'create']);
Route::get('/jobs/{job}', [JobController::class,'show']);
Route::get('/devicesearch', [JobController::class, 'devicesearch']);
Route::get('/companysearch', [JobController::class, 'companysearch']);
Route::get('/jobs/{job}/edit', [JobController::class,'edit'])->middleware('auth')->can('respond-job','job');
Route::post('/jobs',[JobController::class,'store']);
Route::patch('/jobs/{job}',[JobController::class,'update']);
Route::delete('/jobs/{job}',[JobController::class,'destroy'])->middleware('auth','can:delete-job');
Route::get('/billings',[JobController::class,'billed_jobs']);
Route::get('/view_billings',[JobController::class,'view_billings']);

//or
/**Route::controller(JobController::class)->group(function(){
    Route::get('/jobs',['index']);
    Route::get('/jobs/create',['create']);
    Route::get('/jobs/{job}', ['show']);
    Route::get('/jobs/{job}/edit', ['edit'])
        ->middleware('auth')
        ->can('edit-job','job');
    Route::post('/jobs',['store']);
    Route::patch('/jobs/{job}',['update']);
    Route::delete('/jobs/{job}',['destroy']);
});**/


//REFER TO LESSON 19 FOR MORE INFO
//Route::resource('jobs',JobController::class);
//USED IN CASE YOU DON'T WANT TO USE ALL THE RESOURCE CONTROLLER ACTIONS
/**Route::resource('jobs',JobController::class,[
    'except'=>['edit']
]);
**/

 