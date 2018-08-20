<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{

	/****************************************
	 * @ params
	 * @ description
	 * @ return
	 ****************************************/
    public function __construct () {
    	$this->middleware('auth');
    }

	/****************************************
	 * @ params $request , $notice
	 * @ description
	 * @ return
	 ****************************************/
    public function store(\App\Http\Requests\CommentsRequest $request , \App\Notice $notice){

    	$comment = $notice->comments()->create(array_merge(
			$request->all(),
			['user_id' => $request->user()->id]
	    ));

    	flash()->success('작성하신 댓글을 등록하였습니다.');

    	return redirect(route('notice.show',$notice->id). '#comment_'.$comment->id);
    }

	/****************************************
	 * @ params
	 * @ description
	 * @ return
	 ****************************************/
    public function update(\App\Http\Requests\CommentsRequest $request, \App\Comment $comment){

    	$comment->update($request->all());
	    flash()->success('수정하신 내용을 저장했습니다.');
    	return redirect(route('notice.show',$comment->commentable->id).'#comment_'.$comment->id);
    }

	/****************************************
	 * @ params
	 * @ description
	 * @ return
	 ****************************************/
    public function destroy(\App\Comment $comment){

		$comment->delete();

		return response()->json([],204);
    }

}
