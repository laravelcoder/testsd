<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Add5b353bc759990RelationshipsToAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            if (!Schema::hasColumn('agents', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '171264_5b2045fa58776')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('agents', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '171264_5b2045fa6e319')->references('id')->on('teams')->onDelete('cascade');
            }
            if (!Schema::hasColumn('agents', 'advertiser_id')) {
                $table->integer('advertiser_id')->unsigned()->nullable();
                $table->foreign('advertiser_id', '171264_5b353bc6d4cc2')->references('id')->on('contact_companies')->onDelete('cascade');
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
        Schema::table('agents', function (Blueprint $table) {
        });
    }
}
