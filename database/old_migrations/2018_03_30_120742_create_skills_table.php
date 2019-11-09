<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('user_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('attached_cv')->nullable();
            $table->integer('reference')->nullable();
            $table->string('client_name')->nullable();
            $table->string('manager_name')->nullable();
            $table->bigInteger('reference_mobile')->nullable();
            $table->string('info_field')->nullable();
            $table->string('hourly_rate')->nullable();
            $table->string('role_definition')->nullable();
            $table->string('availability')->nullable();
            $table->date('availability_date');
            $table->string('availability_per_week')->nullable();
            $table->text('travelling')->nullable();
            $table->integer('possible_extension')->nullable();
            $table->string('extension_text')->nullable();
            $table->integer('other_interview')->nullable();
            $table->string('comment_area_text')->nullable();
            $table->string('source')->nullable();
            $table->text('competences_skill_category_1')->nullable();
            $table->text('competences_skill_category_2')->nullable();
            $table->text('competences_skill_category_3')->nullable();
            $table->text('competences_skill_category_4')->nullable();
            $table->text('competences_skill_category_5')->nullable();
            $table->text('competences_skill_category_6')->nullable();
            $table->text('competences_skill_category_7')->nullable();
            $table->text('competences_skill_category_8')->nullable();
            $table->text('core_competences')->nullable();
            $table->text('general_notes')->nullable();
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
        Schema::dropIfExists('skills');
    }
}
