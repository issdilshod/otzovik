<?php

namespace App\Models\Admin\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rel',
        'question',
        'answer',
        'status'
    ];

    protected $attributes = ['status' => 1]; // 1 is active
}
