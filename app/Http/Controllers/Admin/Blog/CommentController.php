<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Services\Admin\Account\UserService;
use App\Services\Admin\Blog\CommentLikeService;
use App\Services\Admin\Blog\CommentService;
use App\Services\Admin\Misc\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class CommentController extends Controller
{

    private $commentService;
    private $fileService;
    private $userService;
    private $commentLikeService;

    public function __construct()
    {
        $this->commentService = new CommentService();
        $this->fileService = new FileService();
        $this->userService = new UserService();
        $this->commentLikeService = new CommentLikeService();
    }

    public function index(Request $request)
    {
        $data['title'] = __('comments_title');

        // search
        $data['q'] = $request->q??'';

        $data['f'] = $request->f??'created_at-desc';

        $data['list'] = $this->commentService->findAll($data['q'], $data['f']);

        $data['status'] = Config::get('status');

        return view('admin.pages.blog.comment.comments', $data);
    }

    /**
     * Not active
     * 
     */
    public function store(Request $request)
    {
        // permission
        //$validated = $this->commentService->validate($request);

        //$validated['user_id'] = $validated['current_user_id'];
        //unset($validated['current_user_id']);

        //if ($this->commentService->create($validated)){
        //    return redirect('admin/blog/comments')->with('status', '201');
        //}

        //return redirect('admin/blog/comments')->with('status', '500'); 
    }

    public function show(Request $request, $id = '')
    {
        // permission
        $data['title'] = __('comment_add_title');

        if ($id!=''){
            $data['comment'] = $this->commentService->findById($id);
            $data['title'] = __('comment_edit_title') . ' ';
        }

        return view('admin.pages.blog.comment.comment', $data);
    }

    public function update(Request $request, $id)
    {
        // permission
        $validated = $this->commentService->validate($request);

        if ($this->commentService->save($validated, $id)){
            return redirect('admin/blog/comments')->with('status', '200');
        }

        return redirect('admin/blog/comments')->with('status', '500'); 
    }

    public function destroy(Request $request, $id)
    {
        // permission
        $this->commentService->delete($id);

        return redirect('admin/blog/comments')->with('status', '200');
    }
    
    public function api_store(Request $request)
    {
        //
        $comment = $this->commentService->validate($request);

        // create user

        $user = [
            'first_name' => $request->has('first_name')?$request->input('first_name'):'',
            'last_name' => $request->has('last_name')?$request->input('last_name'):'',
            'email' => $request->has('email')?$request->input('email'):'',
            'role' => Config::get('roles.user'),
            'status' => Config::get('status.wait')
        ];

        // avatar
        if ($request->hasFile('avatar')){
            $user['avatar'] = $this->fileService->upload($request, $user['first_name'] . ' ' . $user['last_name'], 'avatar');
        }

        $user = $this->userService->store($user);

        // create review
        $comment['user_id'] = $user->id;
        $comment['status'] = Config::get('status.wait');

        $this->commentService->save($comment);

        return response()->json(['msg' => 'success'], 200);
    }

    public function api_like(Request $request)
    {
        $commentLike = $this->commentLikeService->validate($request);

        $commentLikeCount = $this->commentLikeService->save($commentLike);

        return response()->json(['msg' => 'success', 'comment_like' => $commentLikeCount], 200);
    }

}
