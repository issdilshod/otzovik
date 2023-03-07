<?php

namespace App\Services\Admin\Misc;

use App\Services\Service;

class UrlService extends Service{

    public static function url_direction($url, $directionSlug = '', $withCity = true)
    {
        $citySlug = (isset($_COOKIE['_location'])?$_COOKIE['_location']:'russia');

        return url($url.($withCity?($citySlug!=''?'/'.$citySlug:''):'').($directionSlug!=''?'/'.$directionSlug:''));
    }

}