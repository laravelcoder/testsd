<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Drop5b353dc50f86f5b353dc503857NetworkProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('network_provider');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasTable('network_provider')) {
            Schema::create('network_provider', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('network_id')->unsigned()->nullable();
                $table->foreign('network_id', 'fk_p_173673_173674_provid_5b353cd4cd64c')->references('id')->on('networks');
                $table->integer('provider_id')->unsigned()->nullable();
                $table->foreign('provider_id', 'fk_p_173674_173673_networ_5b353cd4d210f')->references('id')->on('providers');

                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
