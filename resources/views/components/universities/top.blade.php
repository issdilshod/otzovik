<div class="container">
      <!-- top-rate -->
      <div class="top-rate">
        <div class="centered-title">
          <div class="headline">
            <span class="ico">
              <svg class="icon">
                <use xlink:href="#cup-ico"></use>
              </svg>
            </span>
            <span class="color">Топ 10</span> ВУЗов по оценкам пользователей
          </div>
          <p>Мы провели анализ и собрали для вас лучшие вузы по оценкам пользователей из разных регионов.</p>
        </div>
        <div class="top-table">
          <div class="top-table-title">
            <div class="cell cell01">№</div>
            <div class="cell cell02">Название орзанизации</div>
            <div class="cell cell03">Мировой рейтинг</div>
            <div class="cell cell03">Российский рейтинг</div>
            <div class="cell cell03">Отзывы компании</div>
          </div>
          <div class="top-table-body">
            @foreach ($top_universities as $key => $university) 
                
                <div class="top-table-row">
                    <div class="cell cell01">{{\Illuminate\Support\Str::of(($key+1))->padLeft(2, '0')}}</div>
                    <div class="cell cell04"><img src="{{ asset('storage/'.$university->logo) }}" alt=""></div>
                    <div class="cell cell02"><p><a href="{{url('/universitet/'.$university->slug)}}" target="_blank">{{$university->name}}</a></p></div>
                    <div class="cell cell03" data-title="Мировой рейтинг">
                        <div class="rate-info">
                        <span class="ico">
                            <svg class="icon">
                            <use xlink:href="#medal-ico"></use>
                            </svg>
                        </span>
                        {{$university->worlds_rate}}
                        </div>
                    </div>
                    <div class="cell cell03" data-title="Российский рейтинг">
                        <div class="rate-info">
                        <span class="ico">
                            <svg class="icon">
                            <use xlink:href="#medal01-ico"></use>
                            </svg>
                        </span>
                        {{$university->russian_rate}}
                        </div>
                    </div>
                    <div class="cell cell03" data-title="Отзывы компании">
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
            @endforeach
          </div>
        </div>
        @if(!isset($remove_more))
            <div class="text-center"><a href="{{url('/top-universitety')}}" class="btn">Посмотреть все</a></div>
        @endif
        
      </div>
      <!-- / top-rate -->
</div>