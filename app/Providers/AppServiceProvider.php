<?php

namespace App\Providers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Job;
use App\Models\User;
use App\Models\Employer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        Gate::define('edit-job',function(User $user){//user object and job object
           $usermail=['admin101@gmail.com','briantech@gmail.com','marktech@gmail.com'];
           //return $user->is($job->employer->user) || $user->email===$usermail;//gate to open is user related to the job is the currently logged in user
          //can also be phrased as return $job->employer->user->is($user);
          return in_array($user->email,$usermail);
           
        });

        Gate::define('delete-job',function(User $user){
            $usermail="admin101@gmail.com";
            return $user->email===$usermail;
        });

    
        Gate::define("post-job-only",function(User $user){
            return Gate::denies("edit-job")&&Gate::denies("is-employer")&&Gate::denies('delete-job');
        });

        

        Gate::define('respond-job',function($job){
            return Gate::allows('is-employer')||Gate::allows('edit-job',$job);
        });

        //Gate for employers
        Gate::define('is-employer', function ($user) {
            return Employer::where('user_id', $user->id)->exists();
        });

    }
}
