<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('list_name');
            $table->string('hotness_filter')->nullable();
            $table->string('postcode_filter')->nullable();
            $table->string('freelnacer_filter')->nullable();
            $table->text('technology_filter')->nullable();
            $table->text('last_contact')->nullable();
            $table->text('detailed_technologies')->nullable();
            $table->string('added_by')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_list');
    }
}
