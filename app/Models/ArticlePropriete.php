<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlePropriete extends Model
{
    use HasFactory;

    public $table = "article_propriete";
    public $fillable = [
        "article_id", "propriete_article_id", "valeur"
    ];

    public function propriete(){
        return $this->hasOne(ProprieteArticle::class,'id', 'propriete_article_id'); 
    }

}
