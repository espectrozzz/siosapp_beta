<?php

namespace App\Providers;

use App\Events\TecnicoEvent;
use App\Listeners\TecnicoListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TecnicoEvent::class =>[
            TecnicoListener::class,
        ],
        'App\Events\LoginEvent' => [
            'App\Listeners\LoginListener',
        ],
        'App\Events\LogoutEvent' => [
            'App\Listeners\LogoutListener',
        ],
        'App\Events\UpdateTecnicoEvent' => [
            'App\Listeners\UpdateTecnicoListener'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
