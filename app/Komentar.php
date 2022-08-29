<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $primaryKey ='id_komentar';

    public function user(){
        return $this->belongsTo('App\User','id_user');
    }
    public function postingan(){
        return $this->belongsTo('App\User','id_postingan');
    }
}
