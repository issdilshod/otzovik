<?php

namespace App\Services\Admin\Misc;

use App\Models\Admin\Setting\City;
use App\Models\Admin\Setting\Direction;
use App\Models\Admin\Setting\EducationLevel;
use App\Models\Admin\Setting\EducationType;
use App\Services\Service;
use Illuminate\Support\Facades\Config;

class SlugService extends Service{

    public static function isCity($slug)
    {
        if ($slug=='russia'){
            return $slug;
        }

        $city = City::where('status', Config::get('status.active'))
                    ->where('slug', $slug)
                    ->first();
        if ($city!=null){
            return $city->id;
        }
        return false;
    }

    public static function isDirection($slug)
    {
        if ($slug=='vse'){
            return $slug;
        }

        $direction = Direction::where('status', Config::get('status.active'))
                    ->where('slug', $slug)
                    ->first();
        if ($direction!=null){
            return $direction->id;
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

    public static function isUniversityFilter($slug)
    {
        if ($slug=='review' || $slug=='rate' || $slug=='new'){
            return true;
        }
        return false;
    }

    public static function isLevel($slug)
    {
        $educationLevel = EducationLevel::where('status', Config::get('status.active'))
                                ->where('slug', $slug)
                                ->first();
        if ($educationLevel!=null){
            return $educationLevel->id;
        }
        return false;
    }

    public static function isType($slug)
    {
        $educationType = EducationType::where('status', Config::get('status.active'))
                                ->where('slug', $slug)
                                ->first();
        if ($educationType!=null){
            return $educationType->id;
        }
        return false;
    }

}