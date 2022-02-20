<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class itemCategory extends Model
{
    //
    use Sortable;

    protected $table = 'tbl_gr_m_item_category';
    public $timestamps = false;
    protected $primaryKey = 'tblitemcategory_id';
    public $sortable = ["tblitemcategory_code","tblitemcategory_name"];
}
