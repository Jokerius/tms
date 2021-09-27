<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    CONST READ_ACCESS = 0;
    CONST WRITE_ACCESS = 1;
    
    protected $guarded = [];
   
}
