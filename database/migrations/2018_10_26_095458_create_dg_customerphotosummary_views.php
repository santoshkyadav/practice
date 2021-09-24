<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDgCustomerphotosummaryViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
      CREATE VIEW dg_customerphotosummary AS
      (select distinct `abc`.`FolderName` AS `FolderName`,count(`abc`.`FileName`) AS `NoofPhoto`,(select count(`larave_studio`.`dg_tblfunctiondetail`.`FileName`) from `larave_studio`.`dg_tblfunctiondetail` where ((`larave_studio`.`dg_tblfunctiondetail`.`Studio_Id` = `abc`.`Studio_Id`) and (`larave_studio`.`dg_tblfunctiondetail`.`Customer_Id` = `abc`.`Customer_Id`) and (`larave_studio`.`dg_tblfunctiondetail`.`Function_id` = `abc`.`Function_id`) and (`larave_studio`.`dg_tblfunctiondetail`.`FolderName` = `abc`.`FolderName`) and (`larave_studio`.`dg_tblfunctiondetail`.`Status` = 1))) AS `SelectedPhoto`,`abc`.`Studio_Id` AS `Studio_Id`,`abc`.`Customer_Id` AS `Customer_Id`,`abc`.`Function_id` AS `Function_id` from `larave_studio`.`dg_tblfunctiondetail` `abc` group by `abc`.`Studio_Id`,`abc`.`Customer_Id`,`abc`.`FolderName`,`abc`.`Function_id`)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS dg_customerphotosummary');
    }
}
