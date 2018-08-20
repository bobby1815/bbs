{{--
/**
 * Created by PhpStorm.
 * User: dongeon
 * Date: 18. 7. 2
 * Time: 오후 2:17
 * Use : 목록
 */--}}
<?php $i =1;?>

@section ('cotable_panel_body')
@section ('cotable_panel_title','공지합니다!')
<style>
    th{
        text-align: center;
    }
    </style>

<div style="width: 100%; margin-bottom: 3%">
    <form action="get"  action="{{route('notice.index')}}" role="search">
    <button type="submit" class="btn btn-default" style="float: right;">검색</button>
    <input type="text" id="q" name="q" placeholder="검색어를 입력하세요." style="height: 3.5%; width: 30%; float: right; margin-right: 1%;">
    </form>
</div>

<table class="table table-bordered {{$class}}">
    <thead>
    <colgroup>
        <col style="width:5%;">
        <col style="width:5%;">
        <col style="width:50%;">
        <col style="width:15%;">
        <col style="width:15%;">
        <col style="width:10%;">
    </colgroup>
    <tr class="success">
        <th>No</th>
        <th>구 분</th>
        <th>제목</th>
        <th>작성일</th>
        <th>작성자</th>
        <th>조회수</th>
    </tr>
    </thead>
    <tbody>
    @forelse($notices as $notice)
        <tr class="">
            <td style="color: #df8a13;text-align: center;">{{$i++}}</td>
            <td style="text-align: center;">{{$notice->bbs_sttus}}</td>
            <td><a href="{{route('notice.show', $notice->id)}}">{{$notice->title }}</a></td>
            <td style="text-align: center;">{{$notice->created_at}}</td>
            <td style="text-align: center;">{{$notice->user["email"]}}</td>
            <td style="text-align: center;">{{$notice->view_count}}</td>
        </tr>
    @empty
        <p class="text-center text-danger">공지사항이 존재 하지 않습니다.</p>
    @endforelse
    </tbody>

</table>
@endsection
