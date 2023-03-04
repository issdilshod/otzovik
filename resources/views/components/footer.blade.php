<div class="container">
    <div class="sending">
        <div class="row">
          <div class="col-lg-6">
            <div class="headline">
              <div class="ico">
                <svg class="icon">
                  <use xlink:href="#send-ico"></use>
                </svg>
              </div>
              Подпишитесь на рассылку сегодня
            </div>
            <p>И будьте вкурсе всех новостей. Также вы будете получать уведомления о всех важных мероприятиях вузов и тд.</p>
          </div>
          <div class="col-lg-6 d-flex justify-content-end">
            <div class="send-inner">
              <div class="sending-group">
                    <form id="footer-submit">
                        <input id="footer-email" type="email" placeholder="Введите почту" class="form-control">
                        <button id="footer-subscribe" class="send-btn">
                            <svg class="icon">
                                <use xlink:href="#letter-ico"></use>
                            </svg>
                        </button>
                    </form>
              </div>
              <div class="agree">Нажимая на “Отправить” я соглашаюсь на <a href="{{url('legal')}}">обработку персональных данных</a> и <a href="{{url('policy')}}">политикой конфиденциальности</a> сайта</div>
            </div>
          </div>
        </div>
    </div>
    <div class="footer-top">
      <div class="f-col">
        <a href="#" class="logo"><img src="{{ asset('assets/images/white-logo.svg') }}" alt=""></a>
        <ul class="sm-socially">
          <li>
            <a href="#">
              <span class="ico twitter">
                <svg class="icon">
                  <use xlink:href="#twitter-ico"></use>
                </svg>
              </span>
            </a>
          </li>
          <li>
            <a href="#">
              <span class="ico vk">
                <svg class="icon">
                  <use xlink:href="#vk-ico"></use>
                </svg>
              </span>
            </a>
          </li>
          <li>
            <a href="#">
              <span class="ico ok">
                <svg class="icon">
                  <use xlink:href="#ok-ico"></use>
                </svg>
              </span>
            </a>
          </li>
          <li>
            <a href="#">
              <span class="ico youtube">
                <svg class="icon">
                  <use xlink:href="#youtube-ico"></use>
                </svg>
              </span>
            </a>
          </li>
          <li>
            <a href="#">
              <span class="ico viber">
                <svg class="icon">
                  <use xlink:href="#viber-full"></use>
                </svg>
              </span>
            </a>
          </li>
          <li>
            <a href="#">
              <span class="ico telegram">
                <svg class="icon">
                  <use xlink:href="#telegram-ico"></use>
                </svg>
              </span>
            </a>
          </li>
        </ul>
      </div>
      <div class="f-col">
        <div class="f-title">Об сервисе</div>
        <div class="f-list">
          <li><a href="{{url('o-service')}}">Об отзовике</a></li>
          <li><a href="{{url('posti')}}">Блог</a></li>
          <li><a href="#">Статьи</a></li>
          <li><a href="#">Авторы</a></li>
          <li><a href="{{url('faq')}}">FAQ</a></li>
          <li><a href="#">Карта сайта</a></li>
        </div>
      </div>
      <div class="f-col">
        <div class="f-title">Для учебных заведений </div>
        <div class="f-list">
          <li><a href="#">Условия сотрудничества</a></li>
          <li><a href="#">Добавить учебное заведение</a></li>
          <li><a href="#">Регистрация</a></li>
        </div>
      </div>
      <div class="f-col">
        <div class="f-title">Для абитуриентов</div>
        <div class="f-list">
          <li><a href="{{url('universitety')}}">Университеты</a></li>
          <li><a href="#">Рейтинг специальностей</a></li>
          <li><a href="#">Рейтинг ВУЗов</a></li>
          <li><a href="#">Карта учебных заведений</a></li>
          <li><a href="#">Вопросы о поступлении</a></li>
        </div>
      </div>
      <div class="f-col">
        <div class="f-title">Контакты</div>
        <div class="f-list">
          <li><a href="#">Электронная почта</a></li>
          <li><a href="#">форма обратной связи</a></li>          
        </div>
      </div>
    </div>
    <div class="footer-btm">
      <div class="copy">&copy; Otzovic.ru все права защищены</div>
      <a href="#">Условия использования</a>
      <a href="#">Политика конфиденциальности</a>
    </div>
