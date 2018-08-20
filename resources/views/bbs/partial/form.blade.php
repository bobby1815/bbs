{{--
/**
 * Created by PhpStorm.
 * User: dongeon
 * Date: 18. 7. 2
 * Time: 오후 2:17
 * Use : 상세
 */--}}
@section ('cotable_panel_body')
@section ('cotable_panel_title','')

<article data-id="{{$notice->id}}">
<div class="page-header">
    <p class="pull-right">등록일 : {{$notice->created_at}}</p>
    <h2>{{$notice->title}} / <small>{{$notice->bbs_sttus}}</small> </h2>
    <p class="pull-right">조회수 : {{$notice->view_count}}</p>
</div>

<div class="media-body">
    <h4 class="media-heading">
        <a href="{{ route('notice.show', $notice->id) }}">
            {{ $notice->content }}
        </a>
    </h4>
</div>
</article>

@if ($viewName === 'notice.show')
    @include('attachments.partial.list', ['attachments' => $notice->attachments])
@endif


@endsection


@section('script')
@endsection