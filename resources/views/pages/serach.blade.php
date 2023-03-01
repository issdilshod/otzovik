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
            <h3 class="_change_able" data-key="search_form_h3" data-value="{{$template['search_form_h3']}}">{{$template['search_form_h3']}}</h3>
            <div class="form-row">
            <div class="form-group size01">
                <label for="place">Регион</label>
                <div class="input-wrapper">
                <input type="text" placeholder="" id="place" data-slug="">
                <div class="input-hint" style="display:none">
                    <ul></ul>
                </div>
                </div>
            </div>
            <div class="form-group size02">
                <label>Направление</label>
                <select id="jcf-direction" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                    @foreach ($directions as $direction)
                        <option value="{{$direction->slug}}">{{$direction->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group size03">
                <label>Уровень образования</label>
                <select id="jcf-level" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                    @foreach ($education_levels as $education_level)
                        <option value="{{$education_level->slug}}">{{$education_level->name}}</option>
                    @endforeach                
                </select>
            </div>
            <div class="form-group size04">
                <label>Форма обучения</label>
                <select id="jcf-type" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                    @foreach ($education_types as $education_type)
                        <option value="{{$education_type->slug}}">{{$education_type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="form-btn">
                <svg class="icon">
                    <use xlink:href="#search-ico"></use>
                </svg>
                Искать
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
            <h2 class="_change_able" data-key="search_honest_h2" data-value="{{$template['search_honest_h2']}}">{{$template['search_honest_h2']}}</h2>
            <p class="_change_able" data-key="search_honest_p" data-value="{{$template['search_honest_p']}}">{{$template['search_honest_p']}}</p>
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
            <h3 class="_change_able" data-key="search_last_info_h3" data-value="{{$template['search_last_info_h3']}}">{{$template['search_last_info_h3']}}</h3>
            <p class="_change_able" data-key="search_last_info_p" data-value="{{$template['search_last_info_p']}}">{{$template['search_last_info_p']}}</p>
            <a href="#" class="btn has-ico bordered-btn more-btn">
                Читать дальше
                <span class="ico">
                <svg class="icon">
                    <use xlink:href="#arrow-ico"></use>
                </svg>
                </span>
            </a>
        </div>
        <!-- / text -->

    </div>
</main>

@include('components.modals.location')

@include('components.modals.success-subscribe')

@include('components.svgs.welcome')

<script>
    var globUrl = "{{url('/poisk')}}";

    // on location input change
    $(document).on('keyup', '#place', function(e){
        var searchValue = $(this).val();

        var urlValue = '';
        if (searchValue.length>0){
            urlValue = '/'+searchValue;
        }

        $('.input-hint').show();

        $.ajax({
            type: 'get',
            url: '<?=url('api/cities')?>'+urlValue,
            success: function(res){
                $('.input-hint>ul').html('');
                if (res.data.length>0){
                    for (let key in res.data){
                        var origCity = res.data[key]['name'].toLowerCase();
                        searchValue = searchValue.charAt(0).toUpperCase() + searchValue.slice(1);

                        $('.input-hint>ul').append('<li><a href="#" data-slug="'+res.data[key]['slug']+'" data-name="'+res.data[key]['name']+'">'+'<span>'+searchValue+'</span>'+origCity.slice(searchValue.length)+'</a></li>');
                    }
                }else{
                    // TODO: Not found
                }
            }
        });
    });

    // location autocomplete click
    $(document).on('click', '.input-hint>ul>li>a', function(e){
        e.preventDefault();

        $('#place').attr('data-slug', $(this).data('slug'));
        $('#place').val($(this).data('name'));
        $('.input-hint').hide();
    });

    // on search form submit
    $(document).on('submit', '.form>form', function(e){
        e.preventDefault();

        var city = $('#place').data('slug');
        var direction = $('#jcf-direction').val();
        var level = $('#jcf-level').val();
        var type = $('#jcf-type').val();

        window.location.href = globUrl + '/' + city + '/' + direction + '/' + level + '/' + type;
    })
</script>

@stop