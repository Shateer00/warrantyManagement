<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblGrMItemBrand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gr_m_item_brand', function (Blueprint $table) {
            $table->bigIncrements('tblitembrand_id');
            $table->string('tblitembrand_code',5);
            $table->string('tblitembrand_name',50);
            $table->integer('tblitembrand_recordStatus')->default(1);
            $table->dateTime('tblitembrand_createdOn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('tblitembrand_createdBy')->default(1);
            $table->dateTime('tblitembrand_modifyOn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('tblitembrand_modifyBy')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_gr_m_item_brand');
    }
}
