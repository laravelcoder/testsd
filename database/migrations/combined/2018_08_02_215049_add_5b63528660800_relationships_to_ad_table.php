<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b63528660800RelationshipsToAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads', function(Blueprint $table) {
            if (!Schema::hasColumn('ads', 'advertiser_id')) {
                $table->integer('advertiser_id')->unsigned()->nullable();
                $table->foreign('advertiser_id', '171266_5b27f62d44f7c')->references('id')->on('contact_companies')->onDelete('cascade');
                }
                if (!Schema::hasColumn('ads', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '171266_5b2046b5a0c26')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('ads', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '171266_5b2046b5b6681')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('ads', function(Blueprint $table) {
            if(Schema::hasColumn('ads', 'advertiser_id')) {
                $table->dropForeign('171266_5b27f62d44f7c');
                $table->dropIndex('171266_5b27f62d44f7c');
                $table->dropColumn('advertiser_id');
            }
            if(Schema::hasColumn('ads', 'created_by_id')) {
                $table->dropForeign('171266_5b2046b5a0c26');
                $table->dropIndex('171266_5b2046b5a0c26');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('ads', 'created_by_team_id')) {
                $table->dropForeign('171266_5b2046b5b6681');
                $table->dropIndex('171266_5b2046b5b6681');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
