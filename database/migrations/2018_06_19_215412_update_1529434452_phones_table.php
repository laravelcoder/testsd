<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1529434452PhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phones', function (Blueprint $table) {
            if(Schema::hasColumn('phones', 'advertiser_id')) {
                $table->dropForeign('172407_5b2407a577d6d');
                $table->dropIndex('172407_5b2407a577d6d');
                $table->dropColumn('advertiser_id');
            }
            if(Schema::hasColumn('phones', 'agent_id')) {
                $table->dropForeign('172407_5b2407a5900ca');
                $table->dropIndex('172407_5b2407a5900ca');
                $table->dropColumn('agent_id');
            }
            if(Schema::hasColumn('phones', 'advertisers_id')) {
                $table->dropForeign('172407_5b24083b95079');
                $table->dropIndex('172407_5b24083b95079');
                $table->dropColumn('advertisers_id');
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
