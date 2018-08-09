<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Add5b29515a44c8bRelationshipsToPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phones', function (Blueprint $table) {
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
        Schema::table('phones', function (Blueprint $table) {
        });
    }
}
