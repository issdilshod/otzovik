@extends('layouts.default')

@section('content')
<div class="container">

    <!-- hero -->
    <div class="hero">
      <div class="hero-text">
        <h1 class="_change_able" data-key="index_banner_h1" data-page="{{$_GET['_page']??''}}">{{$template['index_banner_h1']??__('global_empty')}}</h1>
        <p class="_change_able" data-key="index_banner_p" data-page="{{$_GET['_page']??''}}">{{$template['index_banner_p']??__('global_empty')}}</p>
        <a href="{{url('/poisk')}}" class="btn has-ico">
          <span class="ico">
            <svg class="icon">
              <use xlink:href="#teacher-ico"></use>
            </svg>
          </span>
          Подобрать ВУЗ
        </a>
      </div>
      <div class="hero-img"><img src="assets/images/hero01.svg" alt=""></div>
    </div>
    <!-- / hero -->
    
    @include('components.reviews.popular')

    <!-- attrackt -->
    <div class="attrackt">
      <div class="row align-items-end">
        <div class="col-lg-9">
          <h2 class="_change_able" data-key="index_counter_h2" data-page="{{$_GET['_page']??''}}">{{$template['index_counter_h2']??__('global_empty')}}</h2>
          <p class="_change_able" data-key="index_counter_p" data-page="{{$_GET['_page']??''}}">{{$template['index_counter_p']??__('global_empty')}}</p>
          <div class="btns">
            <a href="{{url('/dobavit-otzyv')}}" class="btn has-ico">
              <span class="ico">
                <svg class="icon">
                  <use xlink:href="#files-ico"></use>
                </svg>
              </span>
              Оставить отзыв
            </a>
            <a href="{{url('/dobavit-vuz')}}" class="btn has-ico bordered-btn">
              <span class="ico">
                <svg class="icon">
                  <use xlink:href="#building-ico"></use>
                </svg>
              </span>
              Добавить вуз
            </a>
          </div>
          <ul class="nums">
            <li>
              <span class="nums-top">
                <span class="ico">
                  <svg class="icon">
                    <use xlink:href="#more-ico"></use>
                  </svg>
                </span>
                <strong class="_change_able" data-key="index_counter_reviews" data-page="{{$_GET['_page']??''}}">{{$template['index_counter_reviews']??__('global_empty')}}</strong>
              </span>
              Отзывов в вашем городе
            </li>
            <li>
              <span class="nums-top">
                <span class="ico">
                  <svg class="icon">
                    <use xlink:href="#files-ico"></use>
                  </svg>
                </span>
                <strong class="_change_able" data-key="index_counter_answers" data-page="{{$_GET['_page']??''}}">{{$template['index_counter_answers']??__('global_empty')}}</strong>
              </span>
              Ответов от компаний
            </li>
            <li>
              <span class="nums-top">
                <span class="ico">
                  <svg class="icon">
                    <use xlink:href="#users-ico"></use>
                  </svg>
                </span>
                <strong class="_change_able" data-key="index_counter_companies" data-page="{{$_GET['_page']??''}}">{{$template['index_counter_companies']??__('global_empty')}}</strong>
              </span>
              Компаний на портале
            </li>
          </ul>
        </div>
        <div class="col-lg-3">
          <div class="attrackt-img"><img src="assets/images/attrackt-img.svg" alt=""></div>
        </div>
      </div>
    </div>
    <!-- / attrackt -->  

</div>

<div class="bg-box">
    @include('components.universities.top')
</div>

<div class="container">

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
            <h3 class="_change_able" data-key="index_info_universities_h3" data-page="{{$_GET['_page']??''}}">{{$template['index_info_universities_h3']??__('global_empty')}}</h3>
            <p class="_change_able" data-key="index_info_universities_p" data-page="{{$_GET['_page']??''}}">{{$template['index_info_universities_p']??__('global_empty')}}</p>
            <div class="btns">
                <a href="#" class="btn has-ico bordered-btn">
                    <span class="ico">
                        <svg class="icon">
                        <use xlink:href="#building-ico"></use>
                        </svg>
                    </span>
                    <span class="_change_able" data-key="index_info_universities_button" data-page="{{$_GET['_page']??''}}">{{$template['index_info_universities_button']??__('global_empty')}}</span>
                </a>
            </div>
        </div>
        <div class="tab-pane fade" id="tab02" role="tabpanel" aria-labelledby="info-tab02">
            <h3 class="_change_able" data-key="index_students_h3" data-page="{{$_GET['_page']??''}}">{{$template['index_info_students_h3']??__('global_empty')}}</h3>
            <p class="_change_able" data-key="index_students_p" data-page="{{$_GET['_page']??''}}">{{$template['index_info_students_p']??__('global_empty')}}</p>
            <div class="btns">
                <a href="{{url('/dobavit-otzyv')}}" class="btn has-ico">
                    <span class="ico">
                        <svg class="icon">
                        <use xlink:href="#files-ico"></use>
                        </svg>
                    </span>
                    <span class="_change_able" data-key="index_info_students_button" data-page="{{$_GET['_page']??''}}">{{$template['index_info_students_button']??__('global_empty')}}</span>
                </a>
            </div>
        </div>
    </div>
    </div>
    <!-- / information -->

    @include('components.articles.popular')

    <!-- honest -->
    <div class="honest">
        <h2 class="_change_able" data-key="index_honest_h2" data-page="{{$_GET['_page']??''}}">{{$template['index_honest_h2']??__('global_empty')}}</h2>
        <p class="_change_able" data-key="index_honest_p" data-page="{{$_GET['_page']??''}}">{{$template['index_honest_p']??__('global_empty')}}</p>
        <a href="{{url('/dobavit-otzyv')}}" class="btn has-ico">
            <span class="ico">
            <svg class="icon">
                <use xlink:href="#files-ico"></use>
            </svg>
            </span>
            Оставить отзыв
        </a>
    </div>
    <!-- / honest -->   

    @include('components.reviews.last')

    <!-- text -->
    <div class="text">
        <h3 class="_change_able" data-key="index_last_info_h3" data-page="{{$_GET['_page']??''}}">{{$template['index_last_info_h3']??__('global_empty')}}</h3>
        <p class="_change_able" data-key="index_last_info_p" data-page="{{$_GET['_page']??''}}">
            <?php 
                if (strlen($template['index_last_info_p']??__('global_empty')>500)){ 
                    echo substr($template['index_last_info_p'], 0, 500).'<span class="big-dots">...</span><span class="extra-text d-none">'.substr($template['index_last_info_p'], 500).'<span>';
                }else{
                    echo $template['index_last_info_p']??__('global_empty');
                } 
            ?>
        </p>
        <?php if (strlen($template['index_last_info_p']??__('global_empty'))>500){ ?>
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

@include('components.modals.location')

@include('components.modals.success-subscribe')

@include('components.svgs.welcome')

@stop