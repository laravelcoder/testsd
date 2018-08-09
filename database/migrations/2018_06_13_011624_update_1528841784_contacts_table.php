<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Update1528841784ContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (Schema::hasColumn('contacts', 'address2')) {
                $table->dropColumn('address2');
            }
            if (Schema::hasColumn('contacts', 'city')) {
                $table->dropColumn('city');
            }
            if (Schema::hasColumn('contacts', 'state')) {
                $table->dropColumn('state');
            }
            if (Schema::hasColumn('contacts', 'zipcode')) {
                $table->dropColumn('zipcode');
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
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
        });
    }
}
