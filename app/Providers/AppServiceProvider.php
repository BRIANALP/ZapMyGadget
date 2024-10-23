<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Job;
use App\Models\User;

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

        Gate::define('edit-job',function(User $user, Job $job){//user object and job object
           $usermail="admin101@gmail.com";
           return $user->is($job->employer->user) || $user->email===$usermail;//gate to open is user related to the job is the currently logged in user
          //can also be phrased as return $job->employer->user->is($user);
        });

        Gate::define('delete-job',function(User $user){
            $usermail="admin101@gmail.com";
            return $user->email===$usermail;
        });

    }
}
