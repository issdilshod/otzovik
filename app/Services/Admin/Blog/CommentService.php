<?php

namespace App\Services\Admin\Blog;

use App\Models\Admin\Blog\Comment;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class CommentService extends Service{

    public function findAll($q = '', $f = '')
    {
        $comments = Comment::
                        from('comments as c')
                        ->select([
                            'c.*',
                            'u.first_name as user_first_name', 'u.last_name as user_last_name', 'u.avatar as user_avatar',
                            'a.title as article_title', 'a.slug as article_slug'
                        ])
                        ->join('articles as a', 'a.id', '=', 'c.article_id')
                        ->join('users as u', 'u.id', '=', 'c.user_id')
                        ->where('c.status', '!=', Config::get('status.delete'))
                        ->when($q!='', function ($qq) use($q){
                            $qq->where(function($qq1) use($q){
                                $qq1->where('u.first_name', 'like', $q.'%')
                                    ->orWhere('a.title', 'like', $q.'%');
                            });
                        })
                        ->when($f!='', function($qq)use($f){
                            $qq->when($f=='user-asc', function($qq1){ // user - asc
                                $qq1->orderBy('u.first_name', 'asc');
                            })->when($f=='user-asc', function($qq1){ // user - desc
                                $qq1->orderBy('u.first_name', 'desc');
                            })->when($f=='article-asc', function($qq1){ // article - asc
                                $qq1->orderBy('a.title', 'asc');
                            })->when($f=='article-desc', function($qq1){ // article - desc
                                $qq1->orderBy('a.title', 'desc');
                            })->when($f=='created_at-asc', function($qq1){ // created_at - asc
                                $qq1->orderBy('c.created_at', 'asc');
                            })->when($f=='created_at-desc', function($qq1){ // created_at - desc
                                $qq1->orderBy('c.created_at', 'desc');
                            })->when($f=='status-'.Config::get('status.active'), function($qq1){ // active
                                $qq1->orderByRaw("c.status = ".Config::get('status.active')." desc, status");
                            })->when($f=='status-'.Config::get('status.wait'), function($qq1){ // wait
                                $qq1->orderByRaw("c.status = ".Config::get('status.wait')." desc, status");
                            })->when($f=='status-'.Config::get('status.block'), function($qq1){ // block
                                $qq1->orderByRaw("c.status = ".Config::get('status.block')." desc, status");
                            });
                        })
                        ->paginate(Config::get('pagination.per_page'));
        return $comments;
    }

    public function findById($id)
    {
        $comment = Comment::
                    from('comments as c')
                    ->select([
                        'c.*', 
                        'u.first_name as user_first_name', 'u.last_name as user_last_name', 'u.avatar as user_avatar',
                        'u2.first_name as replay_user_first_name', 'u2.last_name as replay_user_last_name',
                        'a.title as article_title', 'a.slug as article_slug'
                    ])
                    ->join('articles as a', 'a.id', '=', 'c.article_id')
                    ->join('users as u', 'u.id', '=', 'c.user_id')
                    ->leftJoin('comments as c2', 'c2.id', '=', 'c.replay_id')
                    ->leftJoin('users as u2', 'u2.id', '=', 'c2.user_id')
                    ->where('c.status', '!=', Config::get('status.delete'))
                    ->where('c.id', $id)
                    ->first();
        if ($comment!=null){
            return $comment;
        }
        return false;
    }

    public function findByArticle($articleId) 
    {
        $comments = Comment::from('comments')
                    ->select([
                        'comments.*', 
                        'u.first_name as user_first_name', 'u.last_name as user_last_name', 'u.avatar as user_avatar',
                        'u2.first_name as replay_user_first_name', 'u2.last_name as replay_user_last_name'
                    ])
                    ->withCount(['likes', 'dislikes'])
                    ->join('articles as a', 'a.id', '=', 'comments.article_id')
                    ->join('users as u', 'u.id', '=', 'comments.user_id')
                    ->leftJoin('comments as c2', 'c2.id', '=', 'comments.replay_id')
                    ->leftJoin('users as u2', 'u2.id', '=', 'c2.user_id')
                    ->where('comments.article_id', $articleId)
                    ->where('comments.status', Config::get('status.active'))
                    ->orderBy('comments.updated_at', 'desc')
                    ->limit(Config::get('pagination.per_page'))
                    ->get(); 
        return $comments;
    }

    public function save($comment, $id = '')
    {
        if ($id == ''){ // create
            $comment = Comment::create($comment);
            // TODO: notify
        }else{ // update
            $comment = Comment::where('id', $id)
                            ->where('status', '!=', Config::get('status.delete'))
                            ->update($comment);
        }

        return $comment;
    }

    public function update_status($comment, $id)
    {
        Comment::where('id', $id)
            ->update($comment);
        return true;
    }

    public function delete($id)
    {
        Comment::where('id', $id)
            ->update(['status' => Config::get('status.delete')]);
        return true;
    }

    public function validate(Request $request)
    {
        $validated = $request->validate([
            'article_id' => 'required',
            'text' => 'required',
            'star' => 'required',
            'replay_id' => '',

            'status' => ''
        ]);

        // TODO: calculate number

        return $validated;
    }

}