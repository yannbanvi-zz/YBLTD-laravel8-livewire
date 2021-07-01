<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeArticle extends Model
{
    use HasFactory;

    protected $table = "type_articles";

    public function articles(){
        return $this->hasMany(Article::class);
    }
}
