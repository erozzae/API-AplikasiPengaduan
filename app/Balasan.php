<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Komplain;
use App\User;

class Balasan extends Model
{
    protected $table = 'balasan';
    protected $primaryKey = 'id_balasan';
    
    public function komplain(){
        return $this->belongsTo('App\Komplain','id_komplain_saran');
    }

    public function userBalasan(){
        return $this->belongsTo('App\User','id_user');
    }
    
}
