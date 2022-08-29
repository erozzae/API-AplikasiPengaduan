<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Komplain;
use App\Balasan;
use File;
use Image;

class KomplainController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api']);
    }

    public function store(Request $request, $id){
        $komplain = new Komplain;
        $komplain->id_user = $id;
        $komplain->judul_komplain_saran = $request->judul_komplain_saran;
        $komplain->isi_komplain_saran = $request->isi_komplain_saran;
        $komplain->email = $request->email;
        $komplain->jenis = $request->jenis;

        if($request->gambar!=NULL){
            $gambar = $request->gambar;
            $namafile = time() . '.' . $gambar->getClientOriginalExtension();
            Image::make($gambar)->resize(200, 150)->save('thumb/' . $namafile);
            $gambar->move('images/', $namafile);
            $komplain->gambar = $namafile;
    }
        $komplain->save();
        return response()->json(['data has been created'=>$komplain,201]);

    } 

    public function komplain($id){
        $komplain = Komplain::find($id);   
        $balasan = $komplain->Balasan;
        if ($balasan != null) {
            $isi_balasan = $balasan;
            return response()->json(['komplain'=>$komplain,'balasan'=>$isi_balasan],200);
        }
        elseif ($balasan == null) {
            return response()->json(['komplain'=>$komplain,'balasan'=>null],200);
        }
        
    }

    // public function usersKomplain($id_user){
    //     $komplain = Komplain::where('id_user', $id_user)->get();
    //     return response()->json(['users komplain'=>$komplain],200);
    // }
    
    public function usersKomplain($id_user){
        $komplain = Komplain::where('komplain.id_user', $id_user)->leftJoin('balasan', function($join) {
            $join->on('komplain.id_komplain_saran','=','balasan.id_komplain_saran');
        })->orderBy('komplain.created_at','desc')
        ->get([
            'komplain.id_komplain_saran',
            'komplain.id_user',
            'komplain.jenis',
            'komplain.judul_komplain_saran',
            'komplain.created_at',
            'balasan.status'  
        ]);
        return response()->json(['users komplain'=>$komplain],200);
    }
   
}
