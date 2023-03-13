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
        <li><a href="{{url('/universitety')}}">Университеты</a></li>
        <li class="active">{{$university->name}}</li>
      </ol>
    </nav>

    <!-- hero -->
    <div class="hero university-full">
      <div class="hero-text">
        <h1>{{$university->name}}</h1>
        <div class="university-full-row">
          <div class="acc-item">
            <label>Мировой рейтинг:</label>
            <div class="rate-info">
              <span class="ico">
                <svg class="icon">
                  <use xlink:href="#medal-ico"></use>
                </svg>
              </span>
              {{$university->worlds_rate}}
            </div>
          </div>
          <div class="acc-item">
            <label>Российский рейтинг:</label>
            <div class="rate-info">
              <span class="ico">
                <svg class="icon">
                  <use xlink:href="#medal01-ico"></use>
                </svg>
              </span>
              {{$university->russian_rate}}
            </div>
          </div>
          <div class="acc-item">
            <label>Отзывы компании:</label>
            <div class="rate-info">
              <span class="ico">
                <svg class="icon">
                  <use xlink:href="#files-colorful"></use>
                </svg>
              </span>
              {{$university->reviews_count}}
            </div>
          </div>
          <div class="acc-item"><a href="{{url('/dobavit-otzyv/'.$university->slug)}}" class="btn">Оставить отзыв</a></div>
        </div>
      </div>
      <div class="hero-img">
        <div class="university-full-logo"><img src="{{ asset('/storage/'.$university->logo) }}" alt=""></div>
        @if ($university->accreditation)
        <div class="accreditation"><div class="inner">Гос Аккредитация: Есть</div></div> 
        @endif
        
      </div>
    </div>
    <!-- / hero -->  

    <!-- text -->
    <div class="text">
        <h3>Об университете</h3>
        <p id="university-description">
            <?php 
                if (Illuminate\Support\Str::length($university->description>500)){ 
                    echo Illuminate\Support\Str::substr($university->description, 0, 500).'<span class="big-dots">...</span><span class="extra-text d-none">'.Illuminate\Support\Str::substr($university->description, 500).'<span>';
                }else{
                    echo $university->description;
                } 
            ?>
        </p>
        @if (Illuminate\Support\Str::length($university->description)>500)
        <a href="#" class="btn light-btn show-more-university" id="show-more-toggle">Узнать больше</a>
        @endif
    </div> 

    <script>
        $(document).on('click', '.show-more-university', function(e){
            e.preventDefault();
            if (!$(this).parent().find('.big-dots').hasClass('d-none')){ // showing more
                $(this).parent().find('.big-dots').addClass('d-none');
                $(this).parent().find('.extra-text').removeClass('d-none');
                $('.show-more-university').text('Скрыть');
            }else{ // showing less
                $(this).parent().find('.big-dots').removeClass('d-none');
                $(this).parent().find('.extra-text').addClass('d-none');
                $('.show-more-university').text('Читать дальше');
            }
        });
    </script>

    <!-- / text -->

    <!-- descript-card -->
    <div class="descript-card">
      <ul class="nav descript-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link @if(!$review_active){{'active'}}@endif" id="descript-tab01" data-toggle="tab" data-target="#descript01" type="button" role="tab" aria-controls="descript01" aria-selected="true">Для учебных заведении</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="descript-descript02" data-toggle="tab" data-target="#descript02" type="button" role="tab" aria-controls="descript02" aria-selected="false">Для абитуриентов</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link @if($review_active){{'active'}}@endif" id="descript-descript03" data-toggle="tab" data-target="#descript03" type="button" role="tab" aria-controls="descript03" aria-selected="false">Отзывы</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="descript-descript04" data-toggle="tab" data-target="#descript04" type="button" role="tab" aria-controls="descript04" aria-selected="false">Дополнительно</button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade @if(!$review_active){{'show active'}}@endif" id="descript01" role="tabpanel" aria-labelledby="descript-descript01">
          <div class="row">
            <div class="col-lg-4">
              <div class="descript-card-item">
                <div class="title">Статиситка отзывов</div>
                <div class="statistic-row">                  
                    <span>5</span>
                    @for ($i = 0; $i <= 100; $i+=20)
                        @if ($university->statistic['five']!=0 && $university->statistic['five']>=$i)
                            <span><span class="shild full"></span></span>
                        @else
                            <span><span class="shild"></span></span>
                        @endif  
                    @endfor
                    <span>{{$university->statistic['five']}}%</span>
                </div>
                <div class="statistic-row">                  
                    <span>4</span>
                    @for ($i = 0; $i <= 100; $i+=20)
                        @if ($university->statistic['four']!=0 && $university->statistic['four']>=$i)
                            <span><span class="shild full"></span></span>
                        @else
                            <span><span class="shild"></span></span>
                        @endif  
                    @endfor
                    <span>{{$university->statistic['four']}}%</span>
                </div>
                <div class="statistic-row">                  
                    <span>3</span>
                    @for ($i = 0; $i <= 100; $i+=20)
                        @if ($university->statistic['three']!=0 && $university->statistic['three']>=$i)
                            <span><span class="shild full"></span></span>
                        @else
                            <span><span class="shild"></span></span>
                        @endif  
                    @endfor
                    <span>{{$university->statistic['three']}}%</span>
                </div>
                <div class="statistic-row">                  
                    <span>2</span>
                    @for ($i = 0; $i <= 100; $i+=20)
                        @if ($university->statistic['two']!=0 && $university->statistic['two']>=$i)
                            <span><span class="shild full"></span></span>
                        @else
                            <span><span class="shild"></span></span>
                        @endif  
                    @endfor
                    <span>{{$university->statistic['two']}}%</span>
                </div>
                <div class="statistic-row">                  
                    <span>1</span>
                    @for ($i = 0; $i <= 100; $i+=20)
                        @if ($university->statistic['one']!=0 && $university->statistic['one']>=$i)
                            <span><span class="shild full"></span></span>
                        @else
                            <span><span class="shild"></span></span>
                        @endif  
                    @endfor
                    <span>{{$university->statistic['one']}}%</span>
                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="descript-card-item">
                <div class="title">Контактные данные</div>
                <div class="contact-item">
                  <div class="ico">
                    <svg class="icon">
                      <use xlink:href="#location-ico"></use>
                    </svg>
                  </div>
                  <div class="contact-item-text">
                    <span>Адрес:</span>
                    {{$university->address}}
                  </div>
                </div>
                <div class="contact-item">
                  <div class="ico">
                    <svg class="icon">
                      <use xlink:href="#tel-ico"></use>
                    </svg>
                  </div>
                  <div class="contact-item-text">
                    <span>Телефоны:</span>
                    {{$university->phones}}
                  </div>
                </div>
                <div class="contact-item">
                  <div class="ico">
                    <svg class="icon">
                      <use xlink:href="#mail-ico"></use>
                    </svg>
                  </div>
                  <div class="contact-item-text">
                    <span>Почта:</span>
                    <a href="mailto:{{$university->email}}">{{$university->email}}</a>
                  </div>
                </div>
                <div class="contact-item">
                  <div class="ico">
                    <svg class="icon">
                      <use xlink:href="#site-ico"></use>
                    </svg>
                  </div>
                  <div class="contact-item-text">
                    <span>Сайт:</span>
                    <a href="{{$university->website}}" target="_blank">{{$university->website}}</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="descript-card-item card-reverse">
                @if ($university->accreditation)
                    <div>
                        <div class="title">Гос Акредитация</div>
                        <div class="accreditation">
                            <div class="inner">Есть</div>
                        </div>
                    </div>
                @endif
                <div>
                  <div class="title">Соц-сети</div>
                  <ul class="content-socially">
                    @if ($university->facebook_link)
                    <li>
                      <a href="{{$university->facebook_link}}" target="_blank">
                        <span class="ico fb">
                          <svg class="icon">
                            <use xlink:href="#fb-ico"></use>
                          </svg>
                        </span>
                      </a>
                    </li>
                    @endif
                    @if ($university->twitter_link) 
                    <li>
                      <a href="{{$university->twitter_link}}" target="_blank">
                        <span class="ico twitter">
                          <svg class="icon">
                            <use xlink:href="#twitter-ico"></use>
                          </svg>
                        </span>
                      </a>
                    </li>
                    @endif
                    @if ($university->telegram_link)  
                    <li>
                      <a href="{{$university->telegram_link}}" target="_blank">
                        <span class="ico telegram">
                          <svg class="icon">
                            <use xlink:href="#telegram-ico"></use>
                          </svg>
                        </span>
                      </a>
                    </li> 
                    @endif
                    @if ($university->viber_link)                   
                    <li>
                      <a href="{{$university->viber_link}}" target="_blank">
                        <span class="ico viber">
                          <svg class="icon">
                            <use xlink:href="#viber-ico"></use>
                          </svg>
                        </span>
                      </a>
                    </li>
                    @endif
                    @if ($university->vk_link)
                    <li>
                      <a href="{{$university->vk_link}}" target="_blank">
                        <span class="ico vk">
                          <svg class="icon">
                            <use xlink:href="#vk-ico"></use>
                          </svg>
                        </span>
                      </a>
                    </li> 
                    @endif
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="descript02" role="tabpanel" aria-labelledby="descript-descript02">
          <div class="descript-card-item">
            <h4>Направления подготовки учебного заведения</h4>
            <ul class="tags">
                @foreach ($university->directions as $direction)
                <li><a href="{{\App\Services\Admin\Misc\UrlService::url_direction(url('/universitety'), $direction->slug)}}">{{$direction->name}}</a></li> <!-- class="active" -->
                @endforeach
            </ul>
            <!--h4>Структура</h4>
            <ul class="strukture-list">
              <li>
                <span>Факультет:</span>
                Программирование ЭВМ
              </li>
              <li>
                <span>Кафедра:</span>
                Математическая
              </li>
            </ul-->
            <h4>Форма обучения</h4>
            <ul class="tags">
                @foreach ($university->education_types as $education_type)
                <li><a href="#" >{{$education_type->name}}</a></li>
                @endforeach
            </ul>
            <h4>Сроки обучения</h4>
            <div class="strukture-date">
              <div class="ico">
                <svg class="icon">
                  <use xlink:href="#calendar-full"></use>
                </svg>
              </div>
              от {{$university->traning_period}} лет
            </div>
          </div>
        </div>
        <div class="tab-pane fade @if($review_active){{'active show'}}@endif" id="descript03" role="tabpanel" aria-labelledby="descript-descript03">
          
            @foreach ($list as $item)
                <div class="review-card">
                    <div class="review-card-top">
                    <div class="user">
                        <div class="user-photo">
                            <img src="@if ($item->user_avatar){{ asset('storage/'.$item->user_avatar) }}@else{{'https://cdn-icons-png.flaticon.com/512/847/847969.png'}}@endif" alt="">
                        </div>
                        <div class="review-user-name">{{$item->user_first_name}} {{$item->user_last_name}}</div>
                    </div>
                    <div class="date">{{\App\Services\Admin\Misc\SystemService::get_dateTime_human($item->updated_at)}}</div>
                    <div class="rating">
                        @for ($i = 0; $i < 5; $i++)
                            @if (($i+.5)==$item->star)
                                <span><img src="{{ asset('assets/images/star-half.svg') }}" alt=""></span>
                            @elseif ($i<$item->star)
                                <span><img src="{{ asset('assets/images/star.svg') }}" alt=""></span>
                            @else
                                <span><img src="{{ asset('assets/images/star-empty.svg') }}" alt=""></span> 
                            @endif
                        @endfor
                        <span>{{$item->star}}</span>
                    </div>
                    </div>
                    <p>{{$item->text}}</p>
                    <a href="{{url('otzyv/'.$item->number)}}" class="light-btn btn">Перейти на страницу отзыва</a>
                </div>
            @endforeach
          
            @include('components.pagination.pagination')

        </div>
        <div class="tab-pane fade" id="descript04" role="tabpanel" aria-labelledby="descript-descript04">{{$university->extra}}</div>
      </div>
    </div>
    <!-- / descript-card -->

