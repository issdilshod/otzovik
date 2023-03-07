<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Services\Admin\Blog\ArticleService;
use App\Services\Admin\Misc\FileService;
use App\Services\Admin\Setting\SeoService;
use Illuminate\Http\Request;

class ArticleController extends Controller{

    private $articleService;
    private $fileService;
    private $seoService;

    public function __construct()
    {
        $this->articleService = new ArticleService();
        $this->fileService = new FileService();
        $this->seoService = new SeoService();
    }

    public function index(Request $request)
    {
        // permission
        $data['title'] = __('articles_title');

        // search
        $data['q'] = $request->q??'';
        
        $data['list'] = $this->articleService->findAll($data['q']);

        return view('admin.pages.blog.article.articles', $data);
    }

    public function store(Request $request)
    {
        // permission
        $validated = $this->articleService->validate($request);

        $validated['user_id'] = $validated['current_user_id'];
        unset($validated['current_user_id']);

        // logo upload
        $validated['cover'] = $this->fileService->upload($request, $validated['title'], 'cover');

        $article = $this->articleService->save($validated);
        if ($article){
            // seo
            $seo['title'] = ($request->tit??'');
            $seo['description'] = ($request->descript??'');
            $this->seoService->save($seo, $article->slug);

            return redirect('admin/blog/articles')->with('status', '200');
        }

        return redirect('admin/blog/articles')->with('status', '500'); 
    }

    public function show(Request $request, $id = '')
    {
        // permission
        $data['title'] =  __('article_add_title');

        if ($id!=''){
            $data['article'] = $this->articleService->find($id);
            $data['title'] = __('article_edit_title') . ' ' . $data['article']->title;
        }

        return view('admin.pages.blog.article.article', $data);
    }

    public function update(Request $request, $id)
    {
        // permission
        $validated = $this->articleService->validate($request);

        unset($validated['current_user_id']);

        // logo upload
        $validated['cover'] = $this->fileService->upload($request, $validated['title'], 'cover');

        $article = $this->articleService->save($validated, $id);
        if ($article){
            // seo
            $seo['title'] = ($request->tit??'');
            $seo['description'] = ($request->descript??'');
            $this->seoService->save($seo, $article->slug);

            return redirect('admin/blog/articles')->with('status', '200');
        }

        return redirect('admin/blog/articles')->with('status', '500'); 
    }

    public function destroy(Request $request, $id)
    {
        // permission
        $this->articleService->delete($id);

        return redirect('admin/blog/articles')->with('status', '200');
    }

}