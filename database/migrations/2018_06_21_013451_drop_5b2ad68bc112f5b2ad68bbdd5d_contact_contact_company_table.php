<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b2ad68bc112f5b2ad68bbdd5dContactContactCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('contact_contact_company');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('contact_contact_company')) {
            Schema::create('contact_contact_company', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('contact_id')->unsigned()->nullable();
            $table->foreign('contact_id', 'fk_p_171257_171256_contac_5b240b1b25c51')->references('id')->on('contacts');
                $table->integer('contact_company_id')->unsigned()->nullable();
            $table->foreign('contact_company_id', 'fk_p_171256_171257_contac_5b240b1b24a0d')->references('id')->on('contact_companies');
                
                $table->timestamps();
                
            });
        }
    }
}
