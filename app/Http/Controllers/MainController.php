<?php

namespace App\Http\Controllers;

use App\Services\Admin\Blog\ArticleService;
use App\Services\Admin\Review\ReviewService;
use App\Services\Admin\Setting\DirectionService;
use App\Services\Admin\Setting\EducationLevelService;
use App\Services\Admin\Setting\EducationTypeService;
use App\Services\Admin\University\UniversityService;
use Illuminate\Http\Request;

class MainController extends Controller
{

    private $universityService;
    private $directionService;
    private $educationTypeService;
    private $reviewService;
    private $educationLevelService;
    private $articleService;

    public function __construct()
    {
        $this->universityService = new UniversityService();
        $this->directionService = new DirectionService();
        $this->educationTypeService = new EducationTypeService();
        $this->reviewService = new ReviewService();
        $this->educationLevelService = new EducationLevelService();
        $this->articleService = new ArticleService();
    }
    
    // page main
    public function index(Request $request)
    {
        $data['title'] = __('main_page_title');

        // top universities
        $data['top_universities'] = $this->universityService->top();

        // popular reviews
        $data['popular_reviews'] = $this->reviewService->popular();

        // last reviews
        $data['last_reviews'] = $this->reviewService->last();

        return view('pages.welcome', $data);
    }

    // page search
    public function search(Request $request)
    {
        $data['title'] = __('search_page_title');

        $data['directions'] = $this->directionService->getAll();
        $data['education_types'] = $this->educationTypeService->getAll();
        $data['education_levels'] = $this->educationLevelService->getAll();

        // search result universities
        $data['list'] = $this->universityService->findAllFront();

        $data['popular_universities'] = $this->universityService->popular();
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['last_reviews'] = $this->reviewService->last();

        return view('pages.serach', $data);
    }

    // page universities
    public function universities(Request $request)
    {
        $data['title'] = __('universities_page_title');

        // directions
        $data['directions'] = $this->directionService->getAll();

        // popular universities
        $data['popular_universities'] = $this->universityService->popular();

        // popular reviews
        $data['popular_reviews'] = $this->reviewService->popular();

        // last reviews
        $data['last_reviews'] = $this->reviewService->last();

        // search result universities
        $data['list'] = $this->universityService->findAllFront();

        return view('pages.universities', $data);
    }

    // page university
    public function university(Request $request, $universitySlug)
    {
        $data['title'] = __('university_page_title');

        $data['university'] = $this->universityService->findBySlug($universitySlug);
        if (!$data['university']){ // not found
            return abort(404);
        }

        $data['title'] .= ' ' . $data['university']->name;

        // university reviews list
        $data['list'] = $this->reviewService->findByUniversity($data['university']->id);

        // popular reviews
        $data['popular_reviews'] = $this->reviewService->popular();

        // last reviews
        $data['last_reviews'] = $this->reviewService->last();

        return view('pages.university', $data);
    }

    // page reviews
    public function reviews(Request $request)
    {
        $data['title'] = __('reviews_page_title');

        // directions
        $data['directions'] = $this->directionService->getAll();

        // popular universities
        $data['popular_universities'] = $this->universityService->popular();

        // reviews
        $data['list'] = $this->reviewService->findAllFront();

        return view('pages.reviews', $data);
    }

    // page review
    public function review(Request $request, $reviewNumber)
    {
        $data['title'] = __('review_page_title');

        $data['current_review'] = $this->reviewService->findByNumber($reviewNumber);

        if (!$data['current_review']){
            abort(404);
        }

        $data['title'] .= ' ' . $data['current_review']->university_name . ' № ' . $data['current_review']->number;

        $data['popular_universities'] = $this->universityService->popular();
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['university_reviews'] = $this->reviewService->other_university($data['current_review']->university_id);


        return view('pages.review', $data);
    }

    // page articates
    public function articles(Request $request)
    {
        $data['title'] = __('articles_page_title');

        // articles
        $data['list'] = $this->articleService->findAllFront();

        // popular reviews
        $data['popular_reviews'] = $this->reviewService->popular();

        // last reviews
        $data['last_reviews'] = $this->reviewService->last();

        return view('pages.articles', $data);
    }

    // page article
    public function article(Request $request, $articleSlug)
    {
        $data['title'] = __('article_page_title');

        $data['current_article'] = $this->articleService->findBySlug($articleSlug);

        if (!$data['current_article']){
            abort(404);
        }

        // popular universities
        $data['popular_universities'] = $this->universityService->popular();

        // popular reviews
        $data['popular_reviews'] = $this->reviewService->popular();

        // last reviews
        $data['last_reviews'] = $this->reviewService->last();

        return view('pages.article', $data);
    }

    // page about
    public function about(Request $request)
    {
        $data['title'] = __('about_page_title');

        // popular universities
        $data['popular_universities'] = $this->universityService->popular();

        // popular reviews
        $data['popular_reviews'] = $this->reviewService->popular();

        // last reviews
        $data['last_reviews'] = $this->reviewService->last();

        return view('pages.about', $data);
    }

    // page educational
    public function educational(Request $request)
    {
        $data['title'] = __('educational_page_title');

        // popular universities
        $data['popular_universities'] = $this->universityService->popular();

        // popular reviews
        $data['popular_reviews'] = $this->reviewService->popular();

        // last reviews
        $data['last_reviews'] = $this->reviewService->last();

        return view('pages.educational', $data);
    }

    // page faq
    public function faq(Request $request)
    {
        $data['title'] = __('faq_page_title');

        // last reviews
        $data['last_reviews'] = $this->reviewService->last();

        return view('pages.faq', $data);
    }

    // page add review
    public function review_add(Request $request, $universitySlug)
    {
        $data['title'] = __('review_add_page');

        $data['university'] = $this->universityService->findBySlug($universitySlug);
        if (!$data['university']){ // not found
            return abort(404);
        }

        $data['title'] .= ' - ' . $data['university']->name;

        // last reviews
        $data['last_reviews'] = $this->reviewService->last();

        return view('pages.review_add', $data);
    }

    // page top
    public function top(Request $request)
    {
        $data['title'] = __('top_universities_page_title');

        // top universities
        $data['top_universities'] = $this->universityService->top();

        // popular reviews
        $data['popular_reviews'] = $this->reviewService->popular();

        // last reviews
        $data['last_reviews'] = $this->reviewService->last();

        return view('pages.top', $data);
    }

}
