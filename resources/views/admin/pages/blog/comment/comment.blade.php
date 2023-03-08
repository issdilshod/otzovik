@extends('admin.layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
                @if(isset($comment))
                    {{__('comment_edit_title')}} <b></b>
                @else
                    {{__('comment_add_title')}}
                @endif   
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><?=__('menu_dashboard_title')?></a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/blog/comments') }}"><?=__('menu_comments_title')?></a></li>
                <li class="breadcrumb-item active">
                    @if(isset($comment))
                        <?=__('comment_edit_title')?>
                    @else
                        <?=__('comment_add_title')?>
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
                            <h3 class="card-title">{{__('comment_card_title')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{url('admin/blog/comment')}}@isset($comment->id){{ '/'.$comment->id }}@endisset" method="post">
                            @csrf
                            @isset($comment->id)
                            <input type="hidden" name="id" value="{{$comment->id}}" />
                            <input type="hidden" name="article_id" value="{{$comment->article_id}}" />
                            <input type="hidden" name="_method" value="put" />
                            @endisset
                            <div class="card-body">

                                @isset($comment->id)
                                <div class="form-group">
                                    <img src="@if ($comment->user_avatar){{ asset('storage/'.$comment->user_avatar) }}@else{{'https://cdn-icons-png.flaticon.com/512/847/847969.png'}}@endif" width="40px" /> {{$comment->user_first_name}} {{$comment->user_last_name}}
                                </div>
                                @endisset

                                @if ($comment->replay_id)
                                    <div class="form-group">
                                        <label>{{__('comment_answer')}}</label>
                                        <div>{{$comment->replay_user_first_name}} {{$comment->replay_user_last_name}}</div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label>{{__('comment_article')}}</label>
                                    <div>{{$comment->article_title}}</div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="star1">{{__('comment_star')}}</label>
                                    <select class="form-control" name="star" id="star1">
                                        @for ($i=0; $i <= 5; $i+=.5)
                                            <option value="{{$i}}" <?php if (isset($comment->star) && $comment->star==$i){ echo 'selected'; } ?>>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="text1">{{__('comment_text')}}</label>
                                    <textarea name="text" class="form-control" id="text1" style="height: 200px">@isset($comment->text){{ $comment->text }}@endisset</textarea>
                                </div>

                                <div lass="form-group">
                                    <label>{{__('global_status')}}</label>
                                    <select class="form-control" name="status">
                                        <?php $value = \Illuminate\Support\Facades\Config::get('status.active'); ?>
                                        <option value="{{$value}}" <?php if (isset($comment) && $comment->status==$value){ echo 'selected'; } ?>>{{\App\Services\Admin\Misc\SystemService::get_status_name_by_id($value)}}</option>

                                        <?php $value = \Illuminate\Support\Facades\Config::get('status.wait'); ?>
                                        <option value="{{$value}}" <?php if (isset($comment) && $comment->status==$value){ echo 'selected'; } ?>>{{\App\Services\Admin\Misc\SystemService::get_status_name_by_id($value)}}</option>

                                        <?php $value = \Illuminate\Support\Facades\Config::get('status.block'); ?>
                                        <option value="{{$value}}" <?php if (isset($comment) && $comment->status==$value){ echo 'selected'; } ?>>{{\App\Services\Admin\Misc\SystemService::get_status_name_by_id($value)}}</option>
                                    </select>
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
@stop