<?php

namespace App\Services\Admin\Misc;

use App\Services\Service;

class UrlService extends Service{

    public static function url_direction($url, $directionSlug = '', $withCity = true)
    {
        $citySlug = (isset($_COOKIE['_location'])?$_COOKIE['_location']:'russia');

        return url($url.($withCity?($citySlug!=''?'/'.$citySlug:''):'').($directionSlug!=''?'/'.$directionSlug:''));
    }

    public static function url_canonical()
    {
        $fullUrl = url()->full();

        $fullUrl = preg_replace('/page\d+/', '', $fullUrl);

        $tmpLink = explode('?', $fullUrl);

        // last one is slash then remove slash
        if (substr($tmpLink[0], strlen($tmpLink[0])-1, 1)=='/'){ $tmpLink[0] = substr($tmpLink[0], 0, strlen($tmpLink[0])-1); }

        return $tmpLink[0];
    }

}