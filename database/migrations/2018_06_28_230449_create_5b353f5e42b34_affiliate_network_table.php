<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b353f5e42b34AffiliateNetworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('affiliate_network')) {
            Schema::create('affiliate_network', function (Blueprint $table) {
                $table->integer('affiliate_id')->unsigned()->nullable();
                $table->foreign('affiliate_id', 'fk_p_178710_173673_networ_5b353f5e42daa')->references('id')->on('affiliates')->onDelete('cascade');
                $table->integer('network_id')->unsigned()->nullable();
                $table->foreign('network_id', 'fk_p_173673_178710_affili_5b353f5e42e52')->references('id')->on('networks')->onDelete('cascade');
                
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
