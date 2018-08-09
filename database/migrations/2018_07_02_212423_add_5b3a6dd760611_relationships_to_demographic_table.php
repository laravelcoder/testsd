<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Add5b3a6dd760611RelationshipsToDemographicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demographics', function (Blueprint $table) {
            if (!Schema::hasColumn('demographics', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '172411_5b240d59608cf')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('demographics', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '172411_5b240d597ad8b')->references('id')->on('teams')->onDelete('cascade');
            }
            if (!Schema::hasColumn('demographics', 'advertiser_id')) {
                $table->integer('advertiser_id')->unsigned()->nullable();
                $table->foreign('advertiser_id', '172411_5b240f2435ca8')->references('id')->on('contact_companies')->onDelete('cascade');
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
        Schema::table('demographics', function (Blueprint $table) {
        });
    }
}
