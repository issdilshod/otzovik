<?php

namespace App\Services\Admin\Misc;

use App\Services\Service;

class UrlService extends Service{

    public static function url_direction($url, $directionSlug = '', $withCity = true, $definedCity = '')
    {
        $citySlug = (isset($_COOKIE['_location'])?$_COOKIE['_location']:'russia');

        if ($definedCity!=''){ $citySlug = $definedCity; }

        return url($url.($withCity?($citySlug!=''?'/'.$citySlug:''):'').($directionSlug!=''?'/'.$directionSlug:''));
    }

    public static function url_location($city = '', $direction = '')
    {
        return url('/universitety'.($city!=''?'/'.$city:'').($direction!=''?'/'.$direction:''));
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

    public static function url_templater_loc_dir($city = '', $direction = '')
    {
        $fullUrl = url()->full();
        $tmpLink = explode('?', $fullUrl);

        if (isset($_GET['d']) && $direction==''){
            $direction = $_GET['d'];
        }

        if (isset($_GET['c']) && $city==''){
            $city = $_GET['c'];
        }

        $attr = '';
        if ($city!=''){
            $attr.='?c='.$city;
        }

        if ($direction!=''){
            if ($attr==''){
                $attr.='?';
            }else{
                $attr.='&';
            }
            $attr.='d='.$direction;
        }

        return $tmpLink[0].$attr;
    }

}