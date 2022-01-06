<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table ="companys_tbl";
    protected $fillable = ['cmpyName','cmpyNo','gstNum','cmpyAddress','bankName','bankAcc','ifscCode','billerName','payCall','society','sector','city'];
}
