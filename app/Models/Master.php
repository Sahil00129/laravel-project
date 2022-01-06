<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;
    protected $table ="masters_tbl_";
    protected $fillable = ['flat_no','cur_rd','cur_rd_dt','lat_pay_char','amt_last_p','cred_bal','inv_n','inv_d','monthyear'];

}
