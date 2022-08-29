<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Komplain;
use App\Balasan;

class KomplainAdminController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api']);
    }
    
    public function komplains(){
        $komplains = Komplain::leftJoin('balasan', function($join) {
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

        return response()->json(['komplains'=>$komplains],200);
    }

    public function komplain($id){
        $komplain = Komplain::find($id);
        $balasan = Balasan::where('id_komplain_saran', $id)->first();
        // return response()->json(['balasan'=>$balasan],200);
        if ($balasan != null) {
            $isi_balasan = $balasan;
            return response()->json(['komplain'=>$komplain,'balasan'=>$isi_balasan],200);
        }
        elseif ($balasan == null) {
            return response()->json(['komplain'=>$komplain,'balasan'=>null],200);
        }
        
    }

    public function updateBalasan(Request $request, $id_balasan, $id_user){
        $update = Balasan::find($id_balasan);
        $update->id_user = $id_user;
        $update->balasan = $request->balasan;
        $update->status = $request->status;
        $update->update();
        return response()->json(['data has been updated'=>$update]);
    }

    public function balasan(Request $request, $id_komplain_saran, $id_user){
        $balasan = new Balasan;
        $balasan->id_komplain_saran = $id_komplain_saran;
        $balasan->id_user = $id_user;
        $balasan->balasan = $request->balasan;
        $balasan->status = $request->status;
        $balasan->save();
        return response()->json(['data has been created'=>$balasan]); 
    }
}
