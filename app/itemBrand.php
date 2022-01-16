<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class itemBrand extends Model
{
    //
    use Sortable;

    protected $table = 'tbl_gr_m_item_brand';
    public $timestamps = false;
    protected $primaryKey = 'tblitembrand_id';
    public $sortable = ["tblitembrand_code","tblitembrand_name"];
}
