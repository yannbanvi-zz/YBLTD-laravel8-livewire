<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class, "user_permission",  "permission_id", "user_id");
    }
}
