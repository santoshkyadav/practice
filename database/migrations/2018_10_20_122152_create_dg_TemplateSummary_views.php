<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDgTemplateSummaryViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement("
      CREATE VIEW dg_TemplateSummary AS
      (SELECT DISTINCT(display_date) as UploadDate, count(template_id) as NoOfTemplate, SUM(size) As TotalFileSize From dg_template)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS dg_TemplateSummary');
    }
}
