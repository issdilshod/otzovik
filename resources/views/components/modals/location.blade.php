<!-- Modal -->
<div class="modal fade" id="modal01" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content"> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <div class="modal-title">Где вы находитесь?</div>
        <div class="full-search">                      
            <div class="form-group">
            <input type="text" class="form-control search-location" placeholder="Укажите местоположение">
            <div class="search-btn-loc">
                <svg class="icon">
                <use xlink:href="#search-ico"></use>
                </svg>
            </div>            
            </div>          
        </div>
        <ul class="city-list">
            <li>
                <?php $value = ['name'=> 'Россия', 'slug'=> 'russia', 'id'=> '']; ?>
                <a href="{{App\Services\Admin\Misc\UrlService::url_location($value['slug'], $current_direction??'')}}" class="choose-location" data-data="{{json_encode($value)}}">Россия</a>
            </li>
            @foreach ($cities as $city)
                <li>
                    <?php $value = ['name' => $city->name, 'slug' => $city->slug, 'id' => $city->id ]; ?>
                    <a href="{{App\Services\Admin\Misc\UrlService::url_location($value['slug'], $current_direction??'')}}" class="choose-location" data-data="{{json_encode($value)}}">{{$city->name}}</a>
                </li> 
            @endforeach
        </ul>
    </div>  
  </div>
</div>

<script>
    // on document ready set default location as Moscow
    $(document).ready(function(){
        var storageLocation = localStorage.getItem('_location');

        var currentCity = '', citySlug = '';

        if (storageLocation){
            storageLocation = JSON.parse(storageLocation);
            currentCity = storageLocation['name'];
            citySlug = storageLocation['slug'];
        }else{
            // default Russia
            var defaultLocation = {name: 'Россия', slug: 'russia', id: ''};
            storageLocation = JSON.stringify({name: 'Россия', slug: 'russia', id: ''});
            localStorage.setItem('_location', storageLocation);
            currentCity = defaultLocation.name;
            citySlug = defaultLocation.slug;
        }

        // set location to template
        $('.location .name').html(currentCity);

        // set to cookie
        setCookie('_location', citySlug, 31);
    })

    // choose location and save to storage
    $(document).on('click', '.choose-location', function(e){
        let prev = "<?php if (isset($is_link)){echo '0';}else{echo '1';}?>";

        if (prev=='1'){
            e.preventDefault();
        }

        var tmpData = $(this).data('data');

        // set location to template
        $('.location .name').html(tmpData['name']);

        var data = JSON.stringify(tmpData);

        localStorage.setItem('_location', data);

        setCookie('_location', tmpData['slug'], 31);
    });

    // search more cities
    $(document).on('click', '.full-search .search-btn-loc', function(e){
        e.preventDefault();

        var currentDir = "{{$current_direction??''}}";
        var mainUrl = "{{url('/universitety')}}";

        var value = $('.search-location').val();
        var url = '<?=url('api/cities')?>'+(value?'/'+value:'');

        $.ajax({
            type: 'get',
            url: url,
            success: function(res){
                $('.city-list').html('');

                // set to modal
                var li = document.createElement('li');
                var a = document.createElement('a');
                a.href = mainUrl+'/russia'+(currentDir!=''?'/'+currentDir:'');
                a.classList.add('choose-location');
                a.dataset.data = JSON.stringify({name: 'Россия', slug: 'russia', id: ''});
                a.innerText = 'Россия';
                li.appendChild(a);

                $('.city-list').append(li);

                //var result = '<li><a href="'+mainUrl+'/russia'+(currentDir!=''?'/'+currentDir:'')+'" class="choose-location" data-data="'+JSON.stringify({name: 'Россия', slug: 'russia', id: ''})+'">Россия</a></li>';
                for (var i in res.data){
                    var li1 = document.createElement('li');
                    var a1 = document.createElement('a');
                    a1.href = mainUrl+'/'+res.data[i].slug+(currentDir!=''?'/'+currentDir:'');
                    a1.classList.add('choose-location');
                    a1.dataset.data = JSON.stringify(res.data[i]);
                    a1.innerText = res.data[i].name;
                    li1.appendChild(a1);

                    $('.city-list').append(li1);

                    //result+='<li><a href="'+mainUrl+'/'+res.data[i].slug+(currentDir!=''?'/'+currentDir:'')+'" class="choose-location" data-data="'+JSON.stringify(res.data[i])+'">'+res.data[i].name+'</a></li>';
                }

            }
        });
    })

    // set cookie
    function setCookie(name, value, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }
</script>