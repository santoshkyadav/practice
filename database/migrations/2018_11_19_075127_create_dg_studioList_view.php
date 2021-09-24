<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDgStudioListView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement("
      CREATE VIEW dg_studiolist AS
      (select `larave_studio`.`dg_studio`.`id` AS `id`,`larave_studio`.`dg_studio`.`studio_name` AS `studio_name`,`larave_studio`.`dg_studio`.`name` AS `name`,`larave_studio`.`dg_studio`.`email` AS `email`,`larave_studio`.`dg_studio`.`password` AS `password`,`larave_studio`.`dg_studio`.`mobile_no` AS `mobile_no`,`larave_studio`.`dg_studio`.`address` AS `address`,`larave_studio`.`dg_studio`.`city` AS `city`,`larave_studio`.`dg_studio`.`state` AS `state`,`larave_studio`.`dg_studio`.`logoFileName` AS `logoFileName`,(case when (`larave_studio`.`dg_studio`.`status` = 0) then 'UnVerified' when (`larave_studio`.`dg_studio`.`status` = 1) then 'Verified' when (`larave_studio`.`dg_studio`.`status` = 2) then 'Active' when (`larave_studio`.`dg_studio`.`status` = 3) then 'Expired' else 'BLOCKED' end) AS `UserSTATUS` from `larave_studio`.`dg_studio`)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::statement('DROP VIEW IF EXISTS dg_studiolist');
    }
}
