<!-- popular -->
<div class="popular">
  <div class="title-wrap">
    <div class="headline">
      <div class="ico">
        <svg class="icon">
          <use xlink:href="#crown-ico"></use>
        </svg>
      </div>
      Популярные статьи
    </div>
    <a href="{{url('/posti')}}" class="btn">Смотреть все статьи</a>
  </div>
  <div class="row">

    @foreach ($popular_articles as $article)
        <div class="col-lg-4">
            <div class="news-card">
                <a href="{{url('post/'.$article->slug)}}">
                <div class="news-card-img">
                    <img src="{{ asset('storage/'.$article->cover) }}" alt="">
                    <div class="date-label">
                    <div class="ico">
                        <svg class="icon">
                        <use xlink:href="#calendar-ico"></use>
                        </svg>
                    </div>
                    {{\App\Services\Admin\Misc\SystemService::get_date_for_blog($article->udpated_at)}}
                    </div>
                </div>
                <div class="news-card-title">{{$article->title}}</div>
                <p>{{\Illuminate\Support\Str::limit($article->text, 86, '...')}}</p>
                </a>
            </div>
        </div>
    @endforeach

  </div>
</div>
<!-- / popular -->