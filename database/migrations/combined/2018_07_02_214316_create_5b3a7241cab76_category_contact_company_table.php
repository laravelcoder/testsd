<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Create5b3a7241cab76CategoryContactCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('category_contact_company')) {
            Schema::create('category_contact_company', function (Blueprint $table) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', 'fk_p_172406_171256_contac_5b3a7241cacde')->references('id')->on('categories')->onDelete('cascade');
                $table->integer('contact_company_id')->unsigned()->nullable();
                $table->foreign('contact_company_id', 'fk_p_171256_172406_catego_5b3a7241cadd0')->references('id')->on('contact_companies')->onDelete('cascade');
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
        Schema::dropIfExists('category_contact_company');
    }
}
