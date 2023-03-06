<?php

namespace App\Services\Admin\Misc;

use App\Services\Service;

class UrlService extends Service{

    public static function url_direction($url, $directionSlug = '')
    {
        $citySlug = (isset($_COOKIE['_location'])?$_COOKIE['_location']:'russia');

        return url($url.($citySlug!=''?'/'.$citySlug:'').($directionSlug!=''?'/'.$directionSlug:''));
    }

}