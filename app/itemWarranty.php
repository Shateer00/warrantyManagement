<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemWarranty extends Model
{
    //
    protected $table = 'tbl_gr_t_item_warranty';
    public $timestamps = false;
    protected $primaryKey = 'tblitemwarranty_id';
}
