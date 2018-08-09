<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Add5b241025239bdRelationshipsToAudienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audiences', function (Blueprint $table) {
            if (!Schema::hasColumn('audiences', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '172410_5b240a29d1490')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('audiences', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '172410_5b240a29e59d9')->references('id')->on('teams')->onDelete('cascade');
            }
            if (!Schema::hasColumn('audiences', 'advertiser_id')) {
                $table->integer('advertiser_id')->unsigned()->nullable();
                $table->foreign('advertiser_id', '172410_5b240ef09f3df')->references('id')->on('contact_companies')->onDelete('cascade');
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
        Schema::table('audiences', function (Blueprint $table) {
        });
    }
}
