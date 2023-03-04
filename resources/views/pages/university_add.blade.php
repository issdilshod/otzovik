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
        <li class="active">Добавить ВУЗ</li>
      </ol>
    </nav>

    <!-- form-block -->
    <div class="form-block white-form">
        <form id="university-add-form">
            @csrf
            <h2>Добавить ВУЗ</h2>
            <p>Таким образом, укрепление и развитие внутренней структуры представляет собой интересный эксперимент проверки соответствующих условий активизации.</p>
            <h4>Данные заявителя</h4>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="text" name="user_first_name" placeholder="Имя*" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="text" name="user_last_name" placeholder="Фамилия" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="text" name="user_middle_name" placeholder="Отчество" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="email" name="user_email" placeholder="Почта*" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="tel" name="user_phone" placeholder="Телефон*" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="tel" name="user_extra_phone" placeholder="Дополнительный телефон" class="form-control" />
                    </div>
                </div>          
            </div>
            <h4>Данные о ВУЗе</h4>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Наименование ВУЗа*" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <select class="form-control" name="city_id" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <input type="text" name="address" placeholder="Адрес*" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="text" name="website" placeholder="Сайт*" class="form-control" />
                    </div>
                </div>          
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="tel" name="phones" placeholder="Телефон*" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="tel" name="extra_phones" placeholder="Дополнительный телефон" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Почта*" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <textarea name="description" placeholder="Комментарии*" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-block-btm">
                <button class="btn has-ico" id="university-post-button" disabled="disabled">
                    <span class="ico">
                    <svg class="icon">
                        <use xlink:href="#letter-ico"></use>
                    </svg>
                    </span>
                    Добавить ВУЗ
                </button>
                <div class="file-box">
                    <input type="file" name="file" data-jcf='{"buttonText": "", "placeholderText": "Загрузить фото: jpg или png"}'>
                </div>
            </div>
            <div class="ch-item">
                <input type="checkbox" name="f-agr" id="f-agr">
                <label for="f-agr">Я ознакомился с <a href="{{url('policy')}}">политикой конфиденциальности</a> и даю согласование на <a href="{{url('legal')}}">обработку персональных данных</a></label>
            </div>
        </form>
    </div>
    <!-- / form-block -->
    <script>
        // aggreement
        $(document).on('click', '#f-agr', function(e){
            if($(this).is(':checked')){
                $('#university-post-button').removeAttr('disabled');
            }else{
                $('#university-post-button').attr('disabled', 'disabled');
            }
        });

        // ajax send university
        $(document).on('submit', '#university-add-form', function(e){
            e.preventDefault();

            var validated = true;

            // user validation
            if ($('input[name="user_first_name"]').val()==''){
                $('input[name="user_first_name"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }
            if ($('input[name="user_email"]').val()==''){
                $('input[name="user_email"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }
            if ($('input[name="user_phone"]').val()==''){
                $('input[name="user_phone"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }

            // university validation
            if ($('input[name="name"]').val()==''){
                $('input[name="name"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }
            if ($('input[name="address"]').val()==''){
                $('input[name="address"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }
            if ($('input[name="website"]').val()==''){
                $('input[name="website"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }
            if ($('input[name="phones"]').val()==''){
                $('input[name="phones"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }
            if ($('input[name="email"]').val()==''){
                $('input[name="email"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }
            if ($('textarea[name="description"]').val()==''){
                $('textarea[name="description"]').css('border', '1px solid rgb(255 0 0 / 38%)');
                validated = false;
            }

            if (!validated){ return false; }

            // *** serialize to form data
            var formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
            // user data
            if ($('input[name="file"]').prop('files').length>0){
                formData.append('avatar', $('input[name="file"]').prop('files')[0]);
            }
            formData.append('user[first_name]', $('input[name="user_first_name"]').val());
            formData.append('user[middle_name]', $('input[name="user_middle_name"]').val());
            formData.append('user[last_name]', $('input[name="user_last_name"]').val());
            formData.append('user[email]', $('input[name="user_email"]').val());
            formData.append('user[phone]', $('input[name="user_phone"]').val());
            formData.append('user[extra_phone]', $('input[name="extra_phone"]').val());

            // university data
            formData.append('university[name]', $('input[name="name"]').val());
            formData.append('university[city_id]', $('select[name="city_id"]').val());
            formData.append('university[address]', $('input[name="address"]').val());
            formData.append('university[website]', $('input[name="website"]').val());
            formData.append('university[phones]', $('input[name="phones"]').val());
            formData.append('university[extra_phones]', $('input[name="extra_phones"]').val());
            formData.append('university[email]', $('input[name="email"]').val());
            formData.append('university[description]', $('textarea[name="description"]').val());

            //var data = serializeObject($(this));

            $.ajax({
                type: 'post',
                url: '<?=url('api/university')?>',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    $('#modal05').modal('show');
                }
            });
        });

        // on modal hide
        $(document).on('hide.bs.modal', "#modal05", function(){
            window.location.reload();
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
        <h3 class="_change_able" data-key="university_add_last_info_h3" data-value="{{$template['university_add_last_info_h3']}}">{{$template['university_add_last_info_h3']}}</h3>
        <p class="_change_able" data-key="university_add_last_info_p" data-value="{{$template['university_add_last_info_p']}}">
            <?php 
                if (strlen($template['university_add_last_info_p']>500)){ 
                    echo substr($template['university_add_last_info_p'], 0, 500).'<span class="big-dots">...</span><span class="extra-text d-none">'.substr($template['university_add_last_info_p'], 500).'<span>';
                }else{
                    echo $template['university_add_last_info_p'];
                } 
            ?>
        </p>
        <?php if (strlen($template['university_add_last_info_p']>500)){ ?>
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

@include('components.modals.success-university-post')

@include('components.svgs.welcome')

@stop