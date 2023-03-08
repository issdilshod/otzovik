<?php

namespace App\Services\Admin\Account;

use App\Services\Service;
use App\Models\Admin\Account\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class UserService extends Service{

    public function findCount()
    {
        $count = User::where('status', '!=', Config::get('status.delete'))
                    ->count();
        return $count;
    }

    public function findAll($q = '', $f = '')
    {
        $users = User::where('status', '!=', Config::get('status.delete'))
                    ->when($q!='', function($qq) use ($q){
                        $qq->where(function($qq1) use($q){
                            $qq1->where('first_name', 'like', $q.'%')
                                ->orWhere('last_name', 'like', $q.'%')
                                ->orWhere('email', 'like', $q.'%')
                                ->orWhere('phone', 'like', $q.'%');
                        });
                    })
                    ->when($f!='', function($qq)use($f){
                        $qq->when($f=='created_at-desc', function($qq1){ // order by created at new
                            $qq1->orderBy('created_at', 'desc');
                        })->when($f=='created_at-asc', function($qq1){ // order by created at old
                            $qq1->orderBy('created_at', 'asc');
                        });
                    })
                    ->paginate(Config::get('pagination.per_page'));
        return $users;
    }

    public function find($id)
    {
        $user = User::where('id', $id)
                    ->where('status', '!=', Config::get('status.delete'))
                    ->first();
        if ($user!=null){
            return $user;
        }
        return false;
    }

    public function create($user)
    {
        if (isset($user['current_user_id'])){
            $user['user_id'] = $user['current_user_id'];
        }

        // password hash
        $user['password'] = Hash::make($user['password']);

        $user = User::create($user);
        return $user;
    }

    public function update($user, $id)
    {
        // check & password hash
        if ($user['password']!=''){
            $user['password'] = Hash::make($user['password']);
        }else{
            unset($user['password']);
        }

        // check avatar
        if ($user['avatar']==null){
            unset($user['avatar']);
        }

        $user = User::where('id', $id)
                    ->where('status', '!=', Config::get('status.delete'))
                    ->update($user);
        return $user;
    }

    public function store($user)
    {
        $exist = User::where('email', $user['email'])
                    ->first();
        if ($exist!=null){
            if ($exist->role==Config::get('roles.user')){
                $exist->update($user);
            }
        }else{
            $exist = User::create($user);
        }

        return $exist;
    }

    public function delete($id)
    {
        User::where('id', $id)
            ->update(['status' => Config::get('status.delete')]);
        return true;
    }

    public function exist($user, $id = '')
    {
        $user = User::where('email', $user['email'])
                    ->where('status', '!=', Config::get('status.delete'))
                    ->when($id!='', function($q) use($id){
                        $q->where('id', '!=', $id);
                    })
                    ->first();
        if ($user==null){
            return false;
        }
        return true;
    }

}