<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branche_id')->constrained();
            $table->foreignId('course_category_id')->constrained();
            $table->foreignId('cancellation_policy_id')->constrained();
            $table->string('courseType');
            $table->string('name',50);
            $table->longText('note');
            $table->string('calendarColor',10);
            $table->tinyInteger('clientCanCancel');
            $table->tinyInteger('enabled');
            $table->string('requirements')->nullable();
            $table->integer('slotDuration');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_templates');
    }
};
