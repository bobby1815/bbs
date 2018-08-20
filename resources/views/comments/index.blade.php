{{--

 * Created by PhpStorm.
 * User: dongeon
 * Date: 18. 7. 5
 * Time: 오전 9:58
--}}

@php
    $currentUser = auth()->user();
    $comments = $notice->comments;
@endphp

<style>

    .form__new__comment{
        width: 90%;
        margin-left: 5%;
    }

    .list_comment{
        width: 90%;
        margin-left: 5%;
    }
</style>

<div class="page-header">
    <h4>댓글</h4>
</div>

<div class="form__new__comment">
    @if($currentUser)
        @include('comments.partial.create')
    @else
        @include('comments.partial.login')
    @endif
</div>

<div class="list_comment" >
    @forelse($comments as $comment)
        @include('comments.partial.comment',[
            'parentId'  => $comment->id,
            'isReply'   => false,
        ])
    @empty
    @endforelse
</div>


    <script>

        $(document).ready(function(){

        });
        // 댓글 삭제 요청을 처리한다.
        $('.btn__delete__comment').on('click', function(e) {
            var commentId = $(this).closest('.item__comment').data('id'),
                noticeId = $('#item__article').data('id');
            if (confirm('삭제할까요?')) {
                $.ajax({
                    type: 'DELETE',
                    url: "/comments/" + commentId
                }).then(function() {
                    $('#comment_' + commentId).fadeOut(1000, function () { $(this).remove(); });
                });
            }
        });
        // 대댓글 폼을 토글한다.
        $('.btn__reply__comment').on('click', function(e) {
            var el__create = $(this).closest('.item__comment').find('.media__create__comment').first(),
                el__edit = $(this).closest('.item__comment').find('.media__edit__comment').first();
            el__edit.hide('fast');
            el__create.toggle('fast').end().find('textarea').focus();
        });
        // 댓글 수정 폼을 토글한다.
        $('.btn__edit__comment').on('click', function(e) {
            var el__create = $(this).closest('.item__comment').find('.media__create__comment').first(),
                el__edit = $(this).closest('.item__comment').find('.media__edit__comment').first();
            el__create.hide('fast');
            el__edit.toggle('fast').end().find('textarea').first().focus();
        });

        // Send save a vote request to the server
        $('.btn__vote__comment').on('click', function(e) {
            var self = $(this),
                commentId = self.closest('.item__comment').data('id');
            $.ajax({
                type: 'POST',
                url: '/comments/' + commentId + '/votes',
                data: {
                    vote: self.data('vote')
                }
            }).then(function (data) {
                self.find('span').html(data.value).fadeIn();
                self.attr('disabled', 'disabled');
                self.siblings().attr('disabled', 'disabled');
            });
        });
    </script>
