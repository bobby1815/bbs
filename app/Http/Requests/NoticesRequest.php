<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticesRequest extends FormRequest
{


	protected $dontFlash = ['files'];
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
	        'title'     => ['required'],
	        'content'   =>['required','min:10'],
	        'files'     =>['array'],
	        'files.*'   =>['mimes:jpg,png,zip,tar','max:30000'],
        ];
    }

    public function messages(){

    	return [
		    'required'    => ':attribute은(는) 필수 입력 사항 입니다.',
		    'min'         => ':attribute은(는) :min자 이상으로 입력해 주십시오.'
	    ];
    }

    public function attribute(){

    	return [
    		'title' => '제목',
		    'content'   => '본문(내용)',
	    ];
    }
}
