<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1529087548CategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            if(Schema::hasColumn('categories', 'created_by_id')) {
                $table->dropForeign('172406_5b24056e0b34c');
                $table->dropIndex('172406_5b24056e0b34c');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('categories', 'created_by_team_id')) {
                $table->dropForeign('172406_5b24056e20a36');
                $table->dropIndex('172406_5b24056e20a36');
                $table->dropColumn('created_by_team_id');
            }
            
        });
Schema::table('categories', function (Blueprint $table) {
            
if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->nullable();
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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug');
            
        });
Schema::table('categories', function (Blueprint $table) {
                        
        });

    }
}
