<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Update1528841604ContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('contacts', 'address2')) {
                $table->string('address2')->nullable();
            }
            if (!Schema::hasColumn('contacts', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('contacts', 'state')) {
                $table->string('state')->nullable();
            }
            if (!Schema::hasColumn('contacts', 'zipcode')) {
                $table->string('zipcode')->nullable();
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
            $table->dropColumn('address2');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('zipcode');
        });
    }
}
