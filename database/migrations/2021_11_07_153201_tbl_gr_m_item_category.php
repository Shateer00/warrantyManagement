<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblGrMItemCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gr_m_item_category', function (Blueprint $table) {
            $table->bigIncrements('tblitemcategory_id');
            $table->string('tblitemcategory_code',5);
            $table->string('tblitemcategory_name',50);
            $table->integer('tblitemcategory_recordStatus')->default(1);
            $table->dateTime('tblitemcategory_createdOn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('tblitemcategory_createdBy')->default(1);
            $table->dateTime('tblitemcategory_modifyOn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('tblitemcategory_modifyBy')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_gr_m_item_category');
    }
}
