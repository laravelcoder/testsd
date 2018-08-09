<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b6352871201aRelationshipsToStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stations', function(Blueprint $table) {
            if (!Schema::hasColumn('stations', 'affiliate_id')) {
                $table->integer('affiliate_id')->unsigned()->nullable();
                $table->foreign('affiliate_id', '173675_5b353fcf1a889')->references('id')->on('affiliates')->onDelete('cascade');
                }
                if (!Schema::hasColumn('stations', 'network_id')) {
                $table->integer('network_id')->unsigned()->nullable();
                $table->foreign('network_id', '173675_5b353fcf564d8')->references('id')->on('networks')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stations', function(Blueprint $table) {
            if(Schema::hasColumn('stations', 'affiliate_id')) {
                $table->dropForeign('173675_5b353fcf1a889');
                $table->dropIndex('173675_5b353fcf1a889');
                $table->dropColumn('affiliate_id');
            }
            if(Schema::hasColumn('stations', 'network_id')) {
                $table->dropForeign('173675_5b353fcf564d8');
                $table->dropIndex('173675_5b353fcf564d8');
                $table->dropColumn('network_id');
            }
            
        });
    }
}
