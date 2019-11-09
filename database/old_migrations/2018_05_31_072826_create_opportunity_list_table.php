<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunityListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunity_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('list_name');
            $table->string('oppo_technology')->nullable();
            $table->string('detailed_coding')->nullable();
            $table->string('list_type')->nullable();
            $table->string('opportunity_status')->nullable();
            $table->string('hotness_client')->nullable();
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
        Schema::dropIfExists('opportunity_list');
    }
}
