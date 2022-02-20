<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemModel extends Model
{
    //
    protected $table = 'tbl_gr_m_item_model';
    public $timestamps = false;
    protected $primaryKey = 'tblitemmodel_id';
}
