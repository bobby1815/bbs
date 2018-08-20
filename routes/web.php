<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	Route::get('/', function () {
		return view('login');
	});

	Route::get('/home', function () {
	    return view('home');
	});

	Route::get('/charts', function () {
		return view('mcharts');
	});

	Route::get('/tables', function () {
		return view('table');
	});

	Route::get('/forms', function () {
		return view('form');
	});

	Route::get('/panels', function () {
		return view('panel');
	});
	Route::get('/buttons', function () {
		return view('buttons');
	});

	Route::get('/notifications', function () {
		return view('notifications');
	});
	Route::get('/typography', function () {
		return view('typography');
	});

	Route::get('/icons', function () {
		return view('icons');
	});

	Route::get('/grid', function () {
		return view('grid');
	});

	Route::get('/blank', function () {
		return view('blank');
	});

	Route::get('/documentation', function () {
		return view('documentation');
	});


	Route::get('/faq', function () {
		return view('faq');
	});

	Route::get('/inqry', function () {
		return view('inqry');
	});

	Route::get('/guideline', function () {
		return view('guideline');
	});

	Route::get('/reset', function(){
		return view('auth/reset');
	});


	Route::get('/create_notice', function(){
		return view('bbs/create');
	});



	/**회원 가입*/

	Route::get('/register', [
		'as'    =>'register.index',
		'uses'  => 'Auth\RegisterController@index'
	]);

	Route::post('/register',[
		'as'    => 'register.create',
		'uses'  => 'Auth\RegisterController@create'
	]);

	Route::get('/register/{code}',[
		'as'    => 'register.confirm',
		'uses'  => 'Auth\RegisterController@confirm'
	]);

	/**로그인*/

	Route::get('/login',[
		'as'    => 'login.index',
		'uses'  => 'Auth\LoginController@index',
	]);

	Route::post('/login',[
		'as'    => 'login.create',
		'uses'  =>  'Auth\LoginController@create',
	]);

	Route::get('/logout',[
		'as'    => 'logout.destroy',
		'uses'  => 'Auth\LoginController@destroy'
	]);

	/**게시판 작성*/

	Route::resource('notice','NoticesController');

	/**댓글 작성*/
	Route::resource('comments','CommentsController',['only' =>['update','destroy']]);

	Route::resource('notice.comments','CommentsController',['only' =>['store']]);

	/**파일 업로드*/

	Route::resource('attachments','AttachmentsController',['only'=>['store','destroy']]);


	/***********************************************
	 *
	 * @description File upload Extra
	 ***********************************************/
	Route::get('attachments/{file}', 'AttachmentsController@show');

