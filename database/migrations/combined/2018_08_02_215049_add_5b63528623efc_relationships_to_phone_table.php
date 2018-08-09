<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b63528623efcRelationshipsToPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phones', function(Blueprint $table) {
            if (!Schema::hasColumn('phones', 'contact_id')) {
                $table->integer('contact_id')->unsigned()->nullable();
                $table->foreign('contact_id', '172407_5b295154dc18e')->references('id')->on('contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('phones', 'advertiser_id')) {
                $table->integer('advertiser_id')->unsigned()->nullable();
                $table->foreign('advertiser_id', '172407_5b2407a577d6d')->references('id')->on('contact_companies')->onDelete('cascade');
                }
                if (!Schema::hasColumn('phones', 'agent_id')) {
                $table->integer('agent_id')->unsigned()->nullable();
                $table->foreign('agent_id', '172407_5b2407a5900ca')->references('id')->on('agents')->onDelete('cascade');
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
        Schema::table('phones', function(Blueprint $table) {
            if(Schema::hasColumn('phones', 'contact_id')) {
                $table->dropForeign('172407_5b295154dc18e');
                $table->dropIndex('172407_5b295154dc18e');
                $table->dropColumn('contact_id');
            }
            if(Schema::hasColumn('phones', 'advertiser_id')) {
                $table->dropForeign('172407_5b2407a577d6d');
                $table->dropIndex('172407_5b2407a577d6d');
                $table->dropColumn('advertiser_id');
            }
            if(Schema::hasColumn('phones', 'agent_id')) {
                $table->dropForeign('172407_5b2407a5900ca');
                $table->dropIndex('172407_5b2407a5900ca');
                $table->dropColumn('agent_id');
            }
            
        });
    }
}
