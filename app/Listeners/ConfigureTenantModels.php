<?php

namespace App\Listeners;

use Laravel\Passport\AuthCode;
use Laravel\Passport\Client;
use Laravel\Passport\PersonalAccessClient;
use Laravel\Passport\Token;

use Tenancy\Affects\Models\Events\ConfigureModels;
use Tenant\Affects\ConnectionResolver;

class ConfigureTenantModels
{

    protected $models = [
        'passportClient' => Client::class,
        'passportToken' => Token::class,
        'passportAuthCode' => AuthCode::class,
        'passportAccessClient' => PersonalAccessClient::class,
    ];

    public function handle(ConfigureModels $event)
    {
        if ($event->event->tenant) {
            foreach ($this->models as $model) {
                ConfigureModels::setConnectionResolver($model, new ConnectionResolver('tenant', resolve('db')));
            }
        }
    }
}