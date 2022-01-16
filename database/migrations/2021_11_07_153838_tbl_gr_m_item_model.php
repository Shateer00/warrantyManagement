<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblGrMItemModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gr_m_item_model', function (Blueprint $table) {
            $table->bigIncrements('tblitemmodel_id');
            $table->foreignId('tblitemcategory_id')->constrained('tbl_gr_m_item_category','tblitemcategory_id');
            $table->foreignId('tblitembrand_id')->constrained('tbl_gr_m_item_brand','tblitembrand_id');
            $table->string('tblitemmodel_codeModel',30);
            $table->string('tblitemmodel_descriptionModel',50);
            $table->integer('tblitemmodel_recordStatus')->default(1);
            $table->dateTime('tblitemmodel_createdOn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('tblitemmodel_createdBy')->default(1);
            $table->dateTime('tblitemmodel_modifyOn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('tblitemmodel_modifyBy')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_gr_m_item_model');
    }
}
