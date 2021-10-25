<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public $fillable = [
        "nom", "noSerie", "type_article_id", "imageUrl"
    ];


    public function type(){
        return $this->belongsTo(TypeArticle::class, "type_article_id", "id");
    }

    public function tarifications(){
        return $this->hasMany(Tarification::class);
    }

    public function locations(){
        return $this->belongsToMany(Location::class,"article_location", "article_id", "location_id");
    }

    public function proprietes(){
        return $this->belongsToMany(ProprieteArticle::class,"article_propriete", "article_id", "propriete_article_id");
    }

    public function article_proprietes(){
        return $this->hasMany(ArticlePropriete::class);
    }

}
