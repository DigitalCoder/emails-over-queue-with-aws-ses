<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmail;

class WelcomeController extends Controller
{
    public function pushEmail()
    {
        $hardCodedEmail = 'ivan@codingo.me';

        $job = (new SendWelcomeEmail($hardCodedEmail));

        $this->dispatch($job);

        return 'Email pushed onto queue';
    }
}