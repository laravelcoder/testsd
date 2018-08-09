<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b353cd4d7922NetworkProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('network_provider')) {
            Schema::create('network_provider', function (Blueprint $table) {
                $table->integer('network_id')->unsigned()->nullable();
                $table->foreign('network_id', 'fk_p_173673_173674_provid_5b353cd4d7a5e')->references('id')->on('networks')->onDelete('cascade');
                $table->integer('provider_id')->unsigned()->nullable();
                $table->foreign('provider_id', 'fk_p_173674_173673_networ_5b353cd4d7b07')->references('id')->on('providers')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_provider');
    }
}
