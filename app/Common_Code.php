<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Common_Code extends Model
{
    protected  $fillable = [
    	'CD',
	    'CD_NM',
    ];

	/***************************************
	 * @
	 * @ description notices 테이블과 관계 (공지사항 공통코드)
	 * @ return hasMany
	 ***************************************/
    public function notice_code(){

    	return $this->hasMany(Notice::class);
    }
}
