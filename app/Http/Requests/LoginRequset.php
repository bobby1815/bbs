<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequset extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     =>['required'],
	        'password'  =>['required']
        ];
    }

    public function messages(){

    	return [
    		'required'      => ':attribute을 입력해주세요.',
		    'min'           => ':attrivute는 최소 :min 자 이상입니다.'
	    ];
    }

    public function attribute(){

    	return [
			'email'     => '아이디(이메일)',
		    'password'  => '비밀번호',
	    ];
    }
}
