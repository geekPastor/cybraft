<?php

namespace App\Http\Controllers;

use App\Http\Requests\createRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\updateRequest;
use App\Models\pictures;
use App\Models\Profil;
use App\Models\reseau;
use Illuminate\Support\Facades\Hash;

class profilController extends Controller
{
    public function show(User $user,Request $request){
        $id=(int)$user->id;
        $user=$user;
       $picture= pictures::where("user_id",$id)->where('role',"background")->first();
        return view("welcome",['user'=>$user,'picture'=>$picture]);
    }

    public function update(User $user){
        $user=$user;
        return view("update",['user'=>$user]);
    }
    public function admin(Request $request){
        $id=(int)$request->route("user");
        $users=User::all();
        $total=User::count();
        return view("admin.show",['id'=>$id,'users'=>$users,"total"=>$total]);
    }
   public function modif(updateRequest $request)
   {
    $validated = $request->validated();

    $id=$request->route("user");

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
    $user=(int)$request->route("user");
    return view("qr",['user'=>$user]);
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
}
