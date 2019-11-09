<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('opportunity_type')->default('0');
            $table->text('attached_doc')->nullable();
            $table->text('attached_voice_memo')->nullable();
            $table->dateTime('close_date');
            $table->string('status')->default('1');
            $table->string('next_step')->nullable();
            $table->string('forecast')->nullable();
            $table->integer('probability');
            $table->integer('repeat_order')->default('0')->comment('0 => No, 1 => Yes');
            $table->text('report')->nullable();
            $table->string('source');
            $table->string('hotness');
            $table->string('client_name');
            $table->bigInteger('client_number');
            $table->string('technology');
            $table->text('process')->nullable();
            $table->text('profile_sent')->nullable();
            $table->string('info_field')->nullable();
            $table->text('description')->nullable();
            $table->text('opportunity_line')->nullable();
            $table->integer('opportunity_status')->default('0');
            $table->text('detailed_coding')->nullable();
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
        Schema::dropIfExists('opportunity');
    }
}
