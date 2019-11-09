<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_name')->nullable();
            $table->string('prozesse')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('country')->nullable();
            $table->integer('freelancers')->nullable();
            $table->string('Technology')->nullable();
            $table->dateTime('last_time_contact')->nullable();
            $table->string('type_of_client')->nullable();
            $table->text('client_specification')->nullable();
            $table->string('owner')->nullable();
            $table->string('source')->nullable();
            $table->text('sub_lable')->nullable();
            $table->bigInteger('telephone')->nullable();
            $table->text('comments')->nullable();
            $table->integer('decision_maker')->default('0')->comment('0 => No, 1 => Yes');
            $table->integer('departement_size')->nullable();
            $table->integer('job_outcome')->default('0')->comment('0 => No, 1 => Yes');
            $table->text('detailed_technologies')->nullable();
            $table->integer('account_status')->default('0')->comment('0 => Kunden, 1 => Kunden Not in Database');
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
        Schema::dropIfExists('accounts');
    }
}