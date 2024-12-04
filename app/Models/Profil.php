<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profil extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bio',
        'profession',
        'sexe',
        'number',
        'number2',
        'naissance',
        'domicile', 
        'competences',
        'private_email',
    ];
    public function reseau()
    {
        return $this->hasOne(reseau::class);
    }
}
