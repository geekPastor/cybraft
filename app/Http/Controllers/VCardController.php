<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use JeroenDesloovere\VCard\VCard;

class VCardController extends Controller
{
    public function __invoke(User $user)
    {
        $vcard = new VCard();

        $vcard->addName($user->name);
        $vcard->addEmail($user->email);
        $vcard->addPhoneNumber($user->profil->number);
        $vcard->addAddress(null, null, null, null, null, null, $user->profil->domicile);
        $vcard->addBirthday($user->profil->naissance);
        $vcard->addJobtitle($user->profil->profession);
        $vcard->addRole($user->profil->profession);
        $vcard->addCompany($user->entity->name);

        return response($vcard->download());
    }
}
