<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','phone_sttus','addr','use_yn'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $dates = [
    	'last_login',
    ];


	/***************************************
	 * @
	 * @ description notices 테이블과 관계
	 * @ return hasMany
	 ***************************************/
    public function notices(){

    	return $this->hasMany(Notice::class);
    }

	/***************************************
	 * @
	 * @ description comments 테이블과 관계
	 * @ return hasMany
	 ***************************************/
    public function comments(){

    	return $this->hasMany(Comment::class);
    }

	/***************************************
	 * @
	 * @ description 관리자 권한
	 * @ return boolean
	 ***************************************/
    public function isAdmin(){
    	return ($this->id ===1) ? true : false;
    }
}
