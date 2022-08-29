<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Komplain;
use App\Pertanyaan;
use App\Jawaban;
use App\Komentar;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','gambar','level','posisi'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
    public function komplain(){
        return $this->hasMany('App\Komplain','id_user');
    }
    
    public function pertanyaan(){
        return $this->hasMany('App\Pertanyaan','id_user');
    }

    public function jawaban(){
        return $this->hasMany('App\Jawaban','id_user');
    }

    public function postingan(){
        return $this->hasMany('App\Postingan','id_user');
    }

    public function komentar(){
        return $this->hasMany('App\Komentar','id_user');
    }

}
