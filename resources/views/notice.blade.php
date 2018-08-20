{{--/**
 * Created by PhpStorm.
 * User: dongeon
 * Date: 18. 7. 2
 * Time: 오전 11:35
 */--}}

@extends('layouts.dashboard')
@section('page_heading','공지사항')

@section('section')
    <div class="col-sm-12">

        <div class="row">
            <div class="col-sm-12">
                @section ('cotable_panel_title','공지합니다!')
                @section ('cotable_panel_body')
                @include('widgets.notice', array('class'=>'notice'))
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
            </div>
        </div>

        <div class="btn btn-group" style="width: 100%;">
            <button class="btn btn-default" style="float: right;" onclick="fn_create_link()">작성하기</button>
        </div>
    </div>
@stop

<script>

    var fn_create_link = function () {

        return window.location.href='create_notice';
    }
</script>