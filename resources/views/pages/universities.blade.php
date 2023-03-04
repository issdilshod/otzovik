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
        <li class="active">Университеты</li>
      </ol>
    </nav>

    <!-- hero -->
    <div class="hero">
      <div class="hero-text has-size">
        <h1 class="_change_able" data-key="universities_info_h1" data-value="{{$template['universities_info_h1']}}">{{$template['universities_info_h1']}}</h1>
        <p class="_change_able" data-key="universities_info_p" data-value="{{$template['universities_info_p']}}">{{$template['universities_info_p']}}</p>        
      </div>
      <div class="hero-img"><img src="{{ asset('assets/images/hero02.svg') }}" alt=""></div>
    </div>
    <!-- / hero -->

    @include('components.universities.directions')

    <div class="title-wrap align-items-center">
      <div class="headline">
        <div class="ico">
          <svg class="icon">
            <use xlink:href="#teacher-full"></use>
          </svg>
        </div>
        Учебные заведения
      </div>
      <div class="sort">
        <a href="#" class="sort-item location" data-toggle="modal" data-target="#modal01">
          <span class="ico">
            <svg class="icon">
              <use xlink:href="#location-empty"></use>
            </svg>
          </span>
          <span class="name"></span>
        </a>
        <select class="qty-sort" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
            <option value="review">По количеству отзывов</option>
            <option value="rate">По рейтингу</option>
            <option value="new">По новинкам</option>
        </select>
      </div>
    </div>

    <!-- institutions -->
    <div class="institutions">      
        <div class="row">
            @foreach ($list as $item)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="institution-card">
                        <div class="institution-title"><a href="{{url('/universitet/'.$item->slug)}}">{{$item->name}}</a></div>
                        <div class="institution-img"><a href="{{url('/universitet/'.$item->slug)}}"><img src="{{ asset('storage/'.$item->logo) }}" alt=""></a></div>
                        <div class="institution-labels">
                            <div class="i-label full">
                                <div class="rate-info">
                                <span class="ico">
                                    <svg class="icon">
                                    <use xlink:href="#files-colorful"></use>
                                    </svg>
                                </span>
                                {{$item->reviews_count}}
                                </div>
                            </div>
                            <div class="i-label">
                                <div class="rate-info">
                                <span class="ico">
                                    <svg class="icon">
                                    <use xlink:href="#medal01-ico"></use>
                                    </svg>
                                </span>
                                {{$item->russian_rate}}
                                </div>
                            </div>
                            <div class="i-label">
                                <div class="rate-info">
                                <span class="ico">
                                    <svg class="icon">
                                    <use xlink:href="#medal-ico"></use>
                                    </svg>
                                </span>
                                {{$item->worlds_rate}}
                                </div>
                            </div>
                        </div>
                        @if ($item->accreditation)
                        <div class="accreditation"><div class="inner">Гос Аккредитация: Есть</div></div> 
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="help">
                    <div class="help-img"><img src="{{ asset('assets/images/help-img.svg') }}" alt=""></div>
                    <div class="help-title">Не нашли нужный ВУЗ?</div>
                    <a href="{{url('/universitety')}}" class="btn">Список ВУЗов</a>
                </div>
            </div>
        </div>
      
        @include('components.pagination.pagination')

    </div>
    <!--  /institutions -->

    <!-- honest -->
    <div class="honest">
        <h2 class="_change_able" data-key="universities_honest_h2" data-value="{{$template['universities_honest_h2']}}">{{$template['universities_honest_h2']}}</h2>
        <p class="_change_able" data-key="universities_honest_p" data-value="{{$template['universities_honest_p']}}">{{$template['universities_honest_p']}}</p>
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

</div>

<div class="bg-box">
    <div class="container">
        @include('components.reviews.last')
    </div>
</div>

<div class="container">
    
    @include('components.universities.popular')

    @include('components.reviews.popular')

    <!-- text -->
    <div class="text">
        <h3 class="_change_able" data-key="universities_last_info_h3" data-value="{{$template['universities_last_info_h3']}}">{{$template['universities_last_info_h3']}}</h3>
        <p class="_change_able" data-key="universities_last_info_p" data-value="{{$template['universities_last_info_p']}}">
            <?php 
                if (strlen($template['universities_last_info_p']>500)){ 
                    echo substr($template['universities_last_info_p'], 0, 500).'<span class="big-dots">...</span><span class="extra-text d-none">'.substr($template['universities_last_info_p'], 500).'<span>';
                }else{
                    echo $template['universities_last_info_p'];
                } 
            ?>
        </p>
        <?php if (strlen($template['universities_last_info_p']>500)){ ?>
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

<script>
    var currentUrl = '{{url()->full()}}';
    var globUrl = '{{url("/universitety")}}';

    // on ready document
    $(document).ready(function(){
        // if new open then remove filters
        if (currentUrl==globUrl){
            localStorage.removeItem('_qty_sort');
            localStorage.removeItem('_tags_li_a');
        }
    })

    // on change filter
    $(document).on('change', '.qty-sort', function(e) {
        window.location.href = currentUrl + '/' + $(this).val();

        localStorage.setItem('_qty_sort', $(this).val());

        generate();
    });

    // on location change
    $(document).on('click', '.choose-location', function(e) {
        generate();
    });

    // on directions change
    $(document).on('click', '.tags>li>a', function (e){

        e.preventDefault();

        var slug = $(this).data('slug');

        localStorage.setItem('_tags_li_a', slug);

        generate();
    });

    // function to generate url
    function generate(){
        var sort = localStorage.getItem('_qty_sort');
        var location = JSON.parse(localStorage.getItem('_location'));
        var tags = localStorage.getItem('_tags_li_a');

        var link = globUrl;
        if (location){
            link += '/' + location.slug;
        }
        if (tags){
            link += '/' + tags;
        }
        if (sort){
            link += '/' + sort;
        }

        window.location.href = link;
    }
</script>

@stop