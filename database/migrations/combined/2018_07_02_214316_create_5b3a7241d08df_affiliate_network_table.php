<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Create5b3a7241d08dfAffiliateNetworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('affiliate_network')) {
            Schema::create('affiliate_network', function (Blueprint $table) {
                $table->integer('affiliate_id')->unsigned()->nullable();
                $table->foreign('affiliate_id', 'fk_p_178710_173673_networ_5b3a7241d0aae')->references('id')->on('affiliates')->onDelete('cascade');
                $table->integer('network_id')->unsigned()->nullable();
                $table->foreign('network_id', 'fk_p_173673_178710_affili_5b3a7241d0b7f')->references('id')->on('networks')->onDelete('cascade');
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
        Schema::dropIfExists('affiliate_network');
    }
}
