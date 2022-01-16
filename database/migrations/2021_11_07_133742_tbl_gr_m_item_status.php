<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblGrMItemStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @param Blueprint $table
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gr_m_item_status', function (Blueprint $table) {
            $table->bigIncrements('tblitemstatus_id');
            $table->string('tblitemstatus_name',50);
            $table->integer('tblitemstatus_recordStatus')->default(1);
            $table->dateTime('tblitemstatus_createdOn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('tblitemstatus_createdBy')->default(1);
            $table->dateTime('tblitemstatus_modifyOn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('tblitemstatus_modifyBy')->default(1);
        });

        $ArrayOfStatus = array('Normal','Diperbaiki','Ditukar','Rusak','Lain-lain');

            foreach($ArrayOfStatus as $StatusValue){
            DB::table('tbl_gr_m_item_status')->insert(
                array(
                    'tblitemstatus_name'=>$StatusValue
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_gr_m_item_status');
    }
}
