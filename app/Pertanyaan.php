<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Jawaban;
use App\User;
class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';
    protected $primaryKey ='id_pertanyaan';

    public function user(){
        return $this->belongsTo('App\User','id_user');
    }
    public function jawaban(){
        return $this->hasOne('App\Jawaban','id_pertanyaan');
    }
    // public function qna(){
    //     return $this
    // }
    // public function userJawab(){
    //     return Jawaban::belongsTo('App\User','id_user');
    // }
}
