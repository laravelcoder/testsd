<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Add5b3a723e8f8d8RelationshipsToContactCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_companies', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_companies', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '171256_5b2044781ad58')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('contact_companies', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '171256_5b20447831503')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('contact_companies', function (Blueprint $table) {
            if (Schema::hasColumn('contact_companies', 'created_by_id')) {
                $table->dropForeign('171256_5b2044781ad58');
                $table->dropIndex('171256_5b2044781ad58');
                $table->dropColumn('created_by_id');
            }
            if (Schema::hasColumn('contact_companies', 'created_by_team_id')) {
                $table->dropForeign('171256_5b20447831503');
                $table->dropIndex('171256_5b20447831503');
                $table->dropColumn('created_by_team_id');
            }
        });
    }
}
