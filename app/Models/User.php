<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mdp',
        'role_id',
        'slug',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function profil()
    {
        return $this->hasOne(Profil::class);
    }
    public function picture()
    {
        return $this->hasOne(pictures::class);
    }

    /**
     * Get the role that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the entity associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function entity(): HasOne
    {
        return $this->hasOne(Entity::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if (preg_match('/-(\d+)$/', $value, $matches)) {
            $id = $matches[1];
            // Extraire le slug en retirant l'id de la chaîne originale
            $slug = substr($value, 0, strrpos($value, '-' . $id));
            return $this->where('id', $id)->where('slug', $slug)->firstOrFail();
        }

        abort(404);
    }

    public function getRouteKey()
    {
        return $this->slug . '-' . $this->id;
    }

    public function getImageUrl()
    {
        return $this->picture?->picture ? asset(Storage::disk('public')->url($this->picture?->picture)) : asset('avatar.png');
    }

    /**
     * Get all of the contacts for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Get all of the files for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files(): HasMany
    {
        return $this->hasMany(UserFile::class);
    }
}
