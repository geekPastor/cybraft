<?php

namespace App\Http\Controllers;

use App\Http\Requests\updateRequest;
use App\Models\pictures;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class StorageController extends Controller
{
    private function uppload(UploadedFile $file){
        return $file->store('public','public');
    }
    public function index(Request $request){
        $data=$request->file("picture");
        
        $user=$request->route("user");
        $chemin=$this->uppload($data);
        pictures::updateOrCreate(
            ['user_id'=>$user],[
                'user_id'=>$user,
                 "picture"=>$chemin
            ],);
        return back()->with("success","profil fait");
    }
    public function background(Request $request)
    {

        $data=$request->file("picture");
        
        $user=$request->route("user");
        $chemin=$this->uppload($data);
        pictures::updateOrCreate(
            ['user_id'=>$user,"role"=>"background"],
        [
        'user_id'=>$user,
        "picture"=>$chemin,
        "role"=>"background"
        ]);
        return back()->with("success","background fait");
    }
}
