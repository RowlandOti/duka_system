<?php

namespace App\Listeners;

use Tenancy\Hooks\Migration\Events\ConfigureSeeds;
use Tenancy\Tenant\Events\Created;

class ConfigureTenantSeeds
{
    public function handle(ConfigureSeeds $event)
    {
        if ($event->event instanceof Created) {
            $event->seed(\RolesAndPermissionsSeeder::class);
        }
    }
}