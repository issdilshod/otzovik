<!-- / hero -->
<div class="title-wrap">
    <div class="headline">
    <div class="ico">
        <svg class="icon">
        <use xlink:href="#files-colorful"></use>
        </svg>
    </div>
    Другие отзывы о ВУЗе
    </div>
    <a href="{{url('/otzyvy')}}" class="btn">Читать все отзывы</a>
</div>
<!-- reviews -->
<div class="reviews">
  <div class="reviews-slider slider review-02 swiper">
    <div class="swiper-wrapper">

        @foreach ($university_reviews as $review)
            <div class="swiper-slide">
                <div class="review-card">
                <div class="review-user-name">{{$review->user_first_name}} {{$review->user_last_name}}</div>
                <div class="date">{{\App\Services\Admin\Misc\SystemService::get_dateTime_human($review->updated_at)}}</div>
                <div class="rating">
                    @for ($i = 0; $i < 5; $i++)
                        @if (($i+.5)==$review->star)
                            <span><img src="{{ asset('assets/images/star-half.svg') }}" alt=""></span>
                        @elseif ($i<$review->star)
                            <span><img src="{{ asset('assets/images/star.svg') }}" alt=""></span>
                        @else
                            <span><img src="{{ asset('assets/images/star-empty.svg') }}" alt=""></span> 
                        @endif
                    @endfor
                    <span>{{$review->star}}</span>
                </div>
                <p>
                    <a href="{{url('/otzyv/'.$review->number)}}">{{\Illuminate\Support\Str::limit($review->text, 179, '...')}}</a>
                </p>
                <div class="review-subtitle">Отзыв про:</div>
                <p>
                    <strong>
                        <a href="{{url('/universitet/'.$review->university_slug)}}">{{$review->university_name}}</a>
                    </strong>
                </p>
                </div>
            </div>
        @endforeach

    </div>
  </div>
  <div class="slider-nav">
    <div class="swiper-pagination slider-pagination review-02-pagination"></div>
    <div class="slider-nav-btns">
      <div class="swiper-button-prev review-prev02"></div>
      <div class="swiper-button-next review-next02"></div>
    </div>
  </div>
</div>
<!-- / review -->