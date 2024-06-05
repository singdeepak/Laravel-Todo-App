<?php

use App\Mail\DemoMail;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $mailData = [
        'title' => 'I love you mala',
        'body' => 'This is your real hero using smtp while we were dyning'
    ];
    Mail::to('immrdeepaksingh@gmail.com')->send(new DemoMail($mailData));
})->everySecond();
