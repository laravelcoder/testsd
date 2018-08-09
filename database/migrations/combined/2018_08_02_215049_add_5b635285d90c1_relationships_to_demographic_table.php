<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b635285d90c1RelationshipsToDemographicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demographics', function(Blueprint $table) {
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
        Schema::table('demographics', function(Blueprint $table) {
            if(Schema::hasColumn('demographics', 'created_by_id')) {
                $table->dropForeign('172411_5b240d59608cf');
                $table->dropIndex('172411_5b240d59608cf');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('demographics', 'created_by_team_id')) {
                $table->dropForeign('172411_5b240d597ad8b');
                $table->dropIndex('172411_5b240d597ad8b');
                $table->dropColumn('created_by_team_id');
            }
            if(Schema::hasColumn('demographics', 'advertiser_id')) {
                $table->dropForeign('172411_5b240f2435ca8');
                $table->dropIndex('172411_5b240f2435ca8');
                $table->dropColumn('advertiser_id');
            }
            
        });
    }
}
