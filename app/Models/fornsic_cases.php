<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fornsic_cases extends Model
{
    use HasFactory;

    public function ownerConnect()
    {
      
        return $this->belongsTo(User::class, 'created_by', 'id');
        
    }
}
