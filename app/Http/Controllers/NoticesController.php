<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoticesController extends Controller
{

	/*protected function __construct () {

		$this->middleware('auth', ['except' => ['index', 'show']]);
	}*/

	/***********************************************************
	 *
	 * @description 공지사항 목록
	 * @return bbs/index.blade.php
	 ***********************************************************/
	public function index(Request $request, $slug = null){

		$cacheKey = cache_key('articles.index');

		$query = $slug
			? \App\Tag::whereSlug($slug)->firstOrFail()->articles()
			: new \App\Notice;

		$query = $query->orderBy(
			$request->input('sort', 'created_at'),
			$request->input('order', 'desc')
		);



		if ($keyword = request()->input('q')) {
			$raw = 'MATCH(title,content) AGAINST(? IN BOOLEAN MODE)';
			$query = $query->whereRaw($raw, [$keyword]);
		}

		$notices = $query->paginate(10);

		return view('bbs.index' , compact('notices'));
	}

	/***********************************************************
	 *
	 * @description 공지사항 작성 view
	 * @return bbs/create.blade.php
	 ***********************************************************/
	public function create(){

		$notices = new \App\Notice;

		return view('bbs.create', compact('notices'));
	}

	/***********************************************************
	 * @params  Requset $request
	 * @description 공지사항 작성 Action
	 * @return bbs/index.blade.php
	 ***********************************************************/
	public function store(\App\Http\Requests\NoticesRequest $request){

		$user = $request->user();

		$notice = $user->notices()->create($request->all());

		if(!$notice){
			return back()->withErrors('flash_message', $request->bbs_sttus . '글 등록에 실패하였습니다. 다시시도 해주십시오');
		}

        if ($request->hasFile('files')) {
	        // 파일 저장
	        $files = $request->file('files');

	        foreach ($files as $file) {
		        $filename = str_random() . filter_var($file->getClientOriginalName() , FILTER_SANITIZE_URL);

		        $notice->attachments()->create([
			        'filename' => $filename ,
			        'bytes' => $file->getSize() ,
			        'mime' => $file->getClientMimeType()
		        ]);
	        }
        }

		return redirect(route('notice.index'))->with('flash_message','작성하신 글이 저장되었습니다.');
	}

	/***********************************************************
	 * @params Notice
	 * @description 공지사항 상세
	 * @return bbs/show.blade.php
	 ***********************************************************/
	public function show(\App\Notice $notice){

		$notice->view_count +=1;
		$notice->save();

		$comments = $notice->comments()->with('replies')->whereNull('parent_id')->latest()->get();

		return view('bbs.show', compact('notice','comments'));
	}

	/***********************************************************
	 * @params  Notice
	 * @description 공지사항 수정 view
	 * @return bbs/edit.blade.php
	 ***********************************************************/
	public function edit(\App\Notice $notice){

		return view('bbs.edit', compact('notice'));
	}

	/***********************************************************
	 * @params  Requset
	 * @description 공지사항 수정 Action
	 * @return
	 ***********************************************************/
	public function update(\App\Http\Requests\NoticesRequest $request , \App\Notice $notice){

		$this->authorize('update',$notice);

		$notice->update($request->all());

		return redirect(route('notice.show',$notice->id));
	}

	/***********************************************************
	 *
	 * @description 공지사항 삭제 Ajax
	 * @return json
	 ***********************************************************/
	public function destroy(\App\Notice $notice)
	{
		$this->authorize('delete', $notice);

		$notice->delete();
		return response()->json([], 204);
	}

}
