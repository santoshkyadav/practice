<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstcustomerTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('mstcustomer', function (Blueprint $table) {
            $table->increments('Customer_id');
            $table->integer('studio_id')->unsigned();
            $table->foreign('studio_id')->references('id')->on('studio')->onDelete('cascade')->onUpdate('cascade');
            $table->string('Cust_Username');
            $table->string('Cust_Password');
            $table->string('CustomerName');
            $table->string('City');
            $table->string('State');
            $table->enum('status', ['0', '1'])->comment('0=>Not Verified,1=>Verfied')->default('0');
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
        Schema::dropIfExists('mstcustomer');
    }

}
