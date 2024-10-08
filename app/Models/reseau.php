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
        'facebook',
        'twitter', 
        'instagram',
        'tiktok',
        'theads',
        'telegram',
        'whatsapp',
        'linkedin',
    ];
    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }
}