</div>

<div class="bg-box">
    <div class="container">
        @include('components.reviews.last')  
    </div>
</div>
  
<div class="container">

    @include('components.articles.popular')

    @include('components.reviews.popular')

    <!-- faq -->
    @if (count($university['qas'])>0)
    <div class="faq">
        <div class="headline">
            <div class="ico">
            <svg class="icon">
                <use xlink:href="#message-ico"></use>
            </svg>
            </div>
            Часто задаваемые вопросы
        </div>
        <div class="accordion" id="acco">         
            @foreach ($university['qas'] as $key => $qa)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                        <button class="collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                            {{$qa->question}}
                        </button>
                        </h2>
                    </div>
                
                    <div id="collapse{{$key}}" class="collapse <?php if ($key==0){ echo 'show'; } ?>" aria-labelledby="heading{{$key}}" data-parent="#acco">
                        <div class="card-body">
                        <p>{{$qa->answer}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    @endif
    <!-- / faq -->

    <!-- text -->
    <div class="text">
        <h3 class="_change_able" data-key="university_last_info_h3" data-page="{{$_GET['_page']??''}}">{{$template['university_last_info_h3']??''}}</h3>
        <p class="_change_able" data-key="university_last_info_p" data-page="{{$_GET['_page']??''}}">
            <?php 
                if (strlen($template['university_last_info_p']??__('global_empty'))>500){ 
                    echo substr($template['university_last_info_p'], 0, 500).'<span class="big-dots">...</span><span class="extra-text d-none">'.substr($template['university_last_info_p'], 500).'<span>';
                }else{
                    echo $template['university_last_info_p']??__('global_empty');
                } 
            ?>
        </p>
        <?php if (strlen($template['university_last_info_p']??__('global_empty'))>500){ ?>
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