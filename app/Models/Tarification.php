<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarification extends Model
{
    use HasFactory;

    protected $fillable = ["article_id", "duree_location_id", "prix"];
    

    public function dureeLocation(){
        return $this->belongsTo(DureeLocation::class, "duree_location_id", "id");
    }

    public function article(){
        return $this->belongsTo(Article::class);
    }

    public function getPrixForHumansAttribute(){
        return number_format($this->prix, 0, ",", " ") . " " . env("CURRENCY", "XAF");
    }
}
