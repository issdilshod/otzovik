<div class="container">
    <div class="sending">
      <form>
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
                <input id="footer-email" type="email" placeholder="Введите почту" class="form-control">
                <button id="footer-subscribe" class="send-btn">
                  <svg class="icon">
                    <use xlink:href="#letter-ico"></use>
                  </svg>
                </button>
              </div>
              <div class="agree">Нажимая на “Отправить” я соглашаюсь на <a href="#">обработку персональных данных</a> и <a href="#">политикой конфиденциальности</a> сайта</div>
            </div>
          </div>
        </div>
      </form>
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
          <li><a href="#">Об отзовике</a></li>
          <li><a href="#">Блог</a></li>
          <li><a href="#">Статьи</a></li>
          <li><a href="#">Авторы</a></li>
          <li><a href="#">FAQ</a></li>
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
          <li><a href="#">Университеты</a></li>
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

    $(document).on('click', '#footer-subscribe', function (e){
        e.preventDefault();
        subscribe('#footer-email');
    })

    $(document).on('click', '#articles-subscribe', function (e){
        e.preventDefault();
        subscribe('#articles-email');
    })

</script>

@if (isset($settings['mode']))
@if ($settings['mode']['mode']==\Illuminate\Support\Facades\Config::get('app._mode.edit'))
<!-- modes -->
<input type="hidden" id="_user_id" value="{{$settings['mode']['user_id']}}" />
<script>
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

        $.ajax({
            type: 'put',
            url: '<?=url('api/setting')?>/'+key,
            data: {
                user_id: user_id,
                value: value
            },
            success: function(res){
                $('#_modal1').modal('hide');

                // TODO: update template & modal
                $('#_key').val('');
                $('#_value').val('');

            }
        });

    });

    // click elements to update
    $(document).on('click', '._change_able', function(e){
        var key = $(this).data('key');
        var value = $(this).data('value');

        $('#_key').val(key);
        $('#_value').html(value);

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
@endif