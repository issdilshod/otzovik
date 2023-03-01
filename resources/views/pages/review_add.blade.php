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
        <li class="active">Оставить отзыв</li>
      </ol>
    </nav>

    @if($university)
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
                </div>
            </div>
            <div class="hero-img">
                    <div class="university-full-logo"><img src="{{ asset('storage/'.$university->logo) }}" alt=""></div>
                    @if ($university->accreditation)
                    <div class="accreditation"><div class="inner">Гос Аккредитация: Есть</div></div>  
                    @endif
            </div>
        </div>
        <!-- / hero -->   
    @endif

    <!-- form-block -->
    <div class="form-block white-form">
      <form id="review-add-form">
        @csrf
        @if($university)
        <input id="university_id" name="university_id" type="hidden" value="{{$university->id}}" />
        @endif
        <h2>Оставить отзыв</h2>
        <div class="row">
            @if (!$university)
                <div class="col-lg-4">
                    <div class="form-group">
                    <select name="city_id" class="form-control" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                        @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                    <select id="university_id" name="university_id" class="form-control" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                        @foreach ($universities as $university)
                            <option value="{{$university->id}}">{{$university->name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            @endif
          <div class="col-lg-4">
            <div class="form-group"><input name="first_name" type="text" placeholder="Имя*" class="form-control"></div>
          </div>
          <div class="col-lg-4">
            <div class="form-group"><input name="last_name" type="text" placeholder="Фамилия" class="form-control"></div>
          </div>
          <div class="col-lg-4">
            <div class="form-group"><input name="email" type="email" placeholder="Почта*" class="form-control"></div>
          </div>
          <div class="col-lg-12">
            <div class="form-group"><textarea name="text" placeholder="Отзыв*" cols="30" rows="10" class="form-control"></textarea></div>
          </div>
        </div>
        <div class="form-block-btm">
          <button class="btn has-ico" id="review-post-button" disabled="disabled">
            <span class="ico">
              <svg class="icon">
                <use xlink:href="#letter-ico"></use>
              </svg>
            </span>
            Оставить отзыв
          </button>
          <div class="rateit-wrapper">
            <div id="rateit" class="rateit"></div>
            <div id="value" class="value">0.0</div>
          </div>
          <div class="file-box">
            <input type="file" name="file" data-jcf='{"buttonText": "", "placeholderText": "Загрузить фото: jpg или png"}'>
          </div>
        </div>
        <div class="ch-item">
          <input type="checkbox" name="f-agr" id="f-agr">
          <label for="f-agr">Я ознакомился с <a href="{{url('legal')}}">политикой конфиденциальности</a> и даю согласование на <a href="{{url('policy')}}">обработку персональных данных</a></label>
        </div>
      </form>
    </div>
    <!-- / form-block -->
    <script>
        // aggreement
        $(document).on('click', '#f-agr', function(e){
            if($(this).is(':checked')){
                $('#review-post-button').removeAttr('disabled');
            }else{
                $('#review-post-button').attr('disabled', 'disabled');
            }
        });

        // ajax send review
        $(document).on('submit', '#review-add-form', function(e){
            e.preventDefault();

            var validated = true;

            // empty
            if ($('input[name="first_name"]').val()=='' || $('input[name="first_name"]').val().length>20){
                $('input[name="first_name"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }else{
                $('input[name="first_name"]').removeAttr('style');
            }
            if ($('input[name="email"]').val()==''){
                $('input[name="email"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }else{
                $('input[name="email"]').removeAttr('style');
            }
            if ($('textarea[name="text"]').val()==''){
                $('textarea[name="text"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }else{
                $('textarea[name="text"]').removeAttr('style');
            }

            // length
            if ($('input[name="last_name"]').val().length>20){
                $('input[name="last_name"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }else{
                $('input[name="last_name"]').removeAttr('style');
            }

            // star validation
            if (parseInt($('#value').html())<1){
                $('#value').css('text-shadow', '1px 1px 1px rgb(255 0 0 / 38%)');
                validated = false;
            }else{
                $('#value').removeAttr('style');
            }

            // validate email for cyrillic
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test($('input[name="email"]').val())){
                $('input[name="email"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }else{
                $('input[name="email"]').removeAttr('style');
            }

            if (!validated){ return false; }

            // serialize to form data
            var formData = new FormData();
            if ($('input[name="file"]').prop('files').length>0){
                formData.append('avatar', $('input[name="file"]').prop('files')[0]);
            }

            formData.append('first_name', $('input[name="first_name"]').val());
            formData.append('last_name', $('input[name="last_name"]').val());
            formData.append('email', $('input[name="email"]').val());
            formData.append('text', $('textarea[name="text"]').val());
            formData.append('university_id', $('#university_id').val());
            formData.append('_token', $('input[name="_token"]').val());
            formData.append('star', $('#value').html());

            //var data = serializeObject($(this));

            $.ajax({
                type: 'post',
                url: '<?=url('api/review')?>',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    $('#modal03').modal('show');
                }
            });
        });

        // on modal hide
        $(document).on('hide.bs.modal', "#modal03", function(){
            var unSlug = '{{$university->slug}}';
            var link = '';
            if (unSlug!=''){
                link = '<?=url('universitet/'.$university->slug)?>';
            }else{
                link = '<?=url('universitety')?>';
            }
            window.location.href = link;
        });
    </script>
</div>

<div class="bg-box">
    <div class="container">
        @include('components.reviews.last')    
    </div>
</div>
  
<div class="container">         
    <!-- text -->
    <div class="text">
        <h3 class="_change_able" data-key="review_add_last_info_h3" data-value="{{$template['review_add_last_info_h3']}}">{{$template['review_add_last_info_h3']}}</h3>
        <p class="_change_able" data-key="review_add_last_info_p" data-value="{{$template['review_add_last_info_p']}}">{{$template['review_add_last_info_p']}}</p>
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

@include('components.modals.success-review-post')

@include('components.svgs.welcome')

@stop