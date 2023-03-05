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
            <li class="active">Поиск университета</li>
        </ol>
        </nav>
        <!-- form -->
        <div class="form">
        <form>
            <h3 class="_change_able" data-key="search2_form_h3" data-value="{{$template['search2_form_h3']}}">{{$template['search2_form_h3']}}</h3>
            <div class="form-row">
                <div class="form-group size05">
                    <label for="search">Поиск</label>
                    <div class="input-wrapper">
                    <input type="text" placeholder="Уральский федеральный университет" id="search" name="q" value="<?php if (isset($_GET['q'])){echo $_GET['q'];}?>">              
                    </div>
                    <button class="search-btn">
                        <svg class="icon">
                            <use xlink:href="#search-ico"></use>
                        </svg>
                    </button>
                </div>          
            </div>
        </form>
        </div>
        <!-- / form -->

        <!-- institutions -->
        <div class="institutions">
            <div class="headline">
                <div class="ico">
                <svg class="icon">
                    <use xlink:href="#teacher-full"></use>
                </svg>
                </div>
                Найдено {{$list->total()}} учебных заведения
            </div>
            <div class="row">
                @foreach ($list as $item)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="institution-card">
                            <div class="institution-title"><a href="{{url('/universitet/'.$item->slug)}}">{{$item->name}}</a></div>
                            <div class="institution-img"><a href="{{url('/universitet/'.$item->slug)}}"><img src="{{asset('/storage/'.$item->logo)}}" alt=""></a></div>
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
                            @if($item->accreditation)
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
            <h2 class="_change_able" data-key="search2_honest_h2" data-value="{{$template['search2_honest_h2']}}">{{$template['search2_honest_h2']}}</h2>
            <p class="_change_able" data-key="search2_honest_p" data-value="{{$template['search2_honest_p']}}">{{$template['search2_honest_p']}}</p>
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
            <h3 class="_change_able" data-key="search2_last_info_h3" data-value="{{$template['search2_last_info_h3']}}">{{$template['search2_last_info_h3']}}</h3>
            <p class="_change_able" data-key="search2_last_info_p" data-value="{{$template['search2_last_info_p']}}">
                <?php 
                    if (strlen($template['search2_last_info_p']>500)){ 
                        echo substr($template['search2_last_info_p'], 0, 500).'<span class="big-dots">...</span><span class="extra-text d-none">'.substr($template['search2_last_info_p'], 500).'<span>';
                    }else{
                        echo $template['search2_last_info_p'];
                    } 
                ?>
            </p>
            <?php if (strlen($template['search2_last_info_p']>500)){ ?>
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