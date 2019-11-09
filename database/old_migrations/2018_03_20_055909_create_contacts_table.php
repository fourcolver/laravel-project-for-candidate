<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->integer('account_id')->unsigned();
            //$table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->string('job_title');
            $table->string('departement');
            $table->bigInteger('phone');
            $table->bigInteger('mobile');
            $table->string('email_id')->unique();
            $table->text('notes')->nullable();
            $table->integer('decision_maker')->default('0')->comment('0 => No, 1 => Yes');
            $table->string('city')->nullable();
            $table->string('pincode');
            $table->string('country');
            $table->text('touch_rule')->nullable();
            $table->integer('added_by')->default('1')->unsigned();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
