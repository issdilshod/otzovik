<?php

namespace App\Services\Admin\Misc;

use App\Models\Admin\Setting\City;
use App\Models\Admin\Setting\Direction;
use App\Models\Admin\Setting\EducationLevel;
use App\Models\Admin\Setting\EducationType;
use App\Services\Service;
use Illuminate\Support\Facades\Config;

class SlugService extends Service{

    public static function isCity($slug, $returnModel = false)
    {
        if ($slug=='russia'){
            if ($returnModel){ return ['name' => 'Россия', 'slug' => 'russia']; } else { return $slug; }
        }

        $city = City::where('status', Config::get('status.active'))
                    ->where('slug', $slug)
                    ->first();
        if ($city!=null){
            if ($returnModel){ return $city; } else { return $city->id; }
        }
        return false;
    }

    public static function isDirection($slug, $returnModel = false)
    {
        if ($slug=='vse'){
            if ($returnModel){ return ['name' => 'Все', 'slug' => 'vse']; } else { return $slug; }
        }

        $direction = Direction::where('status', Config::get('status.active'))
                    ->where('slug', $slug)
                    ->first();
        if ($direction!=null){
            if ($returnModel){ return $direction; } else { return $direction->id; }
        }
        return false;
    }

    public static function isPage($page)
    {
        if (strlen($page)<5){ // string is few than excepted
            return false;
        }
        // detect if page
        $pageLeft = substr($page, 0, 4);
        $pageRight = substr($page, 4);

        if ((int)$pageRight!=$pageRight){ // number is not int
            return false;
        }

        return (int)$pageRight;
    }

}