<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Add5b240840b2de7RelationshipsToPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phones', function (Blueprint $table) {
            if (!Schema::hasColumn('phones', 'advertiser_id')) {
                $table->integer('advertiser_id')->unsigned()->nullable();
                $table->foreign('advertiser_id', '172407_5b2407a577d6d')->references('id')->on('contacts')->onDelete('cascade');
            }
            if (!Schema::hasColumn('phones', 'agent_id')) {
                $table->integer('agent_id')->unsigned()->nullable();
                $table->foreign('agent_id', '172407_5b2407a5900ca')->references('id')->on('agents')->onDelete('cascade');
            }
            if (!Schema::hasColumn('phones', 'advertisers_id')) {
                $table->integer('advertisers_id')->unsigned()->nullable();
                $table->foreign('advertisers_id', '172407_5b24083b95079')->references('id')->on('contact_companies')->onDelete('cascade');
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
        Schema::table('phones', function (Blueprint $table) {
        });
    }
}
