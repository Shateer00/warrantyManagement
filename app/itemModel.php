<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class itemModel extends Model
{
    use Sortable;
    //
    protected $table = 'tbl_gr_m_item_model';
    public $timestamps = false;
    protected $primaryKey = 'tblitemmodel_id';
    public $sortable = ["tblitemmodel_codeModel","tblitemmodel_descriptionModel","tblitemcategory_id","tblitemcategory_id"];
}
