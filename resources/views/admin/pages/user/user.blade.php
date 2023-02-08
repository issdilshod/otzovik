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
                @if(isset($user->id))
                    {{__('staff_edit_title')}} <b>{{$user->first_name . ' ' . $user->last_name}}</b>
                @else
                    {{__('staff_add_title')}}
                @endif   
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><?=__('menu_dashboard_title')?></a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/users') }}"><?=__('menu_staff_title')?></a></li>
                <li class="breadcrumb-item active">
                    @if(isset($user->id))
                        <?=__('staff_edit_title')?>
                    @else
                        <?=__('staff_add_title')?>
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
                            <h3 class="card-title">{{__('staff_card_title')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{url('admin/user')}}@isset($user->id){{ '/'.$user->id }}@endisset" method="post">
                            @csrf
                            @isset($user->id)
                            <input type="hidden" name="id" value="{{$user->id}}" />
                            <input type="hidden" name="_method" value="put" />
                            @endisset
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name1">{{__('staff_first_name')}}</label>
                                    <input name="first_name" class="form-control" id="first_name1" value="@isset($user->first_name){{ $user->first_name }}@endisset">
                                </div>

                                <div class="form-group">
                                    <label for="last_name1">{{__('staff_last_name')}}</label>
                                    <input name="last_name" class="form-control" id="last_name1" value="@isset($user->last_name){{ $user->last_name }}@endisset">
                                </div>

                                <!--div class="form-group">
                                    <label for="phone1">{{__('staff_phone')}}</label>
                                    <input name="phone" class="form-control" id="phone1" value="@isset($user->phone){{ $user->phone }}@endisset">
                                </div-->

                                <div class="form-group">
                                    <label for="role1">{{__('staff_role')}}</label>
                                    <select class="form-control" name="role" id="role1">
                                        <option value="">-</option>
                                        @foreach ($roles as $key => $value)
                                            <option value="{{$value}}" <?php if(isset($user->role) && $user->role==$value){ echo 'selected'; } ?> >{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="email1">{{__('staff_email')}}</label>
                                    <input name="email" class="form-control" id="email1" value="@isset($user->email){{ $user->email }}@endisset">
                                </div>

                                <div class="form-group">
                                    <label for="password1">{{__('staff_password')}}</label>
                                    <input name="password" class="form-control" id="password1">
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