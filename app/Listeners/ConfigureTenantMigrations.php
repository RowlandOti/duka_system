<?php

namespace App\Listeners;

use Tenancy\Hooks\Migration\Events\ConfigureMigrations;
use Tenancy\Tenant\Events\Deleted;

class ConfigureTenantMigrations
{
    public function handle(ConfigureMigrations $event)
    {
        if ($event->event instanceof Deleted) {
            $event->disable();
        } else {
            $event->path(database_path('migrations/tenant'));
        }
    }
}