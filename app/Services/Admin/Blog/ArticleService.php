<?php

namespace App\Services\Admin\Blog;

use App\Models\Admin\Blog\Article;
use App\Models\Admin\Setting\Seo;
use App\Services\Admin\Misc\StringService;
use App\Services\Admin\Misc\SystemService;
use App\Services\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ArticleService extends Service{

    public function findCount()
    {
        $count = Article::where('status', '!=', Config::get('status.delete'))
                    ->count();
        return $count;
    }

    public function findAll($q = '')
    {
        $articles = Article::where('status', '!=', Config::get('status.delete'))
                        ->orderBy('updated_at', 'desc')
                        ->when($q!='', function($qq) use($q){
                            $qq->where(function($qq1) use($q){
                                $qq1->where('title', 'like', $q.'%');
                            });
                        })
                        ->paginate(Config::get('pagination.per_page'));
        return $articles;
    }

    public function find($id)
    {
        $article = Article::where('status', '!=', Config::get('status.delete'))
                        ->where('id', $id)
                        ->first();

        // seo
        $article->seo = Seo::where('url', $article->slug)
                            ->first();
        return $article;
    }

    public function findAllFront($page = '')
    {
        $articles = Article::orderBy('updated_at', 'desc')
                            ->where('status', Config::get('status.active'))
                            ->paginate(Config::get('pagination.per_page'), ['*'], '', $page);
        return $articles;
    }

    public function findBySlug($slug)
    {
        $article = Article::from('articles as a')
                        ->select([
                            'a.*',
                            'us.id as user_id', 'us.first_name as user_first_name', 'us.last_name as user_last_name'
                        ])
                        ->join('users as us', 'us.id', '=', 'a.user_id')
                        ->where('a.status', Config::get('status.active'))
                        ->where('a.slug', $slug)
                        ->first();
        if ($article==null){
            return false;
        }

        return $article;
    }

    public function popular($count = 3)
    {
        $articles = Article::withCount('views')
                        ->orderBy('views_count', 'desc')
                        ->where('status', Config::get('status.active'))
                        ->limit($count)
                        ->get();
        return $articles;
    }

    public function last($count = 3)
    {
        $articles = Article::orderBy('updated_at', 'desc')
                        ->where('status', Config::get('status.active'))
                        ->limit($count)
                        ->get();
        return $articles;
    }

    public function save($article, $id = '')
    {
        // slug
        if ($article['slug']==''){
            $article['slug'] = StringService::slug($article['title']);
        }

        // cover
        if ($article['cover']==null){
            unset($article['cover']);
        }

        if ($id == ''){ // add
            $article = Article::create($article);
        }else{ // update
            $articleOrg = Article::where('id', $id)
                            ->first();
            $articleOrg->update($article);
            $article = $articleOrg;
        }

        return $article;
    }

    public function delete($id)
    {
        Article::where('id', $id)
            ->update(['status' => Config::get('status.delete')]);
        return true;
    }

    public function validate(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'text' => 'required',
            'slug' => '',
            'current_user_id' => '',
        ]);

        return $validated;
    }

    public function today()
    {
        $today['date'] = SystemService::get_date_for_blog(Carbon::now());
        $today['articles_count'] = Article::where('status', Config::get('status.active'))
                                        ->whereDate('updated_at', Carbon::today())
                                        ->count();
        return $today;
    }
    
}