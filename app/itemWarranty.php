<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class itemWarranty extends Model
{
    use Sortable;
    //
    protected $table = 'tbl_gr_t_item_warranty';
    public $timestamps = false;
    protected $primaryKey = 'tblitemwarranty_id';
    public $sortable = ["tblitemwarrant_SN","tblitemstatus_id","tblitemmodel_id"];
}
