<div class="container">
    <div class="header-top">
        <<?php echo (request()->is('/'))?'span':'a';?> href="{{url('/')}}" class="logo">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="">
        </<?php echo (request()->is('/'))?'span':'a';?>>
        <div class="slogan">Независимый сервис по оценке <br>высших учебных заведений</div>

        <a href="#" data-toggle="modal" data-target="#modal01" class="location">
            <span class="ico">
                <svg class="icon">
                    <use xlink:href="#location-ico"></use>
                </svg>
            </span>
            <span class="name"></span>
        </a>

        <ul class="socially">
            <li>
                <a href="https://{{$template['header_vk']}}" target="_blank" class="_change_able" data-key="header_vk" data-value="{{$template['header_vk']}}">
                    <span class="ico vk">
                    <svg class="icon">
                        <use xlink:href="#vk-ico"></use>
                    </svg>
                    </span>
                </a>
            </li>
            <li>
                <a href="https://{{$template['header_telegram']}}" target="_blank" class="_change_able" data-key="header_telegram" data-value="{{$template['header_telegram']}}">
                    <span class="ico telegram">
                    <svg class="icon">
                        <use xlink:href="#telegram-ico"></use>
                    </svg>
                    </span>
                </a>
            </li>
            <li>
                <a href="https://{{$template['header_viber']}}" target="_blank" class="_change_able" data-key="header_viber" data-value="{{$template['header_viber']}}">
                    <span class="ico viber">
                    <svg class="icon">
                        <use xlink:href="#viber-ico"></use>
                    </svg>
                    </span>
                </a>
            </li>
        </ul>

        <a href="{{url('/dobavit-otzyv')}}" class="btn has-ico">
            <span class="ico">
            <svg class="icon">
                <use xlink:href="#files-ico"></use>
            </svg>
            </span>
            Оставить отзыв
        </a>

    </div>
    <div class="header-bottom">      
      <ul class="main-nav">
        <li><a href="{{ url('/poisk') }}">Подобрать ВУЗ</a></li>
        <li><a href="{{ url('/universitety') }}">Университеты</a></li>
        <li><a href="{{ url('/otzyvy') }}">Отзывы</a></li>
        <li><a href="{{ url('/posti') }}">Блог</a></li>
        <li><a href="{{ url('/o-service') }}">О сервисе</a></li>
        <li><a href="{{ url('/faq') }}">FAQ</a></li>
        <li><a href="{{ url('/uchebnim-zavedeniyam') }}">Учебным заведениям</a></li>
      </ul>
      <div class="search">
        <form id="poisk2" action="{{url('/poisk2')}}">
          <div class="search-ico">
            <svg class="icon">
              <use xlink:href="#search-ico"></use>
            </svg>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="q" value="<?php if (isset($_GET['q'])){echo $_GET['q'];}?>">
            <div class="search-btn">
              <svg class="icon">
                <use xlink:href="#search-ico"></use>
              </svg>
            </div>
            <a href="#" class="close"></a>
          </div>
        </form>
        <script>
            $(document).on('click', '.search-btn', function(){
                $('#poisk2').submit();
            });
        </script>
      </div>
      <div class="nav-ico"></div>
    </div>
    <div class="backdrop"></div>
</div>