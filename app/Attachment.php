<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
	protected $fillable = ['filename','bytes','mime'];


	/***************************************
	 * @
	 * @ description notice 테이블 관계 (댓글)
	 * @ return belongsTo (다형적 연결)
	 ***************************************/
	public function notice(){

		return $this->belongsTo(Notice::class);
	}

	public function getBytesAttribute($value){

		return format_filesize($value);
	}

	public function getUrlAttribute(){

		return url('files/'.$this->filename);
	}
}
