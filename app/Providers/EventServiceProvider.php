<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\LogUserActivity;
use App\Listeners\LogUserLogout;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            LogUserActivity::class,
        ],
        Logout::class => [
            LogUserLogout::class,
        ],
    ];
}
