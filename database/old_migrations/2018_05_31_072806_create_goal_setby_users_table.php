<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalSetbyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goal_setby_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('set_by');
            $table->string('client_activity')->nullable();
            $table->string('client_add')->nullable();
            $table->string('candidate_add')->nullable();
            $table->string('oppo_add')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goal_setby_users');
    }
}
