@extends('layouts.plane')
@section('body')
	<style>
		body{
			background-image: url('/images/back_s.jpg');
		}
		.container-fluid{
			margin-top: 10%;
		}

	</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">회원가입</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" id="writeAction" role="form" method="POST" action="{{route('register.create')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">이름</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">이메일</label>
							<div class="col-md-6">
								<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">주 소</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="addr" name="addr" value="{{ old('addr') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">전화번호</label>
							<select name="phone_sttus" id="phone_sttus" class="control-label col-md-pull-1" style="background-color: white; border-radius: 2px">
								<option value="KT">KT</option>
								<option value="SKT">SKT</option>
								<option value="LGT">LGT</option>
							</select>
							<div class="col-md-4">
								<input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">비밀번호</label>
							<div class="col-md-6">
								<input type="password" class="form-control" id="password" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">비밀번호 확인</label>
							<div class="col-md-6">
								<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="button" class="btn btn-primary reg" id="reg" onclick="fn_test();">
									가입하기
								</button>
								<button type="button" class="btn btn-danger">
									다시쓰기
								</button>
								<button type="button" class="btn btn-default" onclick="window.location.href='{{url('/login')}}'">
									돌아가기
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

<script>

	var fn_test = function () {
        var a= $('#name').val();
        var b= $('#email').val();
        var c= $('#password').val();
        var d= $('#phone').val();
        var e= $('#phone_sttus').val();
        var f= $('#addr').val();
        console.log("value param check====================>",a,b,c,d,e,f);

		$('#writeAction').submit();
    }
</script>
