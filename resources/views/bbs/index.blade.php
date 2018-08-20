{{--/**
 * Created by PhpStorm.
 * User: dongeon
 * Date: 18. 7. 2
 * Time: 오전 11:35
 */--}}

@extends('layouts.dashboard')
@section('page_heading','공지사항')

@section('section')
    @php $viewName = 'notice.index'; @endphp
    <div class="col-sm-12" style="position: relative !important;">

        <div class="row">
            <div class="col-sm-12">
                    @include('bbs.partial.notice', array('class'=>'notice'))
                    @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
                <div class="text-center">
                    {!! $notices->render() !!}
                </div>
                <div class="btn btn-group" style="width: 100%;">
                    <button class="btn btn-default" style="float: right;" onclick="fn_create_link()">작성하기</button>
                </div>
            </div>
        </div>
    </div>
@stop
<script>

    var fn_create_link = function () {

        return window.location.href='notice/create';
    }
</script>