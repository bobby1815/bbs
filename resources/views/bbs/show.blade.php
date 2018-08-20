{{--/**
 * Created by PhpStorm.
 * User: dongeon
 * Date: 18. 7. 2
 * Time: 오전 11:35
 */--}}

@extends('layouts.dashboard')
@section('page_heading','공지사항')

@section('section')
    @php $viewName = 'notice.show'; @endphp
    <div class="col-sm-12" style="position: relative !important;">

        <div class="row">
            <div class="col-sm-12">
                @include('bbs.partial.form', array('class'=>'form'))


                @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
                <div class="col-md-7 col-md-offset-5">
                    <button type="button" class="btn btn-primary" onclick="fn_create_link(); return false;">
                        수정하기
                    </button>
                    <button type="button" class="btn btn-danger" id="delete" name="delete">
                        삭제하기
                    </button>
                    <button type="button" class="btn btn-default" onclick="window.location.href='{{url('/notice')}}'">
                        돌아가기
                    </button>
                </div>

                <div class="" style="width: 90%; margin-left: 5%;">
                    @include('comments.index')
                </div>

            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /**********************************************************
         * @description 공지사항 삭제 Ajax
         * @returns  json
         **********************************************************/
        $('#delete').on('click',function () {

            var noticeId = $('article').data('id');
            console.log('Value Id Check ===>',noticeId);

            if(confirm("삭제하시겠습니까?")){
                $.ajax({
                    type : 'DELETE',
                    url  : '/notice/'+noticeId
                }).then(function () {
                    window.location.href = '/notice';
                })
            }
        });
        // document Ready End
    });

    /**********************************************************
     * @description 수정폼으로 이동
     * @returns  view / edit.blade.php
     **********************************************************/
    var fn_create_link = function () {

        return window.location.href='{{route('notice.edit',$notice->id)}}';
    };



    </script>

