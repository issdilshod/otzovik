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
        <li class="active">Часто задаваемые вопросы</li>
      </ol>
    </nav>

    <!-- hero -->
    <div class="hero">
      <div class="hero-text has-size">
        <h1 class="_change_able" data-key="faq_top_info_h1" data-page="{{$_GET['_page']??''}}">{{$template['faq_top_info_h1']??__('global_empty')}}</h1>
        <p class="_change_able" data-key="faq_top_info_p" data-page="{{$_GET['_page']??''}}">{{$template['faq_top_info_p']??__('global_empty')}}</p>
      </div>
      <div class="hero-img hero-faq-img"><img src="{{ asset('assets/images/illustration06.svg') }}" alt=""></div>
    </div>
    <!-- / hero --> 

    <!-- faq -->
    <div class="faq">   
        <div class="accordion" id="acco">

            @foreach ($qas as $key => $qa)
            <div class="card" data-id="{{$qa->id}}">
                <div class="card-header" id="heading{{$key}}">
                    <h2 class="mb-0">
                    <button class="collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">{{$qa->question}}</button>
                    </h2>
                </div>
            
                <div id="collapse{{$key}}" class="collapse <?php if ($key==0){ echo 'show'; } ?>" aria-labelledby="heading{{$key}}" data-parent="#acco">
                    <div class="card-body">
                    <p>{{$qa->answer}}</p>
                    </div>
                </div>
            </div>  
            @endforeach

        </div>

        @if (isset($settings['mode']['mode']) && $settings['mode']['mode']==\Illuminate\Support\Facades\Config::get('app._mode.edit'))
        <div class="plus-card">
            Добавить блок
        </div>
        <style>
            .plus-card{
                padding: 20px;
                text-align: center;
                border: 1px dashed #e5ecfb;
                border-radius: 10px;
                cursor: pointer;
                transition: .4s;
            }
            .plus-card:hover{
                background-color: #e5ecfb5e;
            }
        </style>
        <script>
            var elementsCount = parseInt('{{count($qas)}}');

            // add new
            $(document).on('click', '.plus-card', function(){
                $('#_id').val('');
                $('#_question').val('');
                $('#_answer').val('');

                $('#_modal2').modal('show');
            });

            // edit exists
            $(document).on('click', '.card', function(){
                var id = $(this).data('id');
                var question = $(this).find('button').html();
                var answer = $(this).find('p').html();

                $('#_id').val(id);
                $('#_question').val(question);
                $('#_answer').val(answer);

                $('#_modal2').modal('show');
            });

            $(document).on('submit', '._setting_form1', function (e){
                e.preventDefault();
                
                var token = $('#_token').val();
                var user_id = $('#_user_id').val();
                var question = $('#_question').val();
                var answer = $('#_answer').val();
                var id = '';
                if ($('#_id').val()){
                    id=$('#_id').val();
                }

                if (id!=''){ // edit
                    $.ajax({
                        type: 'put',
                        url: '<?=url('api/qa')?>/'+id,
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('Authorization', 'Bearer '+ token);
                        },
                        data: {
                            user_id: user_id,
                            question: question,
                            answer: answer
                        },
                        success: function(res){
                            $('#_modal2').modal('hide');

                            $('.card[data-id='+id+']').find('button').html(question);
                            $('.card[data-id='+id+']').find('p').html(answer);

                            $('#_id').val('');
                            $('#_question').val('');
                            $('#_answer').val('');
                        }
                    });
                }else{ // add
                    $.ajax({
                        type: 'post',
                        url: '<?=url('api/qa')?>',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('Authorization', 'Bearer '+ token);
                        },
                        data: {
                            user_id: user_id,
                            question: question,
                            answer: answer
                        },
                        success: function(res){
                            $('#_modal2').modal('hide');

                            $('#acco').append('<div class="card" data-id="'+res.id+'"><div class="card-header" id="heading'+elementsCount+'"><h2 class="mb-0"><button class="collapsed" type="button" data-toggle="collapse" data-target="#collapse'+elementsCount+'" aria-expanded="true" aria-controls="collapse'+elementsCount+'">'+question+'</button></h2></div><div id="collapse'+elementsCount+'" class="collapse" aria-labelledby="heading'+elementsCount+'" data-parent="#acco"><div class="card-body"><p>'+answer+'</p></div></div></div>');

                            elementsCount++;

                            $('#_id').val('');
                            $('#_question').val('');
                            $('#_answer').val('');
                        }
                    });
                }

            });

            function submitFaq(){
                $('#_submit1').click();
            }
        </script>

        <div class="modal fade" id="_modal2">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('global_edit')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="_setting_form1">
                        <input type="hidden" id="_id" />
                        <div class="form-group">
                            <label for="_question">{{__('university_question')}}</label>
                            <input id="_question" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="_answer">{{__('university_answer')}}</label>
                            <textarea id="_answer" class="form-control" style="height: 200px"></textarea> 
                        </div>
                        <input type="submit" id="_submit1" class="d-none" />
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('global_close_button')}}</button>
                    <button type="button" class="btn btn-primary" onclick="submitFaq()">{{__('global_save_button')}}</button>
                </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        @endif
    </div>
    <!-- / faq -->

</div>
<div class="bg-box">
    <div class="container">
        @include('components.reviews.last')
    </div>
</div>

<div class="container">         
    <!-- text -->
    <div class="text">
        <h3 class="_change_able" data-key="faq_last_info_h3" data-page="{{$_GET['_page']??''}}">{{$template['faq_last_info_h3']??__('global_empty')}}</h3>
        <p class="_change_able" data-key="faq_last_info_p" data-page="{{$_GET['_page']??''}}">
            <?php 
                if (strlen($template['faq_last_info_p']??__('global_empty'))>500){ 
                    echo substr($template['faq_last_info_p'], 0, 500).'<span class="big-dots">...</span><span class="extra-text d-none">'.substr($template['faq_last_info_p'], 500).'<span>';
                }else{
                    echo $template['faq_last_info_p']??__('global_empty');
                } 
            ?>
        </p>
        <?php if (strlen($template['faq_last_info_p'])>500){ ?>
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

@include('components.svgs.welcome')

@stop