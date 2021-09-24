<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblfunctiondetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblfunctiondetail', function (Blueprint $table) {
            $table->increments('ImageId');
            $table->integer('Studio_Id')->unsigned();
            $table->foreign('studio_id')->references('id')->on('studio')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('Customer_Id')->unsigned();
            $table->foreign('Customer_Id')->references('Customer_id')->on('mstcustomer')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('Function_id')->unsigned();
            $table->foreign('Function_id')->references('id')->on('mstfunction')->onDelete('cascade')->onUpdate('cascade');
            $table->string('FolderName');
            $table->string('FileName');
            $table->string('Comment');
//            $table->string('Status')->default('0');
            $table->enum('Status', ['0', '1'])->comment('0=>Not Selected,1=>Selected');
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
         Schema::dropIfExists('tblfunctiondetail');
    }
}
