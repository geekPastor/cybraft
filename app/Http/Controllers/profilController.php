<?php

namespace App\Http\Controllers;

use App\Http\Requests\createRequest;
use App\Http\Requests\MailRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\updateRequest;
use App\Mail\sendMail;
use App\Models\pictures;
use App\Models\Profil;
use App\Models\reseau;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class profilController extends Controller
{
    // Générer un QR code unique pour cet utilisateur avec son ID ou autre information
    public function generateQrForUser($url,$size=300)
    {
        $qrCode = QrCode::size($size)->generate($url);
        
        return $qrCode;
    }
    public function show(Request $request){
        $name=$request->route("name");
       $user= User::where("name",$name)->firstOrFail();
        $id=(int)$user->id;
       $picture= pictures::where("user_id",$id)->where('role',"background")->first();
       $url=$request->url();
       $qrCode=$this->generateQrForUser($url);
        return view("welcome",['user'=>$user,'picture'=>$picture,'qrCode'=>$qrCode]);
    }

    public function update(Request $request){
        $name=$request->route("name");
        $user= User::where("name",$name)->firstOrFail();
         $id=(int)$user->id;
        return view("update",['user'=>$user]);
    }
    public function admin(Request $request){
        
        $name=$request->route("name");
        $user= User::where("name",$name)->firstOrFail();
        $id=(int)$user->id;
        $users=User::all();
        $total=User::count();
        return view("admin.show",['id'=>$id,'users'=>$users,"total"=>$total,'user'=>$user]);
    }
   public function modif(updateRequest $request)
   {
    $validated = $request->validated();
    $name=$request->route("name");
    $user= User::where("name",$name)->firstOrFail();
     $id=(int)$user->id;
    $user = User::where("id",$id)->update(
        [
        'email' => $validated['email'],
        'name' => $validated['name'],
        ]
    );
            // Créer ou mettre à jour le profil
            $profil = Profil::updateOrCreate(
                ['user_id'=>$id],
                [
                    'user_id' => $id,
                    'bio' => $validated['description'],
                    'profession' => $validated['profession'],
                    'sexe' => $validated['sexe'],
                    'number' => $validated['number'],
                    'naissance' => $validated['naissance'],
                    'domicile' => $validated['domicile'],
                    'competences' => $validated['competences'],
                     "prenom"=>$validated['prenom'],
                     "nom_entite"=>$validated['nom_entite'],	
                     "services"=>$validated['services'],	
                     "description_entite"=>$validated['description_entite'],
                ]
            );

            // Créer ou mettre à jour les identifiants reseaux
            $reseau=reseau::updateOrCreate(
                ['profil_id'=>$profil->id],
                [
                    'profil_id'=>$profil->id,
                    'Facebook' => $validated['facebook'],
                    'twitter' => $validated['twitter'],
                    'Instagram' => $validated['instagram'],
                    'Linkedin' => $validated['linkedin'],
                    'Tik Tok' => $validated['tiktok'],
                    'Theads' => $validated['theads'],
                    'Telegram' => $validated['telegram'],
                ]
            );
            return back()->with("success","modification reussie");
   }
   
   public function create(createRequest $request){
    
    $data=$request->validated();
    $data["role"]="users";
    User::create($data);
    return back()->with("success","utilisateur cree");
   }

   public function qr(Request $request){
    

    $name=$request->route("name");
    $user= User::where("name",$name)->firstOrFail();
    $url=route("profil.compte",['name'=>$name]);
    $qrCode=$this->generateQrForUser($url,100);
    return view("qr",['user'=>$user,"qrCode"=>$qrCode]);
   }

   public function destroy(Request $request)
   {
    $id=(int)$request->route("user");
    $user=User::find($id);
    if($user){
        $user->delete();
        return back()->with("success","user supprime");
    }
    return back()->with("error","utilisateur pas trouve");
   }

   public function supprimeDestrroy(Request $request)
   {
    $name=$request->route("name");
    $user= User::where("name",$name)->firstOrFail();
    if($user){
        $user->delete();
        return back()->with("success","user supprime");
    }
    return back()->with("error","utilisateur pas trouve");
   }

   public function mail(MailRequest $request){
    Mail::send(new sendMail($request->validated()));
    return back()->with("success","votre email a bien ete envoye");
}
}

