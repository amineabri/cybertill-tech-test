<?php

namespace Infrastructure\Providers;

use Illuminate\Database\Events\MigrationsEnded;
use Infrastructure\Listeners\ImportRequestsListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array $listen
     */
    protected $listen = [
        MigrationsEnded::class => [
            ImportRequestsListener::class,
        ],
    ];
}
