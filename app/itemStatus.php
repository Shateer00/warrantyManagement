<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemStatus extends Model
{
    use HasFactory;
    protected $table = 'tbl_gr_m_item_status';
    protected $primaryKey = 'tblitemstatus_id';
    public $timestamps = false;
}
