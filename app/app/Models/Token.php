<?php

namespace App\Models;


class Token extends Model
{
    CONST READ_ACCESS = 0;
    CONST WRITE_ACCESS = 1;
    
    protected $guarded = [];
   
}
