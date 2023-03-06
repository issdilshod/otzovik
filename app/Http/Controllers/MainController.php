<?php

namespace App\Http\Controllers;

use App\Services\Admin\Blog\ArticleService;
use App\Services\Admin\Blog\ArticleViewService;
use App\Services\Admin\Blog\CommentService;
use App\Services\Admin\Misc\SlugService;
use App\Services\Admin\Review\ReviewService;
use App\Services\Admin\Setting\CityService;
use App\Services\Admin\Setting\DirectionService;
use App\Services\Admin\Setting\EducationLevelService;
use App\Services\Admin\Setting\EducationTypeService;
use App\Services\Admin\Setting\QaService;
use App\Services\Admin\Setting\SettingService;
use App\Services\Admin\University\UniversityService;
use App\Services\MainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class MainController extends Controller
{

    private $mainService;
    private $universityService;
    private $directionService;
    private $educationTypeService;
    private $reviewService;
    private $educationLevelService;
    private $articleService;
    private $articleViewService;
    private $commentService;
    private $cityService;
    private $settingService;
    private $qaService;

    public function __construct()
    {
        $this->mainService = new MainService();
        $this->universityService = new UniversityService();
        $this->directionService = new DirectionService();
        $this->educationTypeService = new EducationTypeService();
        $this->reviewService = new ReviewService();
        $this->educationLevelService = new EducationLevelService();
        $this->articleService = new ArticleService();
        $this->articleViewService = new ArticleViewService();
        $this->commentService = new CommentService();
        $this->cityService = new CityService();
        $this->settingService = new SettingService();
        $this->qaService = new QaService();
    }

    // e 404
    public function e404(Request $request)
    {
        $data['cities'] = $this->cityService->findAll(); 
        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.index'));
        $data['settings']['current_page'] = Config::get('pages.index');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return $data;
    }
    
    // page main
    public function index(Request $request)
    {
        $data['title'] = __('main_page_title');

        $data['cities'] = $this->cityService->findAll(); 

        $data['top_universities'] = $this->universityService->top();
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['last_reviews'] = $this->reviewService->last();
        $data['popular_articles'] = $this->articleService->popular();  

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.index'));
        $data['settings']['current_page'] = Config::get('pages.index');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.welcome', $data);
    }

    // page search
    public function search(Request $request, $slug1 = '', $slug2 = '', $slug3 = '')
    {
        // detect slugs
        $city = ''; $direction = ''; $page = '';
        $level = (isset($request->level)?$request->level:''); $type = (isset($request->type)?$request->type:''); 

        $data['current_direction'] = '';
        $data['current_location'] = ['name' => 'Россия', 'slug' => 'russia'];

        // slug1
        if (SlugService::isCity($slug1)){ $city = SlugService::isCity($slug1); }
        if (SlugService::isDirection($slug1)){ $data['current_direction'] = $slug1; $direction = SlugService::isDirection($slug1); }
        if (SlugService::isPage($slug1)){ $page = SlugService::isPage($slug1); }
        // slug2
        if (SlugService::isDirection($slug2)){ $data['current_direction'] = $slug2; $direction = SlugService::isDirection($slug2); }
        if (SlugService::isPage($slug2)){ $page = SlugService::isPage($slug2); }
        // slug3
        if (SlugService::isPage($slug3)){ $page = SlugService::isPage($slug3); }

        // if city equals russia then all cities
        if ($city=='russia'){ $city = ''; }

        // if direction equals vse then all directions
        if ($direction=='vse'){ $direction = ''; }

        // breadcrumbs
        $data['breadcrumbs'] = [];
        if (SlugService::isCity($slug1)){ 
            $tmp = SlugService::isCity($slug1, true);
            $data['breadcrumbs'][] = [
                'link' => 'poisk/'.$tmp['slug'],
                'title' => $tmp['name']
            ];
            $data['current_location'] = $tmp;
        }

        if (SlugService::isDirection($slug1)){ 
            $tmp = SlugService::isDirection($slug1, true);
            $data['breadcrumbs'][] = [
                'link' => (count($data['breadcrumbs'])>0?$data['breadcrumbs'][0]['link'].'/'.$tmp['slug']:'univetrsitety/'.$tmp['slug']),
                'title' => $tmp['name']
            ];
        }

        if (SlugService::isDirection($slug2)){ 
            $tmp = SlugService::isDirection($slug2, true);
            $data['breadcrumbs'][] = [
                'link' => (count($data['breadcrumbs'])>0?$data['breadcrumbs'][0]['link'].'/'.$tmp['slug']:'univetrsitety/'.$tmp['slug']),
                'title' => $tmp['name']
            ];
        }

        $data['title'] = __('search_page_title');

        $data['directions'] = $this->directionService->getAll();
        $data['education_types'] = $this->educationTypeService->getAll();
        $data['education_levels'] = $this->educationLevelService->getAll();
        $data['cities'] = $this->cityService->findAll(); 

        // search result universities
        $data['list'] = $this->universityService->findAllFront($city, $direction, $page, '', $level, $type);

        $data['popular_universities'] = $this->universityService->popular();
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['last_reviews'] = $this->reviewService->last();

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.search'));
        $data['settings']['current_page'] = Config::get('pages.search');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.serach', $data);
    }

    // page search
    public function search2(Request $request)
    {
        // detect searched
        $name = '';
        if (isset($request->q)){
            $name = $request->q;
        }

        $data['title'] = __('search_page_title');

        $data['cities'] = $this->cityService->findAll(); 

        // search result universities
        $data['list'] = $this->universityService->findAll($name);

        $data['popular_universities'] = $this->universityService->popular();
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['last_reviews'] = $this->reviewService->last();

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.search2'));
        $data['settings']['current_page'] = Config::get('pages.search2');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.serach2', $data);
    }

    // page universities
    public function universities(Request $request, $slug1 = '', $slug2 = '', $slug3 = '')
    {
        // detect slugs
        $city = ''; $direction = ''; $page = ''; 
        $filter = (isset($request->filter)?$request->filter:'');

        $data['current_direction'] = '';
        $data['current_filter'] = $filter;

        // slug1
        if (SlugService::isCity($slug1)){ $city = SlugService::isCity($slug1); }
        if (SlugService::isDirection($slug1)){ $data['current_direction'] = $slug1; $direction = SlugService::isDirection($slug1); }
        if (SlugService::isPage($slug1)){ $page = SlugService::isPage($slug1); }
        // slug2
        if (SlugService::isDirection($slug2)){ $data['current_direction'] = $slug2; $direction = SlugService::isDirection($slug2); }
        if (SlugService::isPage($slug2)){ $page = SlugService::isPage($slug2); }
        // slug3
        if (SlugService::isPage($slug3)){ $page = SlugService::isPage($slug3); }

        // if city equals russia then all cities
        if ($city=='russia'){ $city = ''; }

        // if direction equals vse then all directions
        if ($direction=='vse'){ $direction = ''; }

        // breakcrumbs
        $data['breadcrumbs'] = [];

        if (SlugService::isCity($slug1)){ 
            $tmp = SlugService::isCity($slug1, true);
            $data['breadcrumbs'][] = [
                'link' => 'univetrsitety/'.$tmp['slug'],
                'title' => $tmp['name']
            ];
        }

        if (SlugService::isDirection($slug1)){ 
            $tmp = SlugService::isDirection($slug1, true);
            $data['breadcrumbs'][] = [
                'link' => (count($data['breadcrumbs'])>0?$data['breadcrumbs'][0]['link'].'/'.$tmp['slug']:'univetrsitety/'.$tmp['slug']),
                'title' => $tmp['name']
            ];
        }

        if (SlugService::isDirection($slug2)){ 
            $tmp = SlugService::isDirection($slug2, true);
            $data['breadcrumbs'][] = [
                'link' => (count($data['breadcrumbs'])>0?$data['breadcrumbs'][0]['link'].'/'.$tmp['slug']:'univetrsitety/'.$tmp['slug']),
                'title' => $tmp['name']
            ];
        }


        $data['title'] = __('universities_page_title');

        $data['directions'] = $this->directionService->getAll();
        $data['cities'] = $this->cityService->findAll(); 

        $data['popular_universities'] = $this->universityService->popular();
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['last_reviews'] = $this->reviewService->last();
        $data['list'] = $this->universityService->findAllFront($city, $direction, $page, $filter);

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.universities'));
        $data['settings']['current_page'] = Config::get('pages.universities');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.universities', $data);
    }

    // page university
    public function university(Request $request, $universitySlug = '', $slug1 = '')
    {
        $page = ''; $data['review_active'] = false;
        if (SlugService::isPage($slug1)){ $page = SlugService::isPage($slug1); $data['review_active'] = true; }

        // mode of page
        $data['settings']['mode'] = $this->mainService->_mode($request);

        $data['title'] = __('university_page_title');

        if (!$data['settings']['mode'] && $universitySlug==''){
            return abort(404);
        }else if (!$data['settings']['mode'] && $universitySlug!=''){
            $data['university'] = $this->universityService->findBySlug($universitySlug);
            if (!$data['university']){ // not found
                return abort(404);
            }
        }else{
            $data['university'] = $this->universityService->first();
        }

        $data['university']->statistic = $this->reviewService->staticticByUniversity($data['university']->id);

        $data['title'] .= ' ' . $data['university']->name;
        $data['cities'] = $this->cityService->findAll();

        $data['list'] = $this->reviewService->findByUniversity($data['university']->id, $page);
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['last_reviews'] = $this->reviewService->last();
        $data['popular_articles'] = $this->articleService->popular(); 

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.university'));
        $data['settings']['current_page'] = Config::get('pages.university');
        

        return view('pages.university', $data);
    }

    // page add university
    public function university_add(Request $request)
    {
        // mode of page
        $data['settings']['mode'] = $this->mainService->_mode($request);

        $data['title'] = __('university_add_page_title');

        $data['cities'] = $this->cityService->findAll();
        $data['last_reviews'] = $this->reviewService->last();

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.university_add'));
        $data['settings']['current_page'] = Config::get('pages.university_add');

        return view('pages.university_add', $data);
    }

    // page reviews
    public function reviews(Request $request, $slug1 = '')
    {
        $page = '';
        if (SlugService::isPage($slug1)){ $page = SlugService::isPage($slug1); }

        $data['title'] = __('reviews_page_title');

        $data['directions'] = $this->directionService->getAll();
        $data['cities'] = $this->cityService->findAll(); 

        $data['popular_universities'] = $this->universityService->popular();
        $data['last_articles'] = $this->articleService->last();
        $data['list'] = $this->reviewService->findAllFront($page);

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.reviews'));
        $data['settings']['current_page'] = Config::get('pages.reviews');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.reviews', $data);
    }

    // page review
    public function review(Request $request, $reviewNumber = '')
    {
        // mode of page
        $data['settings']['mode'] = $this->mainService->_mode($request);

        $data['title'] = __('review_page_title');

        if (!$data['settings']['mode'] && $reviewNumber==''){
            return abort(404);
        }else if (!$data['settings']['mode'] && $reviewNumber!=''){
            $data['current_review'] = $this->reviewService->findByNumber($reviewNumber);
            if (!$data['current_review']){
                return abort(404);
            }
        }else{
            $data['current_review'] = $this->reviewService->first();
        }

        $data['title'] .= ' ' . $data['current_review']->university_name . ' № ' . $data['current_review']->number;
        $data['cities'] = $this->cityService->findAll();

        $data['popular_universities'] = $this->universityService->popular();
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['university_reviews'] = $this->reviewService->other_university($data['current_review']->university_id);
        $data['popular_articles'] = $this->articleService->popular(); 

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.review'));
        $data['settings']['current_page'] = Config::get('pages.review');

        return view('pages.review', $data);
    }

    // page add review
    public function review_add(Request $request, $universitySlug = '')
    {
        // mode of page
        $data['settings']['mode'] = $this->mainService->_mode($request);

        $data['title'] = __('review_add_page');

        if (!$data['settings']['mode']){
            $data['university'] = $this->universityService->findBySlug($universitySlug);
            if ($data['university']){
                $data['title'] .= ' - ' . $data['university']->name;
            }
            //if (!$data['university']){ // not found
            //    return abort(404);
            //}
        }else{
            $data['university'] = $this->universityService->first();
        }

        $data['cities'] = $this->cityService->findAll(); 

        $data['last_reviews'] = $this->reviewService->last();

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.review_add'));
        $data['settings']['current_page'] = Config::get('pages.review_add');

        $data['universities'] = $this->universityService->getAll();

        return view('pages.review_add', $data);
    }

    // page articates
    public function articles(Request $request, $slug1 = '')
    {
        $page = '';
        if (SlugService::isPage($slug1)){ $page = SlugService::isPage($slug1); }

        $data['title'] = __('articles_page_title');

        $data['cities'] = $this->cityService->findAll(); 

        $data['list'] = $this->articleService->findAllFront($page);
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['last_reviews'] = $this->reviewService->last();
        $data['popular_articles'] = $this->articleService->popular(); 

        $data['today'] = $this->articleService->today(); // today date & count of articles for today

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.articles'));
        $data['settings']['current_page'] = Config::get('pages.articles');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.articles', $data);
    }

    // page article
    public function article(Request $request, $articleSlug)
    {
        $data['title'] = __('article_page_title');

        $data['current_article'] = $this->articleService->findBySlug($articleSlug);
        if (!$data['current_article']){
            return abort(404);
        }

        $data['title'] .= ' ' . $data['current_article']->title;
        
        $data['current_article']['comments'] = $this->commentService->findByArticle($data['current_article']->id);

        // view article
        $this->articleViewService->store($data['current_article']->id);

        $data['cities'] = $this->cityService->findAll();

        $data['popular_universities'] = $this->universityService->popular();
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['last_reviews'] = $this->reviewService->last();
        $data['popular_articles'] = $this->articleService->popular(); 

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.article'));
        $data['settings']['current_page'] = Config::get('pages.article');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.article', $data);
    }

    // page about
    public function about(Request $request)
    {
        $data['title'] = __('about_page_title');

        $data['cities'] = $this->cityService->findAll(); 

        $data['popular_universities'] = $this->universityService->popular();
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['last_reviews'] = $this->reviewService->last();
        $data['popular_articles'] = $this->articleService->popular(); 

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.about'));
        $data['settings']['current_page'] = Config::get('pages.about');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.about', $data);
    }

    // page educational
    public function educational(Request $request)
    {
        $data['title'] = __('educational_page_title');

        $data['cities'] = $this->cityService->findAll(); 

        $data['popular_universities'] = $this->universityService->popular();
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['last_reviews'] = $this->reviewService->last();
        $data['popular_articles'] = $this->articleService->popular(); 

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.educational'));
        $data['settings']['current_page'] = Config::get('pages.educational');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.educational', $data);
    }

    // page faq
    public function faq(Request $request)
    {
        $data['title'] = __('faq_page_title');

        $data['cities'] = $this->cityService->findAll(); 

        $data['last_reviews'] = $this->reviewService->last();

        $data['qas'] = $this->qaService->findByRel();

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.faq'));
        $data['settings']['current_page'] = Config::get('pages.faq');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.faq', $data);
    }

    // page top
    public function top(Request $request)
    {
        $data['title'] = __('top_universities_page_title');

        $data['cities'] = $this->cityService->findAll();

        $data['top_universities'] = $this->universityService->top();
        $data['popular_reviews'] = $this->reviewService->popular();
        $data['last_reviews'] = $this->reviewService->last();
        $data['popular_articles'] = $this->articleService->popular(); 

        // settings
        $data['template'] = $this->settingService->findByPage(Config::get('pages.top'));
        $data['settings']['current_page'] = Config::get('pages.top');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.top', $data);
    }

    // privacy policy
    public function policy(Request $request)
    {
        //
        $data['title'] = '';

        $data['cities'] = $this->cityService->findAll(); 

        $data['template'] = $this->settingService->findByPage(Config::get('pages.policy'));
        $data['settings']['current_page'] = Config::get('pages.policy');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.policy', $data);
    }

    // aggrement
    public function legal(Request $request)
    {
        //
        $data['title'] = '';

        $data['cities'] = $this->cityService->findAll(); 

        $data['template'] = $this->settingService->findByPage(Config::get('pages.legal'));
        $data['settings']['current_page'] = Config::get('pages.legal');
        $data['settings']['mode'] = $this->mainService->_mode($request);

        return view('pages.legal', $data);
    }

}
