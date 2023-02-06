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
        <li><a href="{{url('/universitet/{slug}')}}">Отзывы об университете</a></li>
        <li class="active">Отзыв № 43421</li>
      </ol>
    </nav>

    <!-- hero -->
    <div class="hero university-full">
      <div class="hero-text">
        <div class="date">30 декабря 2022 - 12:30</div>
        <h1 class="mb-1">Отзыв № 43421</h1>
        <p>Московский государственный университет имени М.В.Ломоносова</p>
        <div class="btns">
          <a href="#" class="btn">Читать все отзывы</a>
          <a href="#" class="btn has-ico bordered-btn">
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
        <div class="university-full-logo mb-0"><img src="{{ asset('assets/images/logo01.png') }}" alt=""></div>        
      </div>
    </div>
    <!-- / hero -->  

    <!-- reviews-list -->
    <div class="reviews-list">
      <div class="review-card">
        <div class="review-card-top">
          <div class="user">
            <div class="user-photo"><img src="{{ asset('assets/images/photo.jpg') }}" alt=""></div>
            <div class="review-user-name">Евгений Баженов</div>
          </div>
          <div class="rating">
            <span><img src="{{ asset('assets/images/star.svg') }}" alt=""></span>
            <span><img src="{{ asset('assets/images/star.svg') }}" alt=""></span>
            <span><img src="{{ asset('assets/images/star.svg') }}" alt=""></span>
            <span><img src="{{ asset('assets/images/star.svg') }}" alt=""></span>
            <span><img src="{{ asset('assets/images/star-half.svg') }}" alt=""></span>
            <span>4.5</span>
          </div>
        </div>
        <p>Прежде, чем начну говорить о плюсах и минусах, я хотел бы прояснить некоторые моменты, которые судя по количеству негативных отзывов становятся откровением для абитуриентов. Университет - это не школа, вам не будут тут разжевывать каждую строчку из учебника и не будут принуждать вас делать домашку, чтобы вы лучше усваивали материал. Задача лекций и семинаров, особенно по математическим дисциплинам - дать вам ту базу, с которой вы легко сможете понять все остальные аспекты или пункты темы. Точно так же и с задачами. Максимум, что вам предложат - это страницы из задачника и номера задач, которые вы если хотите можете делать, а можете не делать. Могу сказать лишь, что по статистике все те, кто стараются выполнять все пункты, предлагаемые преподавателями, в итоге оказываются на вершине рейтинга, а те, кто филонят полгода и получают неуд начинают строчить негативные комменты о том, как плохо преподавание в ВШЭ.Также хочу обратить внимание, что пишу я максимум про свой факультет и скорее даже про образовательную программу. Я не знаю, как обстоят дела в других местах</p>
        <p>Прежде, чем начну говорить о плюсах и минусах, я хотел бы прояснить некоторые моменты, которые судя по количеству негативных отзывов становятся откровением для абитуриентов. Университет - это не школа, вам не будут тут разжевывать каждую строчку из учебника и не будут принуждать вас делать домашку, чтобы вы лучше усваивали материал. Задача лекций и семинаров, особенно по математическим дисциплинам - дать вам ту базу, с которой вы легко сможете понять все остальные аспекты или пункты темы. Точно так же и с задачами. Максимум, что вам предложат - это страницы из задачника и номера задач, которые вы если хотите можете делать, а можете не делать. Могу сказать лишь, что по статистике все те, кто стараются выполнять все пункты, предлагаемые преподавателями, в итоге оказываются на вершине рейтинга, а те, кто филонят полгода и получают неуд начинают строчить негативные комменты о том, как плохо преподавание в ВШЭ.Также хочу обратить внимание, что пишу я максимум про свой факультет и скорее даже про образовательную программу. Я не знаю, как обстоят дела в других местах</p>
        <p>в итоге оказываются на вершине рейтинга, а те, кто филонят полгода и получают неуд начинают строчить негативные комменты о том, как плохо преподавание в ВШЭ.Также хочу обратить внимание, что пишу я максимум про свой факультет и скорее даже про образовательную программу. Я не знаю, как обстоят дела в других местах</p>
        <a href="#" class="back">
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

    @include('components.reviews.honest')

    @include('components.reviews.popular')

</div>

<div class="bg-box">
    <div class="container">
        @include('components.reviews.popular')
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