@extends('admin.layouts.default')

@section('content')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
                @if(isset($university))
                    {{__('university_edit_title')}} <b>{{$university->name}}</b>
                @else
                    {{__('university_add_title')}}
                @endif   
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><?=__('menu_dashboard_title')?></a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/universities') }}"><?=__('menu_universities_title')?></a></li>
                <li class="breadcrumb-item active">
                    @if(isset($university))
                        <?=__('university_edit_title')?>
                    @else
                        <?=__('university_add_title')?>
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
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{__('university_card_title')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{url('admin/university')}}@isset($university->id){{ '/'.$university->id }}@endisset" method="post" enctype="multipart/form-data">
                            @csrf
                            @isset($university->id)
                            <input type="hidden" name="id" value="{{$university->id}}" />
                            <input type="hidden" name="_method" value="put" />
                            @endisset
                            <div class="card-body">

                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basic" data-toggle="pill" href="#basic1" role="tab" aria-controls="basic1" aria-selected="false">{{__('global_basic')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact" data-toggle="pill" href="#contact1" role="tab" aria-controls="contact1" aria-selected="false">{{__('global_contacts')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="setting" data-toggle="pill" href="#setting1" role="tab" aria-controls="setting1" aria-selected="false">{{__('global_settings')}}</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <!-- basic -->
                                    <div class="tab-pane fade active show" id="basic1" role="tabpanel" aria-labelledby="basic1">
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name1">{{__('university_name')}}</label>
                                                    <input name="name" class="form-control" id="name1" value="@isset($university->name){{ $university->name }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="worlds_rate1">{{__('university_worlds_rate')}}</label>
                                                    <input name="worlds_rate" class="form-control" id="worlds_rate1" value="@isset($university->worlds_rate){{ $university->worlds_rate }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="russian_rate1">{{__('university_russian_rate')}}</label>
                                                    <input name="russian_rate" class="form-control" id="russian_rate1" value="@isset($university->russian_rate){{ $university->russian_rate }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="index1">{{__('university_index')}}</label>
                                                    <input name="index" class="form-control" id="index1" value="@isset($university->index){{ $university->index }}@endisset">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description1">{{__('university_description')}}</label>
                                                    <textarea name="description" class="form-control" id="description1" style="height: 200px;">@isset($university->description){{ $university->description }}@endisset</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="logo1">{{__('university_logo')}}</label>
                                                    <input name="logo" type="file" class="form-control" id="logo1">
                                                </div>
                                                @isset($university->logo)
                                                <img src="{{ asset('storage/'.$university->logo) }}" width="200px"/>
                                                @endisset
                                            </div>
                                            <div class="col-md-4">
                                                <!-- cities from base -->
                                                <div class="form-group">
                                                    <label>{{__('university_city')}}</label>
                                                    <select class="city-select" data-placeholder="{{__('university_city_select')}}" style="width: 100%;" name="city_id">
                                                        @foreach ($cities as $city)
                                                            <option value="{{$city->id}}" <?php if (isset($university)&&$university->city_id==$city->id){ echo 'selected'; } ?>>{{$city->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="traning_period1">{{__('university_traning_period')}}</label>
                                                    <input name="traning_period" class="form-control" id="traning_period1" value="@isset($university->traning_period){{ $university->traning_period }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="accreditation1"  name="accreditation" <?php if (isset($university->accreditation) && $university->accreditation){ echo 'checked'; }?> >
                                                        <label class="custom-control-label" for="accreditation1">{{__('university_accreditation')}}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div lass="form-group">
                                                    <label>{{__('global_status')}}</label>
                                                    <select class="form-control" name="status">
                                                        <?php $value = \Illuminate\Support\Facades\Config::get('status.active'); ?>
                                                        <option value="{{$value}}" <?php if (isset($university) && $university->status==$value){ echo 'selected'; } ?>>{{\App\Services\Admin\Misc\SystemService::get_status_name_by_id($value)}}</option>

                                                        <?php $value = \Illuminate\Support\Facades\Config::get('status.wait'); ?>
                                                        <option value="{{$value}}" <?php if (isset($university) && $university->status==$value){ echo 'selected'; } ?>>{{\App\Services\Admin\Misc\SystemService::get_status_name_by_id($value)}}</option>

                                                        <?php $value = \Illuminate\Support\Facades\Config::get('status.block'); ?>
                                                        <option value="{{$value}}" <?php if (isset($university) && $university->status==$value){ echo 'selected'; } ?>>{{\App\Services\Admin\Misc\SystemService::get_status_name_by_id($value)}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.basic -->

                                    <!-- contact -->
                                    <div class="tab-pane fade" id="contact1" role="tabpanel" aria-labelledby="contact1">
                                        <div class="row mt-2">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address1">{{__('university_address')}}</label>
                                                    <input name="address" class="form-control" id="address1" value="@isset($university->address){{ $university->address }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phones1">{{__('university_phones')}}</label>
                                                    <input name="phones" class="form-control" id="phones1" value="@isset($university->phones){{ $university->phones }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email1">{{__('university_email')}}</label>
                                                    <input name="email" class="form-control" id="email1" value="@isset($university->email){{ $university->email }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="website1">{{__('university_website')}}</label>
                                                    <input name="website" class="form-control" id="website1" value="@isset($university->website){{ $university->website }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="facebook_link1">{{__('university_facebook_link')}}</label>
                                                    <input name="facebook_link" class="form-control" id="facebook_link1" value="@isset($university->facebook_link){{ $university->facebook_link }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="twitter_link1">{{__('university_twitter_link')}}</label>
                                                    <input name="twitter_link" class="form-control" id="twitter_link1" value="@isset($university->twitter_link){{ $university->twitter_link }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telegram_link1">{{__('university_telegram_link')}}</label>
                                                    <input name="telegram_link" class="form-control" id="telegram_link1" value="@isset($university->telegram_link){{ $university->telegram_link }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="viber_link1">{{__('university_viber_link')}}</label>
                                                    <input name="viber_link" class="form-control" id="viber_link1" value="@isset($university->viber_link){{ $university->viber_link }}@endisset">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="vk_link1">{{__('university_vk_link')}}</label>
                                                    <input name="vk_link" class="form-control" id="vk_link1" value="@isset($university->vk_link){{ $university->vk_link }}@endisset">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.contact -->

                                    <!-- settings -->
                                    <div class="tab-pane fade" id="setting1" role="tabpanel" aria-labelledby="setting1">
                                        <div class="row mt-2">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="slug1">{{__('university_slug')}}</label>
                                                    <input name="slug" class="form-control" id="slug1" value="@isset($university->slug){{ $university->slug }}@endisset">
                                                </div>
                                            </div>

                                            <!-- directions from base -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('university_direction')}}</label>
                                                    <select class="direction-select" multiple="multiple" data-placeholder="{{__('university_select_direction')}}" style="width: 100%;" name="directions[]">
                                                        @foreach ($directions as $direction)
                                                            <option 
                                                                value="{{$direction->id}}"
                                                                <?php 
                                                                    if (isset($university)){
                                                                        $exists = false; 
                                                                        foreach($university->directions as $key => $value):
                                                                            if ($value->direction_id==$direction->id){ $exists = true; }
                                                                        endforeach;
                                                                        if ($exists){ echo 'selected'; }
                                                                    } 
                                                                ?>
                                                            >{{$direction->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- education type from base -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('university_education_type')}}</label>
                                                    <select class="education-type-select" multiple="multiple" data-placeholder="{{__('university_education_type_select')}}" style="width: 100%;" name="education_types[]">
                                                        @foreach ($education_types as $education_type)
                                                            <option 
                                                                value="{{$education_type->id}}"
                                                                <?php 
                                                                    if (isset($university)){
                                                                        $exists = false; 
                                                                        foreach($university->education_types as $key => $value):
                                                                            if ($value->education_type_id==$education_type->id){ $exists = true; }
                                                                        endforeach;
                                                                        if ($exists){ echo 'selected'; }
                                                                    } 
                                                                ?>
                                                            >{{$education_type->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- education level from base -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('university_education_level')}}</label>
                                                    <select class="education-level-select" multiple="multiple" data-placeholder="{{__('university_education_level_select')}}" style="width: 100%;" name="education_levels[]">
                                                        @foreach ($education_levels as $education_level)
                                                            <option 
                                                                value="{{$education_level->id}}"
                                                                <?php 
                                                                    if (isset($university)){
                                                                        $exists = false; 
                                                                        foreach($university->education_levels as $key => $value):
                                                                            if ($value->education_level_id==$education_level->id){ $exists = true; }
                                                                        endforeach;
                                                                        if ($exists){ echo 'selected'; }
                                                                    } 
                                                                ?>
                                                            >{{$education_level->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="extra1">{{__('university_extra')}}</label>
                                                    <textarea class="form-control" id="extra1" name="extra" style="height:200px">@isset($university->extra){{ $university->extra }}@endisset</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group qa_result">
                                                    <label for="q_a">{{__('university_qa')}}</label>
                                                    <?php if (isset($university)){ ?>
                                                    <?php foreach($university['qas'] as $key => $qa): ?>
                                                        <div class="qa_list" id="qa<?=$key?>">
                                                            <input class="form-control" placeholder="<?=__('university_question')?>" name="qa[<?=$key?>][question]" value="<?=$qa['question']?>" />
                                                            <textarea name="qa[<?=$key?>][answer]" class="form-control mt-1" style="height:100px;" placeholder="<?=__('university_answer')?>"><?=$qa['answer']?></textarea>
                                                            <span class="btn btn-sm btn-danger qa_remove" data-number="<?=$key?>"><i class="fa fa-trash"></i></span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group text-right">
                                                    <span class="btn btn-primary qa_add">
                                                        <i class="fa fa-plus"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.settings -->
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
<!-- Select2 -->
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
// qa uniq number
var qaNumber = parseInt("<?php if(isset($university)){ echo count($university['qas']); }?>");
var qPlaceholder = "{{__('university_question')}}";
var aPlaceholder = "{{__('university_answer')}}";
    
$(function () {
    // Directions
    $('.direction-select').select2();

    // Education type
    $('.education-type-select').select2();

    // Education level
    $('.education-level-select').select2();

    // city
    $('.city-select').select2();

});

$(document).on('click', '.qa_add', function (){
    var question = '<input name="qa['+qaNumber+'][question]" class="form-control" placeholder="'+qPlaceholder+'" />';
    var answer = '<textarea name="qa['+qaNumber+'][answer]" class="form-control mt-1" placeholder="'+aPlaceholder+'" style="height:100px"></textarea>';
    var qa_remove = '<span class="btn btn-sm btn-danger qa_remove" data-number="'+qaNumber+'"><i class="fa fa-trash"></i></span>';
    $('.qa_result').append('<div class="qa_list" id="qa'+qaNumber+'">'+question+answer+qa_remove+'</div>');

    qaNumber++;
});

$(document).on('click', '.qa_remove', function(){
    var number = $(this).data('number');
    $('#qa'+number).remove();
});
</script>
<style>
    .qa_list{
        position:relative;
        padding: 5px;
        border: 1px solid #efefef;
        border-radius: 5px;
        margin-bottom: 5px;
    }
    .qa_remove{
        position:absolute;
        top:9px;
        right:9px;
        opacity: 0;
        transition: 0.4s;
    }
    .qa_list:hover .qa_remove{
        opacity: 1;
    }
</style>
<!-- ./Select2 -->
@stop