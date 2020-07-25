<?php

namespace App\Listeners;

use Tenancy\Affects\Logs\Events\ConfigureLogs;

class ConfigureTenantLogs
{
    public function handle(ConfigureLogs $event)
    {
       /* $event->config = [
            'driver' => 'slack',
            'url' => $event->event->tenant->slack_webhook_url,
            'username' => 'Tenant Logs',
            'emoji' => ':boom:',
            'level' => 'critical',
        ];*/
    }
}