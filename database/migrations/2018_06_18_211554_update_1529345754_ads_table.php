<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Update1529345754AdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads', function (Blueprint $table) {
            if (!Schema::hasColumn('ads', 'video_upload')) {
                $table->string('video_upload')->nullable();
            }
            if (!Schema::hasColumn('ads', 'video_screenshot')) {
                $table->string('video_screenshot')->nullable();
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
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('video_upload');
            $table->dropColumn('video_screenshot');
        });
    }
}
