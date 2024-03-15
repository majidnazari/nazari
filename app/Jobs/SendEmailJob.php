<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

     private $client;
    public function __construct(Client $client)
    {
       $this->client=$client;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       // dd("you should send email to client:" . $this->client);
        // Logic to send the email
        //Mail::to($this->client->email)->send(new WelcomeEmail($this->client));
    }
}
