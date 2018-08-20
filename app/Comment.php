<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    	'commentable_type',
	    'commentable_id',
	    'user_id',
	    'parent_id',
	    'content',
    ];

    protected $with = ['user',];

	/***************************************
	 * @
	 * @ description user 테이블과 관계 (사용자)
	 * @ return belongsTo
	 ***************************************/
    public function user(){

    	return $this->belongsTo(User::class);
    }

	/***************************************
	 * @
	 * @ description notices 테이블과 관계(댓글)
	 * @ return morphTo (다형적)
	 ***************************************/
    public function commentable(){

    	return $this->morphTo();
    }

	/***************************************
	 * @
	 * @ description comments 테이블관 관계 (답글)
	 * @ return hasMany (자기자신)
	 ***************************************/
    public function replies(){

    	return $this->hasMany(Comment::class, 'parent_id')->latest();
    }

	/***************************************
	 * @
	 * @ description comments 테이블과 관계()
	 * @ return belongsTo (자기 자신)
	 ***************************************/
    public function parent(){

    	return $this->belongsTo(Comment::class, 'parent_id','id');
    }
}
