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
        <li class="active">Блог</li>
      </ol>
    </nav>

    <!-- hero -->
    <div class="hero">
      <div class="hero-text">
        <h1 class="_change_able" data-key="articles_top_info_h2" data-page="{{$_GET['_page']??''}}">{{$template['articles_top_info_h2']??__('global_empty')}}</h1> 
        <p class="_change_able" data-key="articles_top_info_p" data-page="{{$_GET['_page']??''}}">{{$template['articles_top_info_p']??__('global_empty')}}</p>       
        <div class="send-inner">
          <div class="sending-group">
            <form id="articles-submit">
                <input id="articles-email" type="email" placeholder="Введите почту" class="form-control">
                <button id="articles-subscribe" class="send-btn">
                <svg class="icon">
                    <use xlink:href="#letter-ico"></use>
                </svg>
                </button>
            </form>
          </div>
          <div class="agree">Нажимая на “Отправить” я соглашаюсь на <a href="{{url('legal')}}">обработку персональных данных</a> и <a href="{{url('policy')}}">политикой конфиденциальности</a> сайта</div>
        </div>
      </div>
      <div class="hero-img"><img src="{{ asset('assets/images/illustration03.svg') }}" alt=""></div>
    </div>
    <!-- / hero -->  

    <!-- popular -->
    <div class="popular">
        <div class="title-wrap align-items-center">
            <div class="headline">
            <div class="ico">
                <svg class="icon">
                <use xlink:href="#list-ico"></use>
                </svg>
            </div>
            Блог
            </div>
            <div class="articles-info">
            <span class="articles-info-item">
                <span class="ico">
                <svg class="icon">
                    <use xlink:href="#files-colorful"></use>
                </svg>
                </span>
                {{$articles_count}} статьи
            </span>
            <span class="articles-info-item">
                <span class="ico">
                <svg class="icon">
                    <use xlink:href="#calendar-full"></use>
                </svg>
                </span>
                {{$today['date']}}
            </span>
            </div>
        </div>
        <div class="row">

            @foreach ($list as $item)
                <div class="col-lg-4">
                    <div class="news-card">
                        <a href="{{url('post/'.$item->slug)}}">
                        <div class="news-card-img">
                            <img src="{{ asset('storage/'.$item->cover) }}" alt="">
                            <div class="date-label">
                            <div class="ico">
                                <svg class="icon">
                                <use xlink:href="#calendar-ico"></use>
                                </svg>
                            </div>
                            {{\App\Services\Admin\Misc\SystemService::get_date_for_blog($item->updated_at)}}
                            </div>
                        </div>
                        <div class="news-card-title">{{$item->title}}</div>
                        <p><?=\Illuminate\Support\Str::limit($item->text, 86, '...')?></p>
                        </a>
                    </div>
                </div>
            @endforeach
            
        </div>
      
        @include('components.pagination.pagination')

    </div>
    <!-- / popular -->

    <!-- honest -->
    <div class="honest">
        <h2 class="_change_able" data-key="articles_honest_h2" data-page="{{$_GET['_page']??''}}">{{$template['articles_honest_h2']??__('global_empty')}}</h2>
        <p class="_change_able" data-key="articles_honest_p" data-page="{{$_GET['_page']??''}}">{{$template['articles_honest_p']??__('global_empty')}}</p>
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

    @include('components.articles.popular')

    @include('components.reviews.popular')

    <!-- text -->
    <div class="text">
        <h3 class="_change_able" data-key="articles_last_info_h3" data-page="{{$_GET['_page']??''}}">{{$template['articles_last_info_h3']??__('global_empty')}}</h3>
        <p class="_change_able" data-key="articles_last_info_p" data-page="{{$_GET['_page']??''}}">
            <?php 
                if (strlen($template['articles_last_info_p']??__('global_empty'))>500){ 
                    echo substr($template['articles_last_info_p'], 0, 500).'<span class="big-dots">...</span><span class="extra-text d-none">'.substr($template['articles_last_info_p'], 500).'<span>';
                }else{
                    echo $template['articles_last_info_p']??__('global_empty');
                } 
            ?>
        </p>
        <?php if (strlen($template['articles_last_info_p']??__('global_empty'))>500){ ?>
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