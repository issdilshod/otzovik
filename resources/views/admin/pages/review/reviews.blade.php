@extends('admin.layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{__('reviews_title')}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><?=__('menu_dashboard_title')?></a></li>
                <li class="breadcrumb-item active"><?=__('reviews_title')?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h3 class="card-title mr-auto">{{__('reviews_list_title')}}</h3>

                        <div class="d-flex">
                            <div style="width: 150px;">
                                <form class="input-group input-group-sm d-flex" action="{{url('admin/reviews')}}" method="get">
                                    <input type="text" name="q" class="form-control" placeholder="{{__('global_search_title')}}" value="{{$q}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="ml-2">
                                <a class="btn btn-sm btn-primary" href="{{url('admin/review')}}">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>{{__('global_id')}}</th>
                                <th>
                                    <div class="d-flex d-sort" data-sort="<?php if ($f=='user-asc'){ echo 'user-desc'; }else{ echo 'user-asc'; }?>">
                                        <div>{{__('review_user')}}</div>
                                        @if($f=='user-asc' || $f=='user-desc')
                                        <div class="ml-auto d-label">
                                            @if($f=='user-asc')
                                            <i class="fa fa-angle-down"></i>
                                            @endif
                                            @if($f=='user-desc')
                                            <i class="fa fa-angle-up"></i>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </th>
                                <th>
                                    <div class="d-flex d-sort" data-sort="<?php if ($f=='university-asc'){ echo 'university-desc'; }else{ echo 'university-asc'; }?>">
                                        <div>{{__('review_university')}}</div>
                                        @if($f=='university-asc' || $f=='university-desc')
                                        <div class="ml-auto d-label">
                                            @if($f=='university-asc')
                                            <i class="fa fa-angle-down"></i>
                                            @endif
                                            @if($f=='university-desc')
                                            <i class="fa fa-angle-up"></i>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </th>
                                <th>
                                    <div class="d-flex d-sort" data-sort="<?php if ($f=='created_at-asc'){ echo 'created_at-desc'; }else{ echo 'created_at-asc'; }?>">
                                        <div>{{__('global_created_at')}}</div>
                                        @if($f=='created_at-asc' || $f=='created_at-desc')
                                        <div class="ml-auto d-label">
                                            @if($f=='created_at-asc')
                                            <i class="fa fa-angle-down"></i>
                                            @endif
                                            @if($f=='created_at-desc')
                                            <i class="fa fa-angle-up"></i>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </th>
                                <th>
                                    <div class="d-flex d-sort-multi">
                                        <div>{{__('global_status')}}</div>
                                        <div class="ml-auto">
                                            <select class="form-control p-0" style="height:auto">
                                                <option value="">-</option>
                                                <option value="status-{{$status['wait']}}" <?php if ($f=='status-'.$status['wait']){ echo 'selected'; } ?>>{{__('global_waiting')}}</option>
                                                <option value="status-{{$status['active']}}" <?php if ($f=='status-'.$status['active']){ echo 'selected'; } ?>>{{__('global_active')}}</option>
                                                <option value="status-{{$status['block']}}" <?php if ($f=='status-'.$status['block']){ echo 'selected'; } ?>>{{__('global_block')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </th>
                                <th>{{__('global_actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $key => $value)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><img src="@if ($value->user_avatar){{ asset('storage/'.$value->user_avatar) }}@else{{'https://cdn-icons-png.flaticon.com/512/847/847969.png'}}@endif" width="40px" /> {{$value->user_first_name}} {{$value->user_last_name}}</td>
                                    <td><img src="{{ asset('storage/'.$value->university_logo) }}" width="40px" /> {{$value->university_name}}</td>
                                    <td>{{$value->created_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if ($value->status==$status['wait'])
                                                <span class="badge badge-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{__('global_waiting')}}</span>
                                            @elseif ($value->status==$status['active'])
                                                <span class="badge badge-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{__('global_active')}}</span>
                                            @elseif ($value->status==$status['block'])
                                                <span class="badge badge-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{__('global_block')}}</span>
                                            @endif
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item status-items" data-url="{{url('admin/review/'.$value->id.'/status')}}" data-id="{{$value->id}}" data-status="{{$status['wait']}}">{{__('global_waiting')}}</a>
                                                <a class="dropdown-item status-items" data-url="{{url('admin/review/'.$value->id.'/status')}}" data-id="{{$value->id}}" data-status="{{$status['active']}}">{{__('global_active')}}</a>
                                                <a class="dropdown-item status-items" data-url="{{url('admin/review/'.$value->id.'/status')}}" data-id="{{$value->id}}" data-status="{{$status['block']}}">{{__('global_block')}}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="d-flex">
                                            <div class="ml-auto">
                                                <a href="{{url('admin/review/'.$value->id)}}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pen" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <form class="ml-1" action="{{url('admin/review/'.$value->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete" />
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            @include('admin.components.pagination')

        </div>
      </div>
    </section>
</div>
@stop