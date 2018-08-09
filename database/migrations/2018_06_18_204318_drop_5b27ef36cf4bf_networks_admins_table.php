<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Drop5b27ef36cf4bfNetworksAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('networks_admins');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasTable('networks_admins')) {
            Schema::create('networks_admins', function (Blueprint $table) {
                $table->increments('id');
                $table->string('network')->nullable();
                $table->string('network_affiliate')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }
}
