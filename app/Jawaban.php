<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pertanyaan;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $primaryKey = 'id_jawaban';

    public function Pertanyaan(){
        return $this->belongsTo('App\Pertanyaan','id_pertanyaan');
    }
    public function user(){
        return $this->belongsTo('App\User','id_user');
    }
    
}
