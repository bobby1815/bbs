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

                        <form class="form-horizontal" role="form" method="POST" action="/notice">
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
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-1 control-label">내용</label>
                                <div class="col-md-11">
                                    <textarea name="content" id="content" >{{old('content')}}</textarea>
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="my-dropzone">첨부 파일
                            <small class="text-muted">
                                <i class="fa fa-chevron-down"></i>
                                열기
                            </small>
                            <small class="text-muted" style="display: none;">
                                <i class="fa fa-chevron-up"></i>
                                닫기
                            </small>
                        </label>
                    </div>
                    <div id="my-dropzone" class="dropzone"></div>
                </div>
                <div class="col-md-7 col-md-offset-5">
                    <button type="submit" class="btn btn-primary">
                        작성하기
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/js/dropzone.js"></script>
    <script>

        /**
         *
         *@description 다시쓰기
         */
        var fn_reset = function () {
            $('#title').val('');
            $('#content').val('');
        }

        var form = $('form').first(),
            dropzone  = $('div.dropzone'),
            dzControl = $('label[for=my-dropzone]>small');
        /* Dropzone */
        Dropzone.autoDiscover = false;
        // 드롭존 인스턴스 생성.
        var myDropzone = new Dropzone('div#my-dropzone', {
            url: '/attachments',
            paramName: 'files',
            maxFilesize: 3,
            acceptedFiles: '.{{ implode(',.', config('project.mimes')) }}',
            uploadMultiple: true,
            params: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                notice_id : '{{$notices->id}}',
            },
            dictDefaultMessage: '<div class="text-center text-muted">' +
            "<h2>첨부할 파일을 끌어다 놓으세요!</h2>" +
            "<p>(또는 클릭하셔도 됩니다.)</p></div>",
            dictFileTooBig: "파일당 최대 크기는 3MB입니다.",
            dictInvalidFileType: '{{ implode(',', config('project.mimes')) }} 파일만 가능합니다.',
            addRemoveLinks: true
        });
        // 파일 업로드 성공 이벤트 리스너.
        myDropzone.on('successmultiple', function(file, data) {
            for (var i= 0,len=data.length; i<len; i++) {
                // 책에 있는 'attachments[]' 숨은 필드 추가 로직을 별도 메서드로 추출했다.
                handleFormElement(data[i].id);
                // 책에 없는 내용
                // 성공한 파일 애트리뷰트를 파일 인스턴스에 추가
                file[i]._id = data[i].id;
                file[i]._name = data[i].filename;
                file[i]._url = data[i].url;
                // 책에 없는 내용
                // 이미 파일일 경우 handleContent() 호출.
                if (/^image/.test(data[i].mime)) {
                    handleContent('content', data[i].url);
                }
            }
        });
        // 파일 삭제 이벤트 리스너.
        myDropzone.on('removedfile', function(file) {
            // 사용자가 이미지를 삭제하면 UI의 DOM 레벨에서 사라진다.
            // 서버에서도 삭제해야 하므로 Ajax 요청한다.
            $.ajax({
                type: 'DELETE',
                url: '/attachments/' + file._id
            }).then(function(data) {
                handleFormElement(data.id, true);
                if (/^image/.test(data.mime)) {
                    handleContent('content', data.url, true);
                }
            })
        });
        // 'attachments[]' 숨은 필드를 만들거나 제거한다.
        var handleFormElement = function(id, remove) {
            if (remove) {
                $('input[name="attachments[]"][value="'+id+'"]').remove();
                return;
            }
            $('<input>', {
                type: 'hidden',
                name: 'attachments[]',
                value: id
            }).appendTo(form);
        }
        // 컨텐트 영역의 캐럿 위치에 이미지 마크다운을 삽입한다.
        var handleContent = function(objId, imgUrl, remove) {
            var caretPos = document.getElementById(objId).selectionStart;
            var content = $('#' + objId).val();
            var imgMarkdown = '![](' + imgUrl + ')';
            if (remove) {
                $('#' + objId).val(
                    content.replace(imgMarkdown, '')
                );
                return;
            }
            $('#' + objId).val(
                content.substring(0, caretPos) +
                imgMarkdown + '\n' +
                content.substring(caretPos)
            );
        };
        // 드롭존의 가시성을 토글한다.
        dzControl.on('click', function(e) {
            dropzone.fadeToggle(0);
            dzControl.fadeToggle(0);
        });
    </script>
@endsection
