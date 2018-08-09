<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1529088059PhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phones', function (Blueprint $table) {
            if(Schema::hasColumn('phones', 'created_by_id')) {
                $table->dropForeign('172407_5b2407a5a90c3');
                $table->dropIndex('172407_5b2407a5a90c3');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('phones', 'created_by_team_id')) {
                $table->dropForeign('172407_5b2407a5bfdd8');
                $table->dropIndex('172407_5b2407a5bfdd8');
                $table->dropColumn('created_by_team_id');
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
