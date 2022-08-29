<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//controller
//auth
use App\Http\Controllers\AuthTokenApi\LoginController;
use App\Http\Controllers\AuthTokenApi\LogoutController;
use App\Http\Controllers\AuthTokenApi\RegisterController;
//Admin
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KomplainAdminController;
use App\Http\Controllers\Admin\QnAAdminController;
//User
use App\Http\Controllers\User\ProfilController;
use App\Http\Controllers\User\KomplainController;
use App\Http\Controllers\User\QnAController;
use App\Http\Controllers\User\ForumController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/auth')->group(function(){
    Route::post('/login',[LoginController::class,'login']);
    Route::post('/logout',[LogoutController::class,'logout']);
    Route::post('/register',[RegisterController::class,'register']);
});

Route::group(['namespace'=>'Admin','prefix'=>'admin'],function(){
    //user
    Route::get('/users',[UserController::class,'users']);
    Route::post('/user/store',[UserController::class,'store']);
    Route::post('/user/update/{id}',[UserController::class,'update']);
    Route::post('/user/delete/{id}',[UserController::class,'delete']);
    //komplain
    Route::get('komplains',[KomplainAdminController::class,'komplains']);
    Route::get('komplain/{id}',[KomplainAdminController::class,'komplain']);
    //balasan
    Route::post('komplain/balasan/{id_komplain_saran}/{id_user}',[KomplainAdminController::class,'balasan']);
    Route::post('komplain/balasan/update/{id_balasan}/{id_user}',[KomplainAdminController::class,'updateBalasan']);
    //QnA
    Route::get('qna',[QnAAdminController::class,'allQna']);
    //Jawaban
    Route::post('jawaban/{id_pertanyaan}/{id_user}',[QnAAdminController::class,'storeJawab']);
    Route::delete('jawaban/delete/{id}',[QnAAdminController::class,'deleteJawab']);
    //pertanyaan
    Route::post('pertanyaan/delete/{id}',[QnAAdminController::class,'deleteTanya']);
});

Route::group(['namespace'=>'User','prefix'=>'user'],function(){
    //user
    Route::get('/profil/{id}',[ProfilController::class,'profil']);
    Route::post('/profil/update/{id}',[ProfilController::class,'update']);
    Route::post('/komplain/store/{id}',[KomplainController::class,'store']);
    //komplain
    Route::get('komplain/{id}',[KomplainController::class,'komplain']);
    Route::get('komplain/usersKomplain/{id_user}',[KomplainController::class,'userskomplain']);
    //QnA
    Route::get('qna',[QnAController::class,'allQna']);
    //pertanyaan
    Route::post('pertanyaan/store/{id}',[QnAController::class,'storeTanya']);
    //Forum
    Route::get('forum/detail/{id_postingan}',[ForumController::class,'forum_detail']);
    Route::get('forum/posts',[ForumController::class,'posts']);
    Route::get('forum/{id_postingan}',[ForumController::class,'forum']);
    //postingan
    Route::post('postingan/store/{id_user}',[ForumController::class,'storePost']);
    Route::post('postingan/delete/{id_postingan}',[ForumController::class,'deletePost']);
    Route::post('postingan/update/{id_postingan}',[ForumController::class,'updatePost']);
    //komentar
    Route::post('komentar/store/{id_user}/{id_postingan}',[ForumController::class,'storeKomen']);
    Route::post('komentar/delete/{id_komentar}',[ForumController::class,'deleteKomen']);
});