<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
	    $this->middleware('guest',['except'=>'destroy']);
    }

    protected function index(){

    	return view('login');
    }


    protected function create(Request $request){

		$this->validate($request, [
		'email'     => 'required|email',
		'password'  => 'required|min:6',
		]);

		if(! auth()->attempt($request->only('email','password'),$request->has('remember'))){

			flash('이메일 또는 비밀번호가 맞지 않습니다.');
			return back()->withInput();
		}

		if(!auth()->user()->use_yn){
			auth()->logout();

			flash('탈퇴한 아이디입니다. 관리자에게 문의 바랍니다.');
			return back()->withInput();
		}

			flash(auth()->user()->name . ' 님 환영합니다.');
		return redirect()->intended('home');
    }

    protected function destroy(){
	    auth()->logout();

    	flash('로그아웃 처리되었습니다.');
    	return view('login');
    }
}
