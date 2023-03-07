<ul class="tags">
    <li>
        <a href="{{\App\Services\Admin\Misc\UrlService::url_direction(url($this_page??'/universitety'), '', $with_city??true)}}" class="<?php if(isset($current_direction) && $current_direction==''){ echo 'active'; } ?>">Все</a>
    </li>
    @foreach ($directions as $direction)
        <li>
            <a href="{{\App\Services\Admin\Misc\UrlService::url_direction(url($this_page??'/universitety'), $direction->slug, $with_city??true)}}" class="<?php if (isset($current_direction) && $current_direction==$direction->slug){ echo 'active'; }?>">{{$direction->name}}</a>
        </li>
    @endforeach
</ul>