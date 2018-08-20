<style>

    .form-control{
        width: 80%;
        margin-left: 5%;
    }

    .sub{
        display: none;
    }
</style>

<div class="media media__create__comment {{ isset($parentId) ? 'sub' : 'top' }}">

    <div class="media-body">
        <form method="POST" action="{{ route('notice.comments.store', $notice->id) }}" class="form-horizontal">
            {!! csrf_field() !!}

            @if(isset($parentId))
                <input type="hidden" name="parent_id" value="{{ $parentId }}">
            @endif

            <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                <textarea name="content" class="form-control">{{ old('content') }}</textarea>
                {!! $errors->first('content', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary btn-sm">
                    댓글작성
                </button>
            </div>
        </form>
    </div>
</div>