<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblGrTItemWarranty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gr_t_item_warranty', function (Blueprint $table) {
            $table->bigIncrements('tblitemwarranty_id');
            $table->foreignId('tblitemmodel_id')->constrained('tbl_gr_m_item_model','tblitemmodel_id');
            $table->string('tblitemwarrant_SN',30);
            $table->string('tblitemwarrant_dokBukti',50);
            $table->string('tblitemwarrant_distributor',50);
            $table->string('tblitemwarrant_username',50);
            $table->string('tblitemwarrant_location',50);
            $table->dateTime('tblitemwarrant_purchaseDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('tblitemwarrant_monthPeriod');
            $table->string('tblitemwarrant_note');
            $table->foreignId('tblitemstatus_id')->constrained('tbl_gr_m_item_status','tblitemstatus_id');
            $table->integer('tblitemwarrant_recordStatus')->default(1);
            $table->dateTime('tblitemwarrant_createdOn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('tblitemwarrant_createdBy')->default(1);
            $table->dateTime('tblitemwarrant_modifyOn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('tblitemwarrant_modifyBy')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_gr_t_item_warranty');
    }
}
