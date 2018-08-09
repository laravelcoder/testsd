<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b635287553aeAdCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('ad_campaign')) {
            Schema::create('ad_campaign', function (Blueprint $table) {
                $table->integer('ad_id')->unsigned()->nullable();
                $table->foreign('ad_id', 'fk_p_171266_178203_campai_5b635287554b5')->references('id')->on('ads')->onDelete('cascade');
                $table->integer('campaign_id')->unsigned()->nullable();
                $table->foreign('campaign_id', 'fk_p_178203_171266_ad_cam_5b63528755539')->references('id')->on('campaigns')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_campaign');
    }
}