</div>

<!-- Subscribe -->
<script>
    function subscribe(emailSelector)
    {
        var page = '<?=url()->current()?>';
        var email = $(emailSelector).val();

        if (email.length>3){

            var formData = new FormData();
            formData.append('page', page);
            formData.append('email', email);

            $.ajax({
                type: 'post',
                url: '<?=url('api/subscribe')?>',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    $('#modal02').modal('show');
                    $(emailSelector).val('');
                }
            });
        }
    }

    $(document).on('submit', '#footer-submit', function (e){
        e.preventDefault();
        subscribe('#footer-email');
    })

    $(document).on('submit', '#articles-submit', function (e){
        e.preventDefault();
        subscribe('#articles-email');
    })
</script>

<!-- text show more/less -->
<script>
    $(document).on('click', '.last-info-button', function(e){
        e.preventDefault();
        if (!$(this).parent().find('.big-dots').hasClass('d-none')){ // showing more
            $(this).parent().find('.big-dots').addClass('d-none');
            $(this).parent().find('.extra-text').removeClass('d-none');
            $(this).find('.last-info-button-text').text('Меньще');
        }else{ // showing less
            $(this).parent().find('.big-dots').removeClass('d-none');
            $(this).parent().find('.extra-text').addClass('d-none');
            $(this).find('.last-info-button-text').text('Читать дальше');
        }
    });
</script>

@if (isset($settings['mode']['mode']) && $settings['mode']['mode']==\Illuminate\Support\Facades\Config::get('app._mode.edit'))
<!-- modes -->
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- SweetAlert2 -->
<script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<input type="hidden" id="_user_id" value="{{$settings['mode']['user_id']}}" />
<input type="hidden" id="_token" value="{{$_GET['_token']}}" />
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    // disable a links for edit mode
    $(document).on('click', 'a', function(e){
        e.preventDefault();
    })

    // disable forms for edit mode
    $(document).on('submit', 'form', function(e){
        e.preventDefault();
    })

    // submit setting form(template)
    $(document).on('submit', '._setting_form', function (e){

        var user_id = $('#_user_id').val();
        var key = $('#_key').val();
        var value = $('#_value').val();
        var token = $('#_token').val();

        $.ajax({
            type: 'put',
            url: '<?=url('api/setting')?>/'+key,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+ token);
            },
            data: {
                user_id: user_id,
                value: value
            },
            success: function(res){
                $('#_modal1').modal('hide');

                $('._change_able[data-key='+key+']').attr('data-value', value);
                $('._change_able[data-key='+key+']').html(value);

                $('#_key').val('');
                $('#_value').val('');

                Toast.fire({
                    icon: 'success',
                    title: "{{__('global_success')}}"
                })

            },
            error: function(httpObj, textStatus) {       
                if(httpObj.status==200){
                    // Success
                }else if (httpObj.status==401){
                    Toast.fire({
                        icon: 'error',
                        title: "{{__('global_error')}}"
                    })
                }
            }
        });

    });

    // click elements to update
    $(document).on('click', '._change_able', function(e){
        var key = $(this).attr('data-key');
        var value = $(this).attr('data-value');

        $('#_key').val(key);
        $('#_value').val(value);

        $('#_modal1').modal('show');
    })

    // click ui submit
    function submit(){
        $('#_submit').click();
    }
</script>

<div class="modal fade" id="_modal1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{__('global_edit')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <form class="_setting_form">
                <input type="hidden" id="_key" />
                <div class="form-group">
                    <label for="_value">{{__('global_value')}}</label>
                    <textarea id="_value" class="form-control" style="height: 200px"></textarea> 
                </div>
                <input type="submit" id="_submit" class="d-none" />
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{__('global_close_button')}}</button>
            <button type="button" class="btn btn-primary" onclick="submit()">{{__('global_save_button')}}</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- /.modes -->
@endif