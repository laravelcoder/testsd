<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Create5b240572cc7f9AdCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ad_category')) {
            Schema::create('ad_category', function (Blueprint $table) {
                $table->integer('ad_id')->unsigned()->nullable();
                $table->foreign('ad_id', 'fk_p_171266_172406_catego_5b240572cc97d')->references('id')->on('ads')->onDelete('cascade');
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', 'fk_p_172406_171266_ad_cat_5b240572cca53')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('ad_category');
    }
}
