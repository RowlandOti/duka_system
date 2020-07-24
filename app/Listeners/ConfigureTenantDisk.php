<?php

namespace App\Listeners;

use Tenancy\Affects\Filesystems\Events\ConfigureDisk;

class ConfigureTenantDisk
{
    public function handle(ConfigureDisk $event)
    {
        if($event->event->tenant) {
            $event->config = [
                'driver' => 'local',
                'root' => storage_path('app/' . $event->event->tenant->getTenantKey()),
            ];
        }
    }
}