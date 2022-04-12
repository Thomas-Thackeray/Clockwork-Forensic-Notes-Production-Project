<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;

    public function userConnect()
    {
        // return $this->hasMany(Items::class);
        return $this->hasMany(User::class, 'company_id', 'id');
        // note: we can also include comment model like: 'App\Models\Comment'
    }
}
