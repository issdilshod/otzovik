<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Services\Admin\Setting\CityService;
use App\Services\Admin\Setting\DirectionService;
use App\Services\Admin\Setting\SeoService;
use App\Services\Admin\Setting\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{

    private $settingService;
    private $seoService;
    private $directionService;
    private $cityService;

    public function __construct()
    {
        $this->settingService = new SettingService();
        $this->seoService = new SeoService();
        $this->directionService = new DirectionService();
        $this->cityService = new CityService();
    }

    public function api_update(Request $request, $key)
    {
        $validated = $request->validate([
            'value' => 'required',
            'page' => '',
            'user_id' => '',
        ]);

        $this->settingService->saveByKey($validated, $key);

        return response()->json(['msg' => 'success'], 200);
    }

    public function index(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/').'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.index'),
            'seo' => $this->seoService->findByUrl('home'),
            'token' => Session::get('token')[0]
        ]);
    }

    public function search(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/poisk').'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.search'),
            'seo' => $this->seoService->findByUrl('poisk'),
            'token' => Session::get('token')[0]
        ]);
    }

    public function search2(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/poisk2').'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.search2'),
            'seo' => $this->seoService->findByUrl('poisk2'),
            'token' => Session::get('token')[0]
        ]);
    }

    public function universities(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/universitety'.($request->c?'/'.$request->c:'').($request->d?'/'.$request->d:'')).'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.universities'),
            'seo' => $this->seoService->findByUrl('universitety'),
            'token' => Session::get('token')[0],
            'directions' => $this->directionService->getAll(),
            'cities' => $this->cityService->getAll(),
            'd' => $request->d??''
        ]);
    }

    public function university(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/universitet').'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.university')
        ]);
    }

    public function reviews(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/otzyvy'.($request->d?'/'.$request->d:'')).'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.reviews'),
            'seo' => $this->seoService->findByUrl('otzyvy'),
            'token' => Session::get('token')[0],
            'directions' => $this->directionService->getAll(),
        ]);
    }

    public function review(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/otzyv').'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.review')
        ]);
    }

    public function review_add(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/dobavit-otzyv').'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.review_add'),
            'seo' => $this->seoService->findByUrl('dobavit-otzyv'),
            'token' => Session::get('token')[0]
        ]);
    }

    public function articles(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/posti').'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.articles'),
            'seo' => $this->seoService->findByUrl('posti'),
            'token' => Session::get('token')[0]
        ]);
    }

    public function about(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/o-service').'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.about'),
            'seo' => $this->seoService->findByUrl('o-service'),
            'token' => Session::get('token')[0]
        ]);
    }

    public function faq(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/faq').'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.faq'),
            'seo' => $this->seoService->findByUrl('faq'),
            'token' => Session::get('token')[0]
        ]);
    }

    public function educational(Request $request)
    {
        // permission

        return view('admin.pages.setting.setting.settings', [
            'src' => url('/uchebnim-zavedeniyam').'?_mode='.Config::get('app._mode.edit').'&_token='.Session::get('token')[0].'&_page='.Config::get('pages.educational'),
            'seo' => $this->seoService->findByUrl('uchebnim-zavedeniyam'),
            'token' => Session::get('token')[0]
        ]);
    }

}
