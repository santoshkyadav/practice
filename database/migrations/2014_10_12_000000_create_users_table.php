<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('studio_name');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->bigInteger('mobile_no');
            $table->string('address')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('Hdd_sno')->nullable();
            $table->string('MAC_no')->nullable();
            $table->string('model_no')->nullable();
            $table->string('logoFileName')->nullable();
            $table->timestamp('ExpiredStudio')->nullable();
            $table->string('DomainName')->default('japware.com/customer');
            $table->enum('status', ['0', '1', '2', '3', '4', '5'])->comment('1=>Verfied,0=>Not Verified,2=>Active,3=>Expired,4=>Blocked,5=>Trial')->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('studio');
    }
}
