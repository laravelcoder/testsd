<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b635285235a1RelationshipsToContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function(Blueprint $table) {
            if (!Schema::hasColumn('contacts', 'company_id')) {
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', '171257_5b204360a2f55')->references('id')->on('contact_companies')->onDelete('cascade');
                }
                if (!Schema::hasColumn('contacts', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '171257_5b20458519095')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('contacts', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '171257_5b20458531614')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('contacts', function(Blueprint $table) {
            if(Schema::hasColumn('contacts', 'company_id')) {
                $table->dropForeign('171257_5b204360a2f55');
                $table->dropIndex('171257_5b204360a2f55');
                $table->dropColumn('company_id');
            }
            if(Schema::hasColumn('contacts', 'created_by_id')) {
                $table->dropForeign('171257_5b20458519095');
                $table->dropIndex('171257_5b20458519095');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('contacts', 'created_by_team_id')) {
                $table->dropForeign('171257_5b20458531614');
                $table->dropIndex('171257_5b20458531614');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
