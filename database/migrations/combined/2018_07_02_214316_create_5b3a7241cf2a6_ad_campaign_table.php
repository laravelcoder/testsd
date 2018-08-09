<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Create5b3a7241cf2a6AdCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ad_campaign')) {
            Schema::create('ad_campaign', function (Blueprint $table) {
                $table->integer('ad_id')->unsigned()->nullable();
                $table->foreign('ad_id', 'fk_p_171266_178203_campai_5b3a7241cf3bd')->references('id')->on('ads')->onDelete('cascade');
                $table->integer('campaign_id')->unsigned()->nullable();
                $table->foreign('campaign_id', 'fk_p_178203_171266_ad_cam_5b3a7241cf450')->references('id')->on('campaigns')->onDelete('cascade');
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
