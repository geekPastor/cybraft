<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('admin', function (User $user = null) {
            if ($user == null) {
                return Auth::user()->role_id == Role::ADMIN;
            }

            return $user->role_id == Role::ADMIN;
        });

        Blade::if('user', function (User $user = null) {
            if ($user == null) {
                return Auth::user()->role_id == Role::USER;
            }

            return $user->role_id == Role::USER;
        });

        Blade::if('hasSocial', function (User $user) {
            // facebook, twitter, linkedin, instagram, tiktok, telegram, whatsapp, theads
            return( $user->profil?->reseau->facebook && $user->profil?->reseau->facebook != 'https://') ||
                ($user->profil?->reseau->twitter && $user->profil?->reseau->twitter != 'https://') ||
                ($user->profil?->reseau->linkedin && $user->profil?->reseau->linkedin != 'https://') ||
                ($user->profil?->reseau->instagram && $user->profil?->reseau->instagram != 'https://') ||
                ($user->profil?->reseau->tiktok && $user->profil?->reseau->tiktok != 'https://') ||
                ($user->profil?->reseau->telegram && $user->profil?->reseau->telegram != 'https://') ||
                ($user->profil?->reseau->whatsapp && $user->profil?->reseau->whatsapp != 'https://') ||
                ($user->profil?->reseau->theads && $user->profil?->reseau->theads != 'https://');
        });
    }
}
