@extends('layouts.plane')
<style>

    .container-fluid{
        margin-top: 10%;
    }

    textarea{
        width: 100%;
        height: 300px;
    }

</style>
@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">공지사항</div>
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

                            <form class="form-horizontal" role="form" method="POST" action="{{route('notice.update',$notice->id)}}">
                                {!! csrf_field() !!}
                                {!! method_field('PUT') !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-1 control-label">구분</label>
                                <div class="col-md-11">
                                    <select name="bbs_sttus" id="bbs_sttus" style="background-color: white; width: 20%; height:4%">
                                        <option value="N">공지</option>
                                        <option value="I">1:1</option>
                                        <option value="F">자유</option>
                                        <option value="D">개발</option>
                                        <option value="T">테스트</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-1 control-label">제목</label>
                                <div class="col-md-11">
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title',$notice->title) }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-1 control-label">내용</label>
                                <div class="col-md-11">
                                    <textarea name="content" id="content" >{{old('content',$notice->content)}}</textarea>
                                </div>
                            </div>

                        <div class="col-md-7 col-md-offset-5">
                            <button type="submit" class="btn btn-primary">
                                수정하기
                            </button>
                            <button type="button" class="btn btn-danger" onclick="fn_reset(); return false">
                                다시쓰기
                            </button>
                            <button type="button" class="btn btn-default" onclick="window.location.href='{{url('/notice')}}'">
                                돌아가기
                            </button>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>

    $(document).ready(function(){
        var bs = '{{$notice->bbs_sttus}}';

        console.log("value check    ============> ", bs);

        $('#bbs_sttus').val('{{$notice->bbs_sttus}}').attr('selected',true);
    });
    /**
     *
     *@description 다시쓰기
     */
    var fn_reset = function () {
        $('#title').val('');
        $('#content').val('');
    }


</script>
