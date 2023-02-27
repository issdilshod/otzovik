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
        <li><a href="{{url('posti')}}">Блог</a></li>     
        <li class="active">{{$current_article->title}}</li>
      </ol>
    </nav>

    <!-- article -->
    <div class="article">
      <h1>{{$current_article->title}}</h1>
      <figure><img src="{{ asset('storage/'.$current_article->cover) }}" alt=""></figure>
      <p><?=$current_article->text?></p>
      <hr>  
      <div class="article-bottom">
        <div class="socially-wrap">
          <p>Поделиться в соц сетях</p>
          <ul class="content-socially">
            <li>
              <a href="#">
                <span class="ico fb">
                  <svg class="icon">
                    <use xlink:href="#fb-ico"></use>
                  </svg>
                </span>
              </a>
            </li>
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
                <span class="ico telegram">
                  <svg class="icon">
                    <use xlink:href="#telegram-ico"></use>
                  </svg>
                </span>
              </a>
            </li>                    
            <li>
              <a href="#">
                <span class="ico viber">
                  <svg class="icon">
                    <use xlink:href="#viber-ico"></use>
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
          </ul>
        </div>
        <div class="right">
          <div class="date">{{\App\Services\Admin\Misc\SystemService::get_dateTime_human($current_article->updated_at)}}</div>
          <div class="name">{{$current_article->user_first_name}} {{$current_article->user_last_name}}</div>
        </div>
      </div>
    </div>
    <!-- / article -->

    <!-- reviews-list -->
    <div class="reviews-list">
        <div class="headline">Комментарии</div>

        @foreach ($current_article['comments'] as $comment)
            <div class="review-card">
                <div class="review-card-top">
                <div class="user">
                    <div class="user-photo">
                        <img src="@if ($comment->user_avatar){{ asset('storage/'.$comment->user_avatar) }}@else{{'https://cdn-icons-png.flaticon.com/512/847/847969.png'}}@endif" alt="">
                    </div>
                    <div class="review-user-name">{{$comment->user_first_name}} {{$comment->user_last_name}}</div>
                </div>
                @if ($comment->replay_id)
                <div class="answer">
                    В ответе к: <span>{{$comment->replay_user_first_name}} {{$comment->replay_user_last_name}}</span>
                </div>
                @endif
                <div class="date">{{\App\Services\Admin\Misc\SystemService::get_dateTime_human($comment->updated_at)}}</div>
                <div class="rating">
                    @for ($i = 0; $i < 5; $i++)
                        @if (($i+.5)==$comment->star)
                            <span><img src="{{ asset('assets/images/star-half.svg') }}" alt=""></span>
                        @elseif ($i<$comment->star)
                            <span><img src="{{ asset('assets/images/star.svg') }}" alt=""></span>
                        @else
                            <span><img src="{{ asset('assets/images/star-empty.svg') }}" alt=""></span> 
                        @endif
                    @endfor
                    <span>{{$comment->star}}</span>
                </div>
                </div>
                <p>{{$comment->text}}</p>
                <div class="review-bottm-nav">
                <a class="like" id="like{{$comment->id}}" data-id="{{$comment->id}}" data-type="{{\Illuminate\Support\Facades\Config::get('like.like')}}">
                    <span class="ico">
                        <svg class="icon">
                            <use xlink:href="#like-ico"></use>
                        </svg>
                    </span>
                    <span class="count">{{$comment->likes_count}}</span>
                </a>
                <a class="like" id="dislike{{$comment->id}}" data-id="{{$comment->id}}" data-type="{{\Illuminate\Support\Facades\Config::get('like.dislike')}}">
                    <span class="ico">
                        <svg class="icon">
                            <use xlink:href="#dislike-ico"></use>
                        </svg>
                    </span>
                    <span class="count">{{$comment->dislikes_count}}</span>
                </a>
                <a class="replay-to" data-id="{{$comment->id}}">Ответить</a>
                </div>
            </div>
        @endforeach
      
    </div>
    <!-- / reviews-list -->

    <!-- form-block -->
    <div class="form-block">
        <form id="comment-add-form">
            @csrf
            <input name="article_id" type="hidden" value="{{$current_article->id}}" />
            <h2>Оставить комментарий</h2>
            <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <input name="first_name" type="text" placeholder="Имя*" class="form-control" />
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <input name="last_name" type="text" placeholder="Фамилия" class="form-control" />
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <input name="email" type="email" placeholder="Почта*" class="form-control" />
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <textarea name="text" placeholder="Комментарий*" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            </div>
            <div class="form-block-btm">
            <button class="btn has-ico">
                <span class="ico">
                <svg class="icon">
                    <use xlink:href="#letter-ico"></use>
                </svg>
                </span>
                Оставить комментарий
            </button>
            <div class="rateit-wrapper">
                <div id="rateit" class="rateit"></div>
                <div id="value" class="value">0.0</div>
            </div>
            <div class="file-box">
                <input type="file" name="file" data-jcf='{"buttonText": "", "placeholderText": "Загрузить фото: jpg или png"}'>
            </div>
            </div>
        </form>
    </div>
    <!-- / form-block -->
    <script>
        // ajax send comment
        $(document).on('submit', '#comment-add-form', function(e){
            e.preventDefault();

            var validated = true;

            // validation
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
            formData.append('article_id', $('input[name="article_id"]').val());

            if (typeof $('input[name="replay_id"]').val()!='undefined'){
                formData.append('replay_id', $('input[name="replay_id"]').val());
            }

            formData.append('_token', $('input[name="_token"]').val());
            formData.append('star', $('#value').html());

            $.ajax({
                type: 'post',
                url: '<?=url('api/comment')?>',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    $('#modal04').modal('show');
                }
            });
        });

        // reply to comment
        $(document).on('click', '.replay-to', function (e){
            e.preventDefault();

            var replyHidden = document.createElement('input');
            replyHidden.setAttribute('type', 'hidden');
            replyHidden.setAttribute('name', 'replay_id');
            replyHidden.setAttribute('value', $(this).data('id'));
            $('#comment-add-form').append(replyHidden);

            // native JS
            let form = document.getElementById('comment-add-form');
            form.scrollIntoView({behavior: "smooth", block: "center"});
        })

        // like & dislike
        $(document).on('click', '.like', function (e){
            e.preventDefault();

            var commentId = $(this).data('id');

            $.ajax({
                type: 'post',
                url: '<?=url('api/like')?>',
                data: {comment_id: commentId, type: $(this).data('type')},
                success: function(res){

                    $('#like'+commentId+' .count').html(res.comment_like.likes_count);
                    $('#dislike'+commentId+' .count').html(res.comment_like.dislikes_count);
                }
            });
        })

        // on modal hide
        $(document).on('hide.bs.modal', "#modal04", function(){
            window.location.reload();
        });
    </script>

    @include('components.articles.popular')

</div>

<div class="bg-box">
    <div class="container">
        @include('components.reviews.last')  
    </div>
</div>

<div class="container">
    
    @include('components.universities.popular')

    @include('components.reviews.popular')
    
</div>
</main>

@include('components.modals.location')

@include('components.modals.success-subscribe')

@include('components.modals.success-comment-post')

@include('components.svgs.welcome')

@stop