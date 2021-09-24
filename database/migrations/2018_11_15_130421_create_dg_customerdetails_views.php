<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDgCustomerdetailsViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
      CREATE VIEW dg_customerdetails AS
      (select `fun`.`id` AS `id`,`fun`.`customer_id` AS `customer_id`,`fun`.`FunctionDate` AS `FunctionDate`,`fun`.`FunctionType` AS `FunctionType`,`fun`.`AlbumName` AS `AlbumName`,`fun`.`ImageCount` AS `ImageCount`,`fun`.`Remark` AS `Remark`,(`fun`.`created_at` + interval 10 day) AS `ExpiryDate`,`cust`.`studio_id` AS `studio_id`,`cust`.`Cust_Username` AS `Cust_Username`,`cust`.`Cust_Password` AS `Cust_Password`,`cust`.`CustomerName` AS `CustomerName`, `cust`.`City` AS `City`, `cust`.`State` AS `State`, `fun`.`created_at` AS `created_at` from (`larave_studio`.`dg_mstfunction` `fun` join `larave_studio`.`dg_mstcustomer` `cust`) where (`fun`.`customer_id` = `cust`.`Customer_id`))");
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS dg_customerdetails');
    }
}

