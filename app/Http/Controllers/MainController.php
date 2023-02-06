<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\University\UniversityService;
use Illuminate\Http\Request;

class MainController extends Controller
{

    private $universityService;

    public function __construct()
    {
        $this->universityService = new UniversityService();
    }
    
    // page main
    public function index(Request $request)
    {
        $data['title'] = __('main_page_title');

        // top universities
        $data['top_universities'] = $this->universityService->top();

        return view('pages.welcome', $data);
    }

    // page search
    public function search(Request $request)
    {
        $data['title'] = __('search_page_title');

        return view('pages.serach', $data);
    }

    // page universities
    public function universities(Request $request)
    {
        $data['title'] = __('universities_page_title');

        return view('pages.universities', $data);
    }

    // page university
    public function university(Request $request, $universitySlug)
    {
        $data['title'] = __('university_page_title');

        return view('pages.university', $data);
    }

    // page reviews
    public function reviews(Request $request)
    {
        $data['title'] = __('reviews_page_title');

        return view('pages.reviews', $data);
    }

    // page review
    public function review(Request $request, $reviewSlug)
    {
        $data['title'] = __('review_page_title');

        return view('pages.review', $data);
    }

    // page articates
    public function articles(Request $request)
    {
        $data['title'] = __('articles_page_title');

        return view('pages.articles', $data);
    }

    // page article
    public function article(Request $request, $articleSlug)
    {
        $data = [];

        return view('pages.article', $data);
    }

    // page about
    public function about(Request $request)
    {
        $data['title'] = __('about_page_title');

        return view('pages.about', $data);
    }

    // page educational
    public function educational(Request $request)
    {
        $data['title'] = __('educational_page_title');

        return view('pages.educational', $data);
    }

    // page faq
    public function faq(Request $request)
    {
        $data['title'] = __('faq_page_title');

        return view('pages.faq', $data);
    }

    // page add review
    public function review_add(Request $request)
    {
        $data = [];

        return view('pages.review_add', $data);
    }

    // page top
    public function top(Request $request)
    {
        $data = [];

        return view('pages.top', $data);
    }

}
