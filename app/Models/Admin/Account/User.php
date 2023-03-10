<?php

namespace App\Models\Admin\Account;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'password',
        'email',
        'phone',
        'avatar',
        'role',
        'status'
    ];

    protected $hidden = [
        'password'
    ];

    protected $attributes = ['status' => 1]; // 1 is active
}
