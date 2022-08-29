<?php

namespace App\Http\Controllers\AuthTokenApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\User;
use Response;
use Validator;

class RegisterController extends Controller
{
    public function register(Request $request){
        // $validator = $validator = Validator::make($request->all(),[
        //     'name' => 'required',
        //     'email' => 'required|unique:users,email',
        //     'password'=>'required'
        // ]);
        // if ($validator->fails()) {    
        //     return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        // }
        // else {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
        
        return response()->json(['data created'=>$user]);
        // }
       
    }
}
