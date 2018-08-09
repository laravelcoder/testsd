<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1529433903AgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            if(Schema::hasColumn('agents', 'phone1')) {
                $table->dropColumn('phone1');
            }
            if(Schema::hasColumn('agents', 'phone2')) {
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
        Schema::table('agents', function (Blueprint $table) {
                        $table->string('phone1')->nullable();
                $table->string('phone2')->nullable();
                
        });

    }
}
