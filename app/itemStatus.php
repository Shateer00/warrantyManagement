<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemStatus extends Model
{
    //
    protected $table = 'tbl_gr_m_item_status';
    public $timestamps = false;
    protected $primaryKey = 'tblitemstatus_id';
}
