<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1530217625CampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            if(Schema::hasColumn('campaigns', 'advertiser_id')) {
                $table->dropForeign('178203_5b35431297d6e');
                $table->dropIndex('178203_5b35431297d6e');
                $table->dropColumn('advertiser_id');
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
        Schema::table('campaigns', function (Blueprint $table) {
                        
        });

    }
}
