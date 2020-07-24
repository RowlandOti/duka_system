<?php

namespace App\Listeners;

use Tenancy\Hooks\Database\Events\Drivers\Configuring;

class ConfigureTenantDatabase
{
    public function handle(Configuring $event)
    {
        $event->useConnection('mysql', $event->defaults($event->tenant));
    }
}