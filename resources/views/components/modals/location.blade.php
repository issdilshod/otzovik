<!-- Modal -->
<div class="modal fade" id="modal01" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">      
      <form>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <div class="modal-title">Где вы находитесь?</div>
        <div class="full-search">                      
          <div class="form-group">
            <input type="text" class="form-control search-location" placeholder="Укажите местоположение">
            <div class="search-btn">
              <svg class="icon">
                <use xlink:href="#search-ico"></use>
              </svg>
            </div>            
          </div>          
        </div>
        <ul class="city-list">
            <li>
                <?php $value = ['name'=> 'Россия', 'slug'=> 'russia', 'id'=> '']; ?>
                <a class="choose-location" data-data="{{json_encode($value)}}">Россия</a>
            </li>
            @foreach ($cities as $city)
                <li>
                    <?php $value = ['name' => $city->name, 'slug' => $city->slug, 'id' => $city->id ]; ?>
                    <a class="choose-location" data-data="{{json_encode($value)}}">{{$city->name}}</a>
                </li> 
            @endforeach  
        </ul>
      </form>
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
        e.preventDefault();

        var tmpData = $(this).data('data');

        // set location to template
        $('.location .name').html(tmpData['name']);

        var data = JSON.stringify(tmpData);

        localStorage.setItem('_location', data);

        setCookie('_location', tmpData['slug'], 31);
    });

    // search more cities
    $(document).on('click', '.full-search .search-btn', function(e){
        e.preventDefault();

        var value = $('.search-location').val();

        // TODO: Ajax request and show in form
    })

    // set cookie
    function setCookie(name, value, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }
</script>