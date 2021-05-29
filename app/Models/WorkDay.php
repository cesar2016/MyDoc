<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDay extends Model
{
    protected $fillable = 
    [
        'day',
        'active',

        'morning_start',
        'morning_end', 

        'afternoon_start',
        'afternoon_end',
        
        'user_id'
         
    ];
}
