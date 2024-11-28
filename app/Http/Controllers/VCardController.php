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
        $vcard->addPhoneNumber($user->profil->number ?? 'Indisponible');
        $vcard->addPhoneNumber($user->profil->number2 ?? 'Indisponible');
        $vcard->addAddress(null, null, null, null, null, null, $user->profil->domicile ?? 'Indisponible');
        $vcard->addBirthday($user->profil->naissance ?? 'Indisponible');
        $vcard->addJobtitle($user->profil->profession ?? 'Indisponible');
        $vcard->addRole($user->profil->profession ?? 'Indisponible');
        $vcard->addCompany($user->entity->name ?? 'Indisponible');
        $vcard->addURL(route('profil.compte', $user->getRouteKey()));

        $contactFileName = "contact-" . $user->slug . '.vcf';

        return response()->streamDownload(function () use ($vcard) {
            echo $vcard->getOutput();
        }, $contactFileName, [
            'Content-Type' => 'text/vcard',
            'Content-Disposition' => 'attachment; filename="' . $contactFileName . '"',
        ]);
    }
}
