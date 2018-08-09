<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Update1530216397StationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stations', function (Blueprint $table) {
            if (Schema::hasColumn('stations', 'created_by_id')) {
                $table->dropForeign('173675_5b27f04181c0d');
                $table->dropIndex('173675_5b27f04181c0d');
                $table->dropColumn('created_by_id');
            }
            if (Schema::hasColumn('stations', 'created_by_team_id')) {
                $table->dropForeign('173675_5b27f0419bb2a');
                $table->dropIndex('173675_5b27f0419bb2a');
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
        Schema::table('stations', function (Blueprint $table) {
        });
    }
}
