<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Pertanyaan;
use App\User;
use App\Jawaban;

class QnAController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api']);
    }
    public function storeTanya(Request $request, $id){
        $tanya = new Pertanyaan;
        $tanya->id_user = $id;
        $tanya->isi_pertanyaan = $request->isi_pertanyaan;
        $tanya->save();
        return response()->json(['data has been created'=>$tanya],201);
    }

    public function allQna(){
        $qna = DB::table('pertanyaan')
            ->leftJoin('jawaban', 'pertanyaan.id_pertanyaan','=','jawaban.id_pertanyaan')
            ->Join('users','users.id','=','pertanyaan.id_user')->orderBy('pertanyaan.created_at','desc')->orderBy('jawaban.created_at','desc')
            ->get([
                'pertanyaan.id_pertanyaan',
                'pertanyaan.id_user',
                'pertanyaan.isi_pertanyaan',
                'pertanyaan.created_at AS tanya_at',
                'jawaban.created_at AS jawab_at',
                'jawaban.isi_jawaban',
                'jawaban.id_jawaban',
                'jawaban.id_user AS user_jawab',
                'users.name AS user_tanya',
                'users.gambar'
            ]);
        return response()->json(['qna'=>$qna],200);
    }

  
}
