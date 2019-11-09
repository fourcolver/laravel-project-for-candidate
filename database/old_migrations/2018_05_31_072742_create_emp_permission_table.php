<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_permission', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('emp_id')->nullble();
            $table->integer('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('emp_index')->default('index');
            $table->string('emp_view')->default('view');
            $table->string('kunden_permission')->nullable();
            $table->string('knotakte_permission')->nullable();
            $table->string('kandidaten_permission')->nullable();
            $table->string('projektanfrage_permission')->nullable();
            $table->string('task_permission')->nullable();
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
        Schema::dropIfExists('emp_permission');
    }
}
