<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'path',
    ];

    public function getUrl()
    {
        return Storage::disk('public')->url($this->path);
    }
}
