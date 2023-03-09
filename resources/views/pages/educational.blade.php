@extends('layouts.default')

@section('content')
<main>
<div class="container">

    <nav class="breadcrumb-wrapper">
      <ol class="breadcrumb">
        <li>
          <a href="{{url('/')}}" class="home">
            <span class="ico">
              <svg class="icon">
                <use xlink:href="#home-ico"></use>
              </svg>
            </span>
            Главная
          </a>
        </li>         
        <li class="active">Учебным заведениям</li>
      </ol>
    </nav>

    <!-- hero -->
    <div class="hero mb-3">
      <div class="hero-text has-size">
        <h1 class="_change_able" data-key="educational_top_info_h1" data-page="{{$_GET['_page']??''}}">{{$template['educational_top_info_h1']??__('global_empty')}}</h1>
        <p class="_change_able" data-key="educational_top_info_p" data-page="{{$_GET['_page']??''}}">{{$template['educational_top_info_p']??__('global_empty')}}</p>
      </div>
      <div class="hero-img"><img src="{{ asset('assets/images/illustration05.svg') }}" alt=""></div>
    </div>
    <!-- / hero -->  

    <ul class="nums has-indent">
      <li>
        <span class="nums-top">          
          <span class="ico">
            <svg class="icon">
              <use xlink:href="#chart-ico"></use>
            </svg>
          </span>
        </span>
        <span class="_change_able" data-key="educational_top_info_p1" data-page="{{$_GET['_page']??''}}">{{$template['educational_top_info_p1']??__('global_empty')}}</span>
      </li>
      <li>
        <span class="nums-top">          
          <span class="ico">
            <svg class="icon">
              <use xlink:href="#profile-ico"></use>
            </svg>
          </span>
        </span>
        <span class="_change_able" data-key="educational_top_info_p2" data-page="{{$_GET['_page']??''}}">{{$template['educational_top_info_p2']??__('global_empty')}}</span>
      </li>
      <li>
        <span class="nums-top">
          <span class="ico">
            <svg class="icon">
              <use xlink:href="#files-colorful"></use>
            </svg>
          </span>
        </span>
        <span class="_change_able" data-key="educational_top_info_p3" data-page="{{$_GET['_page']??''}}">{{$template['educational_top_info_p3']??__('global_empty')}}</span>
      </li>
    </ul>

    <!-- information -->
    <div class="information">
        <div class="information-title">
            <div class="headline">
            <div class="ico">
                <svg class="icon">
                <use xlink:href="#clipboard-ico"></use>
                </svg>
            </div>
            Информация для учебных заведении
            </div>
        </div>
        <ul class="nav info-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="info-tab01" data-toggle="tab" data-target="#tab01" type="button" role="tab" aria-controls="tab01" aria-selected="true">Для учебных заведении</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="info-tab02" data-toggle="tab" data-target="#tab02" type="button" role="tab" aria-controls="tab02" aria-selected="false">Для абитуриентов</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab01" role="tabpanel" aria-labelledby="info-tab01">
                <h3 class="_change_able" data-key="educational_info_universities_h3" data-page="{{$_GET['_page']??''}}">{{$template['educational_info_universities_h3']??__('global_empty')}}</h3>
                <p class="_change_able" data-key="educational_info_universities_p" data-page="{{$_GET['_page']??''}}">{{$template['educational_info_universities_p']??__('global_empty')}}</p>
                <div class="btns">
                    <a href="{{url('/dobavit-vuz')}}" class="btn has-ico bordered-btn">
                        <span class="ico">
                            <svg class="icon">
                            <use xlink:href="#building-ico"></use>
                            </svg>
                        </span>
                        <span class="_change_able" data-key="educational_info_universities_button" data-page="{{$_GET['_page']??''}}">{{$template['educational_info_universities_button']??__('global_empty')}}</span>
                    </a>
                </div>
            </div>
            <div class="tab-pane fade" id="tab02" role="tabpanel" aria-labelledby="info-tab02">
                <h3 class="_change_able" data-key="educational_info_universities_h3" data-page="{{$_GET['_page']??''}}">{{$template['educational_info_universities_h3']??__('global_empty')}}</h3>
                <p class="_change_able" data-key="educational_info_universities_p" data-page="{{$_GET['_page']??''}}">{{$template['educational_info_universities_p']??__('global_empty')}}</p>
                <div class="btns">
                    <a href="{{url('/dobavit-otzyv')}}" class="btn has-ico">
                        <span class="ico">
                            <svg class="icon">
                            <use xlink:href="#files-ico"></use>
                            </svg>
                        </span>
                        <span class="_change_able" data-key="educational_info_students_button" data-page="{{$_GET['_page']??''}}">{{$template['educational_info_students_button']??__('global_empty')}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- / information -->  
</div>

<div class="bg-box">
    <div class="container">
        @include('components.reviews.last')
    </div>
</div>

<div class="container">

    @include('components.articles.popular')

    @include('components.reviews.popular')
   
    @include('components.universities.popular')

    <!-- text -->
    <div class="text">
        <h3 class="_change_able" data-key="educational_last_info_h3" data-page="{{$_GET['_page']??''}}">{{$template['educational_last_info_h3']??__('global_empty')}}</h3>
        <p class="_change_able" data-key="educational_last_info_p" data-page="{{$_GET['_page']??''}}">
            <?php 
                if (strlen($template['educational_last_info_p']??__('global_empty'))>500){ 
                    echo substr($template['educational_last_info_p'], 0, 500).'<span class="big-dots">...</span><span class="extra-text d-none">'.substr($template['educational_last_info_p'], 500).'<span>';
                }else{
                    echo $template['educational_last_info_p']??__('global_empty');
                } 
            ?>
        </p>
        <?php if (strlen($template['educational_last_info_p']??__('global_empty'))>500){ ?>
            <a href="#" class="btn has-ico bordered-btn more-btn last-info-button">
                <span class="last-info-button-text">Читать дальше</span>
                <span class="ico">
                <svg class="icon">
                    <use xlink:href="#arrow-ico"></use>
                </svg>
                </span>
            </a>
        <?php } ?>
    </div>
    <!-- / text --> 

</div>
  
</main>

@include('components.modals.location')

@include('components.modals.success-subscribe')

@include('components.svgs.welcome')

@stop