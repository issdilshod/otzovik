@extends('admin.layouts.default')

@section('content')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.css') }}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
                @if(isset($article))
                    {{__('article_edit_title')}} <b></b>
                @else
                    {{__('article_add_title')}}
                @endif   
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><?=__('menu_dashboard_title')?></a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/blog/articles') }}"><?=__('menu_articles_title')?></a></li>
                <li class="breadcrumb-item active">
                    @if(isset($article))
                        <?=__('article_edit_title')?>
                    @else
                        <?=__('article_add_title')?>
                    @endif
                </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{__('article_card_title')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{url('admin/blog/article')}}@isset($article->id){{ '/'.$article->id }}@endisset" method="post" enctype="multipart/form-data">
                            @csrf
                            @isset($article->id)
                            <input type="hidden" name="id" value="{{$article->id}}" />
                            <input type="hidden" name="_method" value="put" />
                            @endisset
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="cover1">{{__('article_cover')}}</label>
                                    <input name="cover" type="file" class="form-control" id="cover1">
                                    @isset($article->cover)
                                    <img class="mt-2" src="{{ asset('storage/'.$article->cover) }}" width="100%"/>
                                    @endisset
                                </div>

                                <div class="form-group">
                                    <label for="title1">{{__('article_title')}}</label>
                                    <input name="title" class="form-control" id="title1" value="@isset($article->title){{ $article->title }}@endisset">
                                </div>

                                <div class="form-group">
                                    <label for="text1">{{__('article_text')}}</label>
                                    <textarea class="form-control" name="text" id="text1" style="height: 300px">@isset($article->text){{ $article->text }}@endisset</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="slug1">{{__('article_slug')}}</label>
                                    <input name="slug" class="form-control" id="slug1" value="@isset($article->slug){{ $article->slug }}@endisset">
                                </div>

                                <div class="form-group">
                                    <label for="tit1">Title</label>
                                    <input name="tit" class="form-control" id="tit1" value="@isset($article->seo){{ $article->seo->title }}@endisset">
                                </div>

                                <div class="form-group">
                                    <label for="descript1">Description</label>
                                    <textarea class="form-control" id="descript1" name="descript">@isset($article->seo){{ $article->seo->description }}@endisset</textarea>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">{{__('global_save_button')}}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Summernote -->
<script src="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
$(function () {
    // Summernote
    $('#text1').summernote();
})
</script>
@stop