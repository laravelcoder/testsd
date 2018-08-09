<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1528841335ContactCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_companies', function (Blueprint $table) {
            
if (!Schema::hasColumn('contact_companies', 'address2')) {
                $table->string('address2')->nullable();
                }
if (!Schema::hasColumn('contact_companies', 'city')) {
                $table->string('city')->nullable();
                }
if (!Schema::hasColumn('contact_companies', 'state')) {
                $table->string('state')->nullable();
                }
if (!Schema::hasColumn('contact_companies', 'zipcode')) {
                $table->string('zipcode')->nullable();
                }
if (!Schema::hasColumn('contact_companies', 'country')) {
                $table->string('country')->nullable();
                }
if (!Schema::hasColumn('contact_companies', 'logo')) {
                $table->string('logo')->nullable();
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
            $table->dropColumn('address2');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('zipcode');
            $table->dropColumn('country');
            $table->dropColumn('logo');
            
        });

    }
}
