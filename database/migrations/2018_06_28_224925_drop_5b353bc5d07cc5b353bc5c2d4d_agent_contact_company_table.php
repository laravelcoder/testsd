<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Drop5b353bc5d07cc5b353bc5c2d4dAgentContactCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('agent_contact_company');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasTable('agent_contact_company')) {
            Schema::create('agent_contact_company', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('agent_id')->unsigned()->nullable();
                $table->foreign('agent_id', 'fk_p_171264_171256_contac_5b240aa6ba971')->references('id')->on('agents');
                $table->integer('contact_company_id')->unsigned()->nullable();
                $table->foreign('contact_company_id', 'fk_p_171256_171264_agent__5b240aa6b9692')->references('id')->on('contact_companies');

                $table->timestamps();
            });
        }
    }
}
