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
        <li class="active">Топ ВУЗов</li>
      </ol>
    </nav>

    @include('components.universities.top', ['remove_more' => true])

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
        <h3 class="_change_able" data-key="top_last_info_h3" data-page="{{$_GET['_page']??''}}">{{$template['top_last_info_h3']??__('global_empty')}}</h3>
        <p class="_change_able" data-key="top_last_info_p" data-page="{{$_GET['_page']??''}}">
            <?php 
                if (strlen($template['top_last_info_p']??__('global_empty'))>500){ 
                    echo substr($template['top_last_info_p'], 0, 500).'<span class="big-dots">...</span><span class="extra-text d-none">'.substr($template['top_last_info_p'], 500).'<span>';
                }else{
                    echo $template['top_last_info_p']??__('global_empty');
                } 
            ?>
        </p>
        <?php if (strlen($template['top_last_info_p']??__('global_empty'))>500){ ?>
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