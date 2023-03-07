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
        <li><a href="{{url('/otzyvy')}}">Отзывы</a></li>
        <li><a href="{{url('/universitet/'.$current_review->university_slug)}}">Отзывы об университете</a></li>
        <li class="active">Отзыв на {{$current_review->university_name}} № {{$current_review->number}}</li>
      </ol>
    </nav>

    <!-- hero -->
    <div class="hero university-full">
      <div class="hero-text">
        <div class="date">{{App\Services\Admin\Misc\SystemService::get_dateTime_human($current_review->updated_at, true)}}</div>
        <h1 class="mb-1">Отзыв на {{$current_review->university_name}} № {{$current_review->number}}</h1>
        <p>{{$current_review->university_name}}</p>
        <div class="btns">
          <a href="{{url('otzyvy')}}" class="btn">Читать все отзывы</a>
          <a href="{{url('dobavit-otzyv/'.$current_review->university_slug)}}" class="btn has-ico bordered-btn">
            <span class="ico">
              <svg class="icon">
                <use xlink:href="#files-ico"></use>
              </svg>
            </span>
            Оставить отзыв
          </a>
        </div>
      </div>
      <div class="hero-img">
        <div class="university-full-logo mb-0"><img src="{{asset('storage/'.$current_review->university_logo)}}" alt=""></div>        
      </div>
    </div>
    <!-- / hero -->  

    <!-- reviews-list -->
    <div class="reviews-list">
      <div class="review-card">
        <div class="review-card-top">
          <div class="user">
            <div class="user-photo">
                <img src="@if ($current_review->user_avatar){{ asset('storage/'.$current_review->user_avatar) }}@else{{'https://cdn-icons-png.flaticon.com/512/847/847969.png'}}@endif" alt="">
            </div>
            <div class="review-user-name">{{$current_review->user_first_name}} {{$current_review->user_last_name}}</div>
          </div>
          <div class="rating">
            @for ($i = 0; $i < 5; $i++)
                @if (($i+.5)==$current_review->star)
                    <span><img src="{{ asset('assets/images/star-half.svg') }}" alt=""></span>
                @elseif ($i<$current_review->star)
                    <span><img src="{{ asset('assets/images/star.svg') }}" alt=""></span>
                @else
                    <span><img src="{{ asset('assets/images/star-empty.svg') }}" alt=""></span> 
                @endif
            @endfor
            <span>{{$current_review->star}}</span>
          </div>
        </div>
        <p>{{$current_review->text}}</p>
        <a href="{{url('/universitet/'.$current_review->university_slug)}}" class="back">
          <span class="ico">
            <svg class="icon">
              <use xlink:href="#arrow-ico"></use>
            </svg>
          </span>
          Вернуться к отзывам об этом Вузе  
        </a>
      </div>
    </div>
    <!-- / reviews-list -->

    <!-- honest -->
    <div class="honest">
        <h2 class="_change_able" data-key="review_honest_h2" data-value="{{$template['review_honest_h2']}}">{{$template['review_honest_h2']}}</h2>
        <p class="_change_able" data-key="review_honest_p" data-value="{{$template['review_honest_p']}}">{{$template['review_honest_p']}}</p>
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

    @include('components.reviews.popular')

</div>

<div class="bg-box">
    <div class="container">
        @include('components.reviews.university')
    </div>
</div>

<div class="container">

    @include('components.articles.popular')
    
    @include('components.universities.popular')
    
</div>
</main>

@include('components.modals.location')

@include('components.modals.success-subscribe')

@include('components.svgs.welcome')

@stop