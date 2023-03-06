<ul class="tags">
    <li>
        <a href="{{\App\Services\Admin\Misc\UrlService::url_direction(url('/universitety'), '')}}" class="<?php if(isset($current_direction) && $current_direction==''){ echo 'active'; } ?>">Все</a>
    </li>
    @foreach ($directions as $direction)
        <li>
            <a href="{{\App\Services\Admin\Misc\UrlService::url_direction(url('/universitety'), $direction->slug)}}" class="<?php if (isset($current_direction) && $current_direction==$direction->slug){ echo 'active'; }?>">{{$direction->name}}</a>
        </li>
    @endforeach
</ul>