<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;
use App\Mail\Response;
use App\Models\Job;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_mail;
    protected $jobListing;

    /**
     * Create a new job instance.
     *
     * @param  string  $user_mail
     * @param  \App\Models\Job  $job
     */
    public function __construct(string $user_mail, Job $jobListing)
    {
        $this->user_mail = $user_mail;
        $this->jobListing = $jobListing;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send the email to the list of users
        Mail::to($this->user_mail)->send(
            new Response($this->jobListing)
        );
    }
}
