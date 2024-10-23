<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;
use App\Models\Job;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_mails;
    protected $jobListing;

    /**
     * Create a new job instance.
     *
     * @param  array  $user_mails
     * @param  \App\Models\Job  $job
     */
    public function __construct(array $user_mails, Job $jobListing)
    {
        $this->user_mails = $user_mails;
        $this->jobListing = $jobListing;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send the email to the list of users
        Mail::to($this->user_mails)->send(
            new JobPosted($this->jobListing)
        );
    }
}
