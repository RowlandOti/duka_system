<?php

namespace App\Listeners;

use Tenancy\Affects\Cache\Events\ConfigureCache;

class ConfigureTenantCache
{
    public function handle(ConfigureCache $event)
    {
        if ($event->event->tenant) {
            $event->config = [
                'driver' => 'database',
                'table' => 'cache',
                'connection' => 'tenant'
            ];

            $event->config = [
                'driver' => 'file',
                'path' => storage_path('framework/cache/data/' . $event->event->tenant->getTenantKey()),
            ];
        }
    }
}