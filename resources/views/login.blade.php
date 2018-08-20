@extends ('layouts.plane')
@section ('body')
    <style>
        body{
            background-image: url('/images/back_y.jpg');
        }
    </style>
    <div class="container" >
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <br /><br /><br />
                   @section ('login_panel_title','로그인해주세요!')
                   @section ('login_panel_body')
                            <form action="{{route('login.create')}}" role="form" method="POST">
                                {!! csrf_field() !!}
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="이메일" name="email" type="email" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="비밀번호" name="password" type="password" value="">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">비빌번호 기억하기
                                        </label>
                                    </div>
                                </fieldset>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">로그인</button><br/>
                                <a href="{{url('/reset')}}"><small>비밀번호를 잃어버리셨나요?</small></a><br/>
                                <a href="{{route('register.index')}}"><small>회원이 아니신가요?</small></a>
                            </form>
                </div>
            </div>
    </div>
    @endsection
    @include('widgets.panel', array('as'=>'login', 'header'=>true))
@stop