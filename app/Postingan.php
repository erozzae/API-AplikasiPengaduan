<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Komentar;
use App\User;
class Postingan extends Model
{
    protected $table = 'postingan';
    protected $primaryKey ='id_postingan';

    public function user(){
        return $this->belongsTo('App\User','id_user');
    }

    public function komentar(){
        return $this->hasMany('App\Komentar','id_postingan')->orderBy('updated_at','desc');
    }
}
