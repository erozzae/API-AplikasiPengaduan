<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use File;
use Image;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api']);
    }
    
    public function users(){
        $users = User::orderBy('updated_at','desc')->get();
        return response()->json(['users'=>$users]);
       
    }

    public function store(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->posisi = $request->posisi;
        $user->level = $request->level;
        if($request->gambar!=NULL){     
            $gambar = $request->gambar;
            $namafile = time() . '.' . $gambar->getClientOriginalExtension();
            Image::make($gambar)->resize(200, 150)->save('thumb/' . $namafile);
            $gambar->move('images/', $namafile);
            $user->gambar = $namafile;
        }
        $user->save();
        return response()->json(['data created'=>$user]);
    }

    public function update(Request $request, $id){
        // dd($request);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->posisi = $request->posisi;
        $user->level = $request->level;
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

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return response()->json(['message'=>'data deleted'],201);
    }
}
