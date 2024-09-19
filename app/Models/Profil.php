<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class profil extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bio',
        'profession',
        'sexe',
        'number',
        'naissance',
        'domicile', 
        'competences',
        "prenom",
        "nom_entite",
        "services",
        "description_entite",
    ];
    public function reseau()
    {
        return $this->hasOne(reseau::class);
    }
}
