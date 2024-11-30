<?php
namespace App\Http\Controllers;
use App\Http\Requests\MailRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\updateRequest;
use App\Mail\sendMail;
use App\Models\Contact;
use App\Models\pictures;
use App\Models\Profil;
use App\Models\reseau;
use App\Models\UserFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProfilController extends Controller
{
    // Générer un QR code unique pour cet utilisateur avec son ID ou autre information
    public function generateQrForUser($url, $size = 300)
    {
        $qrCode = QrCode::size($size)->generate($url);

        return $qrCode;
    }

    public function show(User $user, Request $request)
    {
        $id = (int) $user->id;
        $picture = pictures::where("user_id", $id)->where('role', "background")->first();
        $url = $request->url();
        $qrCode = $this->generateQrForUser($url, 160);
        return view("welcome", ['user' => $user, 'picture' => $picture, 'qrCode' => $qrCode]);
    }

    public function update(User $user)
    {
        abort_if($user->id != Auth::id(), 404);
        return view("update", ['user' => $user]);
    }

    public function admin(User $user)
    {
        $users = User::all();
        $total = User::count();
        return view("admin.show", ['id' => $user->id, 'users' => $users, "total" => $total, 'user' => $user]);
    }

    public function modif(User $user, updateRequest $request)
    {
        $validated = $request->validated();

        $user->update(
            [
                'email' => $validated['email'],
                'name' => $validated['name'],
            ]
        );

        // Créer ou mettre à jour le profil
        $profil = Profil::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'bio' => $validated['description'],
                'profession' => $validated['profession'],
                'sexe' => $validated['sexe'],
                'number' => $validated['number'],
                'number2' => $validated['number2'],
                'naissance' => $validated['naissance'],
                'domicile' => $validated['domicile'],
                'competences' => $validated['competences'],
            ]
        );
        // Créer ou mettre à jour les identifiants reseaux
        $profilData = $validated;
        $profilData['profil_id'] = $profil->id;

        $reseau = reseau::updateOrCreate(
            ['profil_id' => $profil->id],
            $profilData
        );
        return to_route('profil.compte', Auth::user()->getRouteKey())->with("success", "modification reussie");
    }

    public function qr(User $user, Request $request)
    {
        $url = route("profil.compte", $user->getRouteKey());
        $qrCode = $this->generateQrForUser($url, 100);
        return view("qr", ['user' => $user, "qrCode" => $qrCode]);
    }

    public function supprimeDestrroy(User $user)
    {
        $user->delete();
        return back()->with("success", "user supprime");
    }

    public function mail(MailRequest $request)
    {
        Mail::send(new sendMail($request->validated()));
        Contact::create($request->validated());
        return back()->with("success", "Votre contact a bien été envoyé");
    }
}
