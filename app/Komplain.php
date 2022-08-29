<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Komplain;
use App\Balasan;
class Komplain extends Model
{
    protected $table = 'komplain';
    protected $primaryKey = 'id_komplain_saran';

    public function user(){
        return $this->belongsTo('App\User','id_user');
    }

    public function userBalasan(){
        return $this->hasOne('App\User','id_user');
    }

    public function balasan(){
        return $this->hasOne('App\Balasan','id_komplain_saran');
    }

}
