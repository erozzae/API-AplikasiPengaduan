<?php

namespace App\Http\Controllers\AuthTokenApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request){
        $login = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
        if(!Auth::attempt($login)){
            return response()->json(['response'=>false,'message'=>'login credential invalid']);
        }
        else{
          
            $pass = Auth::user()->password;
            $gambar = Auth::user()->gambar;
            $accessToken = Auth::user()->createToken('authToken')->accessToken;          
            return response()->json(['response'=>true,'user'=>Auth::User(),'userPass'=>$pass,
                                                                            'accessToken'=>$accessToken,
                                                                            'imgProfil'=>asset('/images/'.$gambar) ]);
        }
    }
}
