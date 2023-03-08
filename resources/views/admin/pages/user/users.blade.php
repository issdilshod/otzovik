@extends('admin.layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{__('staff_title')}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><?=__('menu_dashboard_title')?></a></li>
                <li class="breadcrumb-item active"><?=__('staff_title')?></li>
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
                        <h3 class="card-title mr-auto">{{__('staff_list_title')}}</h3>

                        <div class="d-flex">
                            <div style="width: 150px;">
                                <form class="input-group input-group-sm d-flex" action="{{url('admin/users')}}" method="get">
                                    <input type="text" name="q" class="form-control" placeholder="{{__('global_search_title')}}" value="{{$q}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="ml-2">
                                <a class="btn btn-sm btn-primary" href="{{url('admin/user')}}">
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
                                <th>{{__('staff_name')}}</th>
                                <th>{{__('staff_email')}}</th>
                                <th>{{__('staff_phone')}}</th>
                                <th>{{__('staff_role')}}</th>
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
                                <th>{{__('global_actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $key => $value)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <img src="@if ($value->avatar){{ asset('storage/'.$value->avatar) }}@else{{'https://cdn-icons-png.flaticon.com/512/847/847969.png'}}@endif" width="40px" />
                                        {{$value->first_name . ' ' . $value->last_name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->phone}}</td>
                                    <td>{{\App\Services\Admin\Misc\SystemService::get_role_name_by_id($value->role)}}</td>
                                    <td>{{\App\Services\Admin\Misc\SystemService::get_dateTime_human($value->created_at, true)}}</td>
                                    <td class="text-right">
                                        <div class="d-flex">
                                            <div class="ml-auto">
                                                <a href="{{url('admin/user/'.$value->id)}}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pen" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <form class="ml-1" action="{{url('admin/user/'.$value->id)}}" method="post">
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