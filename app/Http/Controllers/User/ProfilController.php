<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Image;


class ProfilController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api']);
    }
    
    public function profil($id){
        $user = User::findOrFail($id);
        $gambar = $user['gambar'];
        // return response()->json(['user'=>$user,
        //                           'imgProfil'=>asset('/images/'.$gambar)],200);
         return response()->json(['user'=>$user,
                                'imgProfil'=>$gambar],200);
        
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        if ($user != null) {    
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
            elseif ($request->password = null) {
                $user->password = $request->old_password;
            }
            if($request->gambar!=NULL){
                $gambar = $request->gambar;
                $namafile = time() . '.' . $gambar->getClientOriginalExtension();
                Image::make($gambar)->resize(200, 150)->save('thumb/' . $namafile);
                $gambar->move('images/', $namafile);
                $user->gambar = $namafile;
        }
        $user->update();
        return response()->json(['data updated'=>$user],201);
    }
}
}