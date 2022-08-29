<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jawaban;
use App\User;
use App\Pertanyaan;
use DB;


class QnAAdminController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api']);
    }

    public function allQna(){
        // $qna = Pertanyaan::with('user','jawaban')->get();
        $jawaban = Jawaban::with('user')->get();
        return response(['qna'=>$jawaban]);
        //   $qna = DB::table('pertanyaan')
        //     ->leftJoin('jawaban', 'pertanyaan.id_pertanyaan','=','jawaban.id_pertanyaan')
        //     ->Join('users','users.id','=','pertanyaan.id_user') 
        
        //     ->get([
        //         'pertanyaan.id_pertanyaan',
        //         'pertanyaan.id_user',
        //         'pertanyaan.isi_pertanyaan',
        //         'pertanyaan.isi_pertanyaan',
        //         'pertanyaan.created_at',
        //         'jawaban.isi_jawaban',
        //         'jawaban.id_jawaban',
        //         'jawaban.id_user AS id_user_jawab',
        //         'users.name AS user_tanya'
        //     ]);

            // return response()->json(['qna'=>$qna],200);
    }

    public function storeJawab(Request $request, $id_pertanyaan,$id_user){
        $jawaban = new Jawaban;
        $jawaban->id_pertanyaan = $id_pertanyaan;
        $jawaban->id_user = $id_user;
        $jawaban->isi_jawaban = $request->isi_jawaban;
        $jawaban->save();
        return response()->json(['data has been created',$jawaban],201);
    }

    public function deleteTanya($id){
        $tanya = Pertanyaan::find($id);
        $tanya->delete();
        return response()->json(['message'=>'data has been deleted'],200);
    }

    public function deleteJawab($id){
        $jawab = Jawaban::find($id);
        $jawab->delete();
        return response()->json(['message'=>'data has been deleted'],200);
    }
}
