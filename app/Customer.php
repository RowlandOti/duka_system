<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Tenancy\Identification\Concerns\AllowsTenantIdentification;
use Tenancy\Identification\Contracts\Tenant;
use Tenancy\Identification\Drivers\Http\Contracts\IdentifiesByHttp;
use Tenancy\Tenant\Events;

/**
 *
 *
 */

class Customer extends Model implements Tenant, IdentifiesByHttp
{
    use AllowsTenantIdentification;

    protected $dispatchesEvents = [
        'created' => Events\Created::class,
        'updated' => Events\Updated::class,
        'deleted' => Events\Deleted::class,
    ];

    /**
     * Specify whether the tenant model is matching the request. Customer model has an extra
     * column for a id the user is configured to use.
     *
     * @param Request $request
     * @return Tenant
     */
    public function tenantIdentificationByHttp(Request $request): ?Tenant
    {
        $customerId  = $request->route('customer');

        return $this->query()
            ->where('id', $customerId)
            ->first();
    }

    public function route($name, $parameters = [], $absolute = true) {
        return app('url')->route($name, array_merge([$this->id], $parameters), $absolute);
    }
}