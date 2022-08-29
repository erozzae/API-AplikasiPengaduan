<?php

namespace App\Http\Controllers\AuthTokenApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Passport\RefreshToken;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Token;
use User;


class LogoutController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api']);
    }
    
    public function logout(Request $request){
        $userToken = Auth::User()->token();
        $userToken->revoke();
        return response()->json(['message' => 'You have been successfully logged out.'], 200);
    }
}
