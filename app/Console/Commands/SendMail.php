<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\Newsletter;
use App\Models\Newsletter as Newletter;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Send:Mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to all users about a fruit and its benefit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $words = [
            'orange' => 'vitamin c',
            'Mango' => 'protect the body from chronic diseases,',
            'Apple' => 'rich in fiber',
            'Blueberries' => 'Anti Oxidant',
            'Banana' => 'they’re high in prebiotics'
        ];
         
        // Finding a random word
        $key = array_rand($words);
        $value = $words[$key];
         
        $users = Newletter::all();
        foreach ($users as $user) {
            Mail::raw("{$key} -> {$value}", function ($mail) use ($user) {
                $mail->from('peaceoariyo@gmail.com');
                $mail->to($user->email)
                    ->subject('Benefits of fruit');
            });
        }
         
        $this->info('Fruit of the Day sent to All Users');

        return 0;
    }
}
