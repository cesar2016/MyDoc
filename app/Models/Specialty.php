<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Specialty extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}


