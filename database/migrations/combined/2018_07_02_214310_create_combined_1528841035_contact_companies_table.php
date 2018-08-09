<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCombined1528841035ContactCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('contact_companies')) {
            Schema::create('contact_companies', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('address')->nullable();
                $table->string('website')->nullable();
                $table->string('email')->nullable();
                $table->string('address2')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('zipcode')->nullable();
                $table->string('country')->nullable();
                $table->string('logo')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_companies');
    }
}
