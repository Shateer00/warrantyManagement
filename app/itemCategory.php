<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemCategory extends Model
{
    //
    protected $table = 'tbl_gr_m_item_category';
    public $timestamps = false;
    protected $primaryKey = 'tblitemcategory_id';
}
