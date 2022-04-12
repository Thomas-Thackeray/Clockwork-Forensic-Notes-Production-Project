<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_roles extends Model
{
    use HasFactory;

    public function userRuleConnect()
    {
      
        return $this->hasMany(User::class, 'user_role_id', 'id');
        
    }
}
