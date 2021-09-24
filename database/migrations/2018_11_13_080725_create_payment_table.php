<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('Payment_Id');
            $table->integer('Studio_id')->unsigned();
            $table->foreign('Studio_id')->references('id')->on('studio')->onDelete('cascade')->onUpdate('cascade'); 
            $table->timestamp('PaymentDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('SubscriptionTenure');
            $table->timestamp('StartDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('ExpiryDate')->default(Carbon::now()->addMonths(1));
            $table->decimal('AmountPaid',9,2);
            $table->string('StudioMobileNumber');
            $table->enum('PaymentMethord', ['1', '2', '3'])->comment('1=>Online,2=>Bank Deposite,3=>At counter(Cash)');
            $table->enum('PaymentStatus', ['0', '1', '2'])->comment('0=>Pending,1=>Success,2=>Failed')->default('0');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
