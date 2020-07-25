<?php

namespace App\Listeners;

use App\User;
use Tenancy\Affects\Connections\ConnectionResolver;
use Tenancy\Affects\Models\Events\ConfigureModels;

class ConfigureTenantModels
{
    protected $model = User::class;

    public function handle(ConfigureModels $event)
    {
        /*if($event->event->tenant)
        {
            ConfigureModels::setConnectionResolver(
                $this->model,
                new ConnectionResolver('sqlite', resolve('db'))
            );
        }*/
    }
}