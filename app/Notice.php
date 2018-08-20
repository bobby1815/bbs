<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'use_yn', 'title','content','view_content','bbs_sttus',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/***************************************
	 * @
	 * @ description users 테이블 관계 (사용자)
	 * @ return belongsTo
	 ***************************************/
	public function user(){

		return $this->belongsTo(User::class);
	}

	/***************************************
	 * @
	 * @ description common_codes 테이블 관계(공통코드)
	 * @ return belongsTo
	 ***************************************/
	public function common_code(){
		return $this->hasOne(Common_Code::class, 'bbs_sttus', 'CD');
	}

	/***************************************
	 * @
	 * @ description comments 테이블 관계 (댓글)
	 * @ return morphMany (다형적 연결)
	 ***************************************/
	public function comments(){

		return $this->morphMany(Comment::class,'commentable');
	}

	/***************************************
	 * @
	 * @ description attachments 테이블 관계 (댓글)
	 * @ return hasMany
	 ***************************************/
	public  function attachments(){

		return $this->hasMany(Attachment::class);
	}

	/***************************************
	 * @
	 * @ description Comment 테이블 튜플 총 갯수
	 * @ return count()
	 ***************************************/
	public function getCommentCountAttribute(){

		return (int)    $this->comments()->count();
	}
}
