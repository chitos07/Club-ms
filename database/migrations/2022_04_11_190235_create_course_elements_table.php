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
        Schema::create('course_elements', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->foreignId('course_template_id')->constrained();
            $table->decimal('price',16,10);
            $table->tinyInteger('applyTax');
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
        Schema::dropIfExists('course_elements');
    }
};
