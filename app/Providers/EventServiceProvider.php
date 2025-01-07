<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\MailEvent'::class => [
            'App\Listeners\SendEmail'::class,
        ],
        
        '\App\Events\NewCourrierAddedEvent'::class => [
            '\App\Listeners\NotifyUsersOnNewCourrier'::class,
        ],
        
        '\App\Events\NewCourrierSortantEvent'::class => [
            '\App\Listeners\NotifyUsersOnNewCourrierSortant'::class,
        ],
        
        '\App\Events\UpdateCourrierAddedEvent'::class => [
            '\App\Listeners\NotifyUsersOnUpdateCourrierAdded'::class,
        ],
        
        '\App\Events\UpdateCourrierSortantEvent'::class => [
            '\App\Listeners\NotifyUsersOnUpdateCourrierSortant'::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
