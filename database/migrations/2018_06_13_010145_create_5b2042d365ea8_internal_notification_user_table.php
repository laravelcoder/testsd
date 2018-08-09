<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Create5b2042d365ea8InternalNotificationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('internal_notification_user')) {
            Schema::create('internal_notification_user', function (Blueprint $table) {
                $table->integer('internal_notification_id')->unsigned()->nullable();
                $table->foreign('internal_notification_id', 'fk_p_171247_171234_user_i_5b2042d366091')->references('id')->on('internal_notifications')->onDelete('cascade');
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', 'fk_p_171234_171247_intern_5b2042d36639a')->references('id')->on('users')->onDelete('cascade');
                $table->timestamp('read_at')->nullable();
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('internal_notification_user');
    }
}
