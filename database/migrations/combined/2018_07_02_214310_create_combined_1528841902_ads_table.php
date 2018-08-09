<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCombined1528841902AdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ads')) {
            Schema::create('ads', function (Blueprint $table) {
                $table->increments('id');
                $table->string('ad_label');
                $table->text('ad_description')->nullable();
                $table->string('video_upload')->nullable();
                $table->integer('total_impressions')->nullable();
                $table->integer('total_networks')->nullable();
                $table->integer('total_channels')->nullable();
                $table->string('video_screenshot')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('ads');
    }
}
