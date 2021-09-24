<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('template', function (Blueprint $table) {
            $table->increments('template_id');
            $table->string('template_name');
            $table->string('size');
            $table->string('imagename');
            $table->date('display_date');
            $table->string('file_name');
            $table->string('template_type')->default('template');
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
        Schema::dropIfExists('template');
    }
}
