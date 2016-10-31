<?php

namespace App\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;
use Log;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $events = app('events');

        //
        $events->listen(QueryExecuted::class, function (QueryExecuted $event) {

            $name = $event->connectionName;
            $sql = $event->sql;
            $binds = $event->bindings;
            $time = $event->time;
            $data = compact('name', 'sql', 'binds', 'time');

            Log::info("SQL ", $data);
        });
    }
}
