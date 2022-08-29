<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Postingan;
use App\Komentar;
use App\Users;
class ForumController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api']);
    }
    public function posts(){
        if ($post = Postingan::all() != null) {
            $post = Postingan::with(['user'])->orderBy('updated_at','desc')->get();
        }
        else {
            $post = Postingan::all();
        }
        return response()->json(['posts'=>$post],200);
    }
    public function forum($id_postingan){
        if ( Postingan::find($id_postingan) != null) {
            $forum = Postingan::find($id_postingan)->with('user')->get();
        }
        else {
            $forum = Postingan::find($id_postingan);
        }
       
        return response()->json(['forum'=>$forum],200);
    }

    public function forum_detail($id_postingan){
        $post = Postingan::find($id_postingan);
        if ( $post != null ) {
            $post->komentar->get('');
        }
    
        return response()->json(['post'=>$post],200);
    }

    public function storePost(Request $request, $id_user){
        $post = new Postingan;
        $post->id_user = $id_user;
        if($request->gambar!=NULL){     
            $gambar = $request->gambar;
            $namafile = time() . '.' . $gambar->getClientOriginalExtension();
            Image::make($gambar)->resize(200, 150)->save('thumb/' . $namafile);
            $gambar->move('images/', $namafile);
            $user->gambar = $namafile;
        }
        $post->isi_postingan = $request->isi_postingan;
        $post->save();
        return response()->json(['data has been created'=>$post],201);
    }

    public function updatePost(Request $request, $id_postingan){
        $post = Postingan::find($id_postingan);
        if($request->gambar!=NULL){     
            $gambar = $request->gambar;
            $namafile = time() . '.' . $gambar->getClientOriginalExtension();
            Image::make($gambar)->resize(200, 150)->save('thumb/' . $namafile);
            $gambar->move('images/', $namafile);
            $user->gambar = $namafile;
        }
        $post->isi_postingan = $request->isi_postingan;
        $post->update();
        return response()->json(['data has been updated'=>$post],201);
    }

    public function deletePost($id_postingan){
        $delete = Postingan::find($id_postingan);
        $delete->delete();
        return response()->json(['message'=>'data has been deleted']);
    }

    public function deleteKomen($id_komen){
        $delete = Komentar::find($id_komen);
        $delete->delete();
        return response()->json(['message'=>'data has been deleted']);
    }

    public function storeKomen(Request $request, $id_user, $id_postingan){
        $post = new Komentar;
        $post->id_user = $id_user;
        $post->id_postingan = $id_postingan;
        $post->isi_komentar = $request->isi_komentar;
        $post->save();
        return response()->json(['data has been created'=>$post],201);
    }


}
