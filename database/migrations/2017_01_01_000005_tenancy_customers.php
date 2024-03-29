<?php

/*
 * This file is part of the hyn/multi-tenant package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://tenancy.dev
 * @see https://github.com/hyn/multi-tenant
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TenancyCustomers extends Migration
{
    protected $system = true;

    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->string('subdomain')->unique();
            $table->string('domain')->unique();
            $table->string('redirect_to')->nullable();
            $table->boolean('force_https')->default(false);
            $table->timestamp('under_maintenance_since')->nullable();
            $table->bigInteger('website_id')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('website_id')->references('id')->on('websites')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
