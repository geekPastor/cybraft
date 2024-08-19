<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class reseau extends Model
{
    use HasFactory;
    protected $table="reseaux";
    protected $fillable = [
        'profil_id',
        'Facebook',
        'twitter', 
        'Instagram',
        'Tik Tok',
        'Theads',
        'Telegram',
    ];
    public function profil()
    {
        return $this->belongsTo(profil::class);
    }
}
