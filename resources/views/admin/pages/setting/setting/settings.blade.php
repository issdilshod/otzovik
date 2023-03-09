@extends('admin.layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @if (isset($seo))
    <div class="container-fluid">
        <div class="row">
            <input type="hidden" id="url" value="{{$seo->url}}" />
            <input type="hidden" id="token" value="{{$token}}" />
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" id="title" placeholder="Title" value="{{$seo->title}}" />
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="description" placeholder="Description">{{$seo->description}}</textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group text-right">
                    <div class="btn btn-primary save-seo">{{__('global_save_button')}}</div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @isset($directions)
    <div class="container-fluid mt-2 mb-2">
        <div class="row">
            <div class="col-sm-4 mt-1">
                <a href="{{url('admin/settings/templates/universities')}}" class="btn btn-block btn-<?php if ($d==''){echo 'primary';}else{echo 'default';}?> mr-2">
                    Все
                </a>
            </div>
            @foreach ($directions as $direction)
            <div class="col-sm-4 mt-1">
                <a href="{{url('admin/settings/templates/universities?d='.$direction->slug)}}" class="btn btn-block btn-<?php if ($d==$direction->slug){echo 'primary';}else{echo 'default';}?> mr-2">
                    {{$direction->name}}
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endisset


    <iframe 
        id="inlineFrameExample"
        title="Inline Frame Example"
        src="{{$src}}"
        style="height: calc(100vh)"
        width="100%"
        frameborder="0"
    ></iframe>
</div>
<script>
    // click save
    $(document).on('click', '.save-seo', function(){

        var url = $('#url').val();
        var title = $('#title').val();
        var description = $('#description').val();
        var token = $('#token').val();

        $.ajax({
            type: 'put',
            url: '<?=url('api/seo')?>/'+url,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+ token);
            },
            data: {
                title: title,
                description: description
            },
            success: function(res){
                console.log('success');
            }
        });
    })
</script>
@stop