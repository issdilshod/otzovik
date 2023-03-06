<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Services\Admin\Setting\SeoService;
use Illuminate\Http\Request;

class SeoController extends Controller
{

    private $seoService;

    public function __construct()
    {
        $this->seoService = new SeoService();
    }
    
    public function api_update(Request $request, $url)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $seo = $this->seoService->save($validated, $url);

        return $seo;
    }

}
