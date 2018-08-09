<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1529088790ContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            if(Schema::hasColumn('contacts', 'phone1')) {
                $table->dropColumn('phone1');
            }
            if(Schema::hasColumn('contacts', 'phone2')) {
                $table->dropColumn('phone2');
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
        Schema::table('contacts', function (Blueprint $table) {
                        $table->string('phone1')->nullable();
                $table->string('phone2')->nullable();
                
        });

    }
}
