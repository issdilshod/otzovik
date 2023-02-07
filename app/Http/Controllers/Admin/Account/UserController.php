<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Account\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{

    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }
    
    public function index(Request $request)
    {
        // permission
        $data['title'] = __('staff_title');

        $data['list'] = $this->userService->findAll();
        $data['roles'] = Config::get('roles');

        return view('admin.pages.user.users', $data);
    }

    public function store(Request $request)
    {
        // permission

        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => '',
            'password' => 'required',
            'email' => 'required',
            'phone' => '',
            'role' => 'required',

            'current_user_id' => '',
        ]);

        // check
        if ($this->userService->exist($validated)){
            $data['roles'] = Config::get('roles');
            $data['user'] = (object)$validated;
            return view('admin.pages.user.user', $data)->with('code', '409');
        }

        $this->userService->create($validated);

        return redirect('admin/users')->with('msg', 'success');
    }

    public function get(Request $request, $id = '')
    {
        // permission
        $data['title'] = __('staff_add_title');

        if ($id!=''){
            $data['user'] = $this->userService->find($id);
            $data['title'] = __('staff_edit_title') . ' ' . $data['user']->first_name . ' ' . $data['user']->last_name;
        }

        $data['roles'] = Config::get('roles');

        return view('admin.pages.user.user', $data);
    }

    public function update(Request $request, $id)
    {
        // permission
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => '',
            'password' => '',
            'email' => 'required',
            'phone' => '',
            'role' => ''
        ]);

        // check
        if ($this->userService->exist($validated, $id)){
            return redirect('admin/user/'.$id)->with('code', '409');
        }

        $this->userService->update($validated, $id);

        return redirect('admin/users')->with('msg', 'success');
    }

    public function destroy(Request $request, $id)
    {
        // permission
        $this->userService->delete($id);

        return redirect('admin/users')->with('msg', 'success');
    }

}
