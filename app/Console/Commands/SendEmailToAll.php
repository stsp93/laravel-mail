<?php

namespace App\Console\Commands;

use App\Mail\NotificationEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailToAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email-to-all';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to all registered users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all(); 
        $title = $this->ask('Enter the email subject:');
        $content = $this->ask('Enter the email content:');

        

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotificationEmail($title, $content)); 
        }
    
        $this->info('Emails sent to all users successfully.');
    }
}
