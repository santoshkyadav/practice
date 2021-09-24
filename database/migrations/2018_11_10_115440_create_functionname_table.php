<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateFunctionNameTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('mstfunction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Studio_Id')->unsigned();
            $table->foreign('studio_id')->references('id')->on('studio')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('Customer_id')->on('mstcustomer')->onDelete('cascade')->onUpdate('cascade');
            $table->date('FunctionDate');
            $table->string('FunctionType');
            $table->string('AlbumName');
            $table->integer('ImageCount');
            $table->string('Remark');
            $table->integer('NumberOfSheet');
            $table->enum('status', ['0', '1'])->comment('1=>expired,0=>Not expired')->default('0');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
        Schema::dropIfExists('mstfunction');
    }

}
