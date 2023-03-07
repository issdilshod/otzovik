<?php

namespace App\Services\Admin\Setting;

use App\Models\Admin\Setting\Seo;
use App\Services\Service;

class SeoService extends Service{

    public function save($seo, $url)
    {
        $seoOrg = Seo::where('url', $url)
                        ->first();
        
        if ($seoOrg==null){ // add new
            $seo['url'] = $url;
            $seoOrg = Seo::create($seo);
        }else{
            $seoOrg->update($seo);
        }

        return $seoOrg;
    }

    public function findByUrl($url)
    {
        $seo = Seo::where('url', $url)
                    ->first();
        if ($seo==null){

        }

        return $seo;
    }

}