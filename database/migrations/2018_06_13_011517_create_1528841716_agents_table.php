<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Create1528841716AgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('agents')) {
            Schema::create('agents', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('phone1')->nullable();
                $table->string('phone2')->nullable();
                $table->string('email')->nullable();
                $table->string('skype')->nullable();
                $table->string('address')->nullable();
                $table->string('photo')->nullable();
                $table->text('about')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('agents');
    }
}
