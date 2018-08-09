<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b27eeeee3605RelationshipsToNetworksAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('networks_admins', function(Blueprint $table) {
            if (!Schema::hasColumn('networks_admins', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '173671_5b27eee9cd7f8')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('networks_admins', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '173671_5b27eee9e3a1c')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('networks_admins', function(Blueprint $table) {
            
        });
    }
}
