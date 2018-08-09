<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Add5b2407aaf3150RelationshipsToPhoneTable extends Migration
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
            if (!Schema::hasColumn('phones', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '172407_5b2407a5a90c3')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('phones', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '172407_5b2407a5bfdd8')->references('id')->on('teams')->onDelete('cascade');
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
