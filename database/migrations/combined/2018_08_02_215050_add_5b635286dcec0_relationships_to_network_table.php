<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b635286dcec0RelationshipsToNetworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('networks', function(Blueprint $table) {
            if (!Schema::hasColumn('networks', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '173673_5b27ef869be20')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('networks', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '173673_5b27ef86af608')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('networks', function(Blueprint $table) {
            if(Schema::hasColumn('networks', 'created_by_id')) {
                $table->dropForeign('173673_5b27ef869be20');
                $table->dropIndex('173673_5b27ef869be20');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('networks', 'created_by_team_id')) {
                $table->dropForeign('173673_5b27ef86af608');
                $table->dropIndex('173673_5b27ef86af608');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
