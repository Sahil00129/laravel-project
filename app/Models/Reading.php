<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;
    
    protected $table ="readings";
    protected $fillable = ['flat_no','pr_rd','pr_rd_dt','monthyear'];

}
