<?php

namespace App\Services\Admin\Setting;

use App\Models\Admin\Setting\Seo;
use App\Services\Service;

class SeoService extends Service{

    public function save($seo, $url)
    {
        $seoOrg = Seo::where('url', $url)
                        ->first();
        
        if ($seoOrg==null){
            return response()->json(['msg' => 'seo not found'], 404);
            
        }

        $seoOrg->update($seo);
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