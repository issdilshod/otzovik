<?php

namespace App\Services\Admin\Review;

use App\Services\Service;
use App\Models\Admin\Review\Review;
use App\Models\Admin\University\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ReviewService extends Service{

    public function findCount()
    {
        $count = Review::where('status', '!=', Config::get('status.delete'))
                    ->count();
        return $count;
    }

    public function findAll($name = '')
    {
        $reviews = Review::from('reviews as r')
                        ->select([
                            'r.*', 
                            'us.avatar as user_avatar', 'us.first_name as user_first_name', 'us.last_name as user_last_name', 
                            'un.name as university_name', 'un.logo as university_logo', 'un.slug as university_slug'])
                        ->join('users as us', 'us.id', '=', 'r.user_id')
                        ->join('universities as un', 'un.id', '=', 'r.university_id')
                        ->orderBy('r.created_at', 'desc')
                        ->where('r.status', '!=', Config::get('status.delete'))
                        ->paginate(Config::get('pagination.per_page'));
        return $reviews;
    }

    public function findById($id)
    {
        $review = Review::from('reviews as r')
                    ->select([
                        'r.*', 
                        'us.first_name as user_first_name', 'us.last_name as user_last_name', 'us.avatar as user_avatar',
                        'un.id as university_id', 'un.name as university_name', 'un.logo as university_logo', 'un.slug as university_slug'
                    ])
                    ->join('users as us', 'us.id', '=', 'r.user_id')
                    ->join('universities as un', 'un.id', '=', 'r.university_id')
                    ->where('r.status', '!=', Config::get('status.delete'))
                    ->where('r.id', $id)
                    ->first();
        if ($review!=null){
            return $review;
        }
        return false;
    }

    public function findAllFront()
    {
        $reviews = Review::from('reviews as r')
                        ->select([
                            'r.*', 
                            'us.avatar as user_avatar', 'us.first_name as user_first_name', 'us.last_name as user_last_name', 
                            'un.name as university_name', 'un.logo as university_logo', 'un.slug as university_slug'
                        ])
                        ->join('users as us', 'us.id', '=', 'r.user_id')
                        ->join('universities as un', 'un.id', '=', 'r.university_id')
                        ->orderBy('r.created_at', 'desc')
                        ->where('r.status', Config::get('status.active'))
                        ->paginate(Config::get('pagination.per_page'));
        return $reviews;
    }

    public function popular($count = 5)
    {
        $reviews = Review::from('reviews as r')
                        ->select([
                            'r.*',
                            'us.first_name as user_first_name', 'us.last_name as user_last_name',
                            'un.name as university_name', 'un.slug as university_slug'
                        ])
                        ->join('users as us', 'us.id', '=', 'r.user_id')
                        ->join('universities as un', 'un.id', '=', 'r.university_id')
                        ->where('r.status', Config::get('status.active'))
                        ->whereBetween('r.star', [3, 5]) // 3.0 - 5.0
                        ->inRandomOrder() // random order
                        ->limit($count)
                        ->get();
        return $reviews;
    }

    public function last($count = 5)
    {
        $reviews = Review::from('reviews as r')
                        ->select([
                            'r.*',
                            'us.first_name as user_first_name', 'us.last_name as user_last_name',
                            'un.name as university_name', 'un.slug as university_slug'
                        ])
                        ->join('users as us', 'us.id', '=', 'r.user_id')
                        ->join('universities as un', 'un.id', '=', 'r.university_id')
                        ->where('r.status', Config::get('status.active'))
                        ->orderBy('r.updated_at', 'desc')
                        ->limit($count)
                        ->get();
        return $reviews;
    }

    public function other_university($universityId, $count = 5)
    {
        $reviews = Review::from('reviews as r')
                        ->select([
                            'r.*',
                            'us.first_name as user_first_name', 'us.last_name as user_last_name',
                            'un.name as university_name', 'un.slug as university_slug'
                        ])
                        ->join('users as us', 'us.id', '=', 'r.user_id')
                        ->join('universities as un', 'un.id', '=', 'r.university_id')
                        ->where('r.university_id', $universityId)
                        ->where('r.status', Config::get('status.active'))
                        ->orderBy('r.updated_at', 'desc')
                        ->limit($count)
                        ->get();
        return $reviews;
    }

    public function findByNumber($reviewNumber)
    {
        $review = Review::from('reviews as r')
                    ->select([
                        'r.*',
                        'us.first_name as user_first_name', 'us.last_name as user_last_name', 'us.avatar as user_avatar',
                        'un.id as university_id', 'un.name as university_name', 'un.logo as university_logo', 'un.slug as university_slug'
                    ])
                    ->join('universities as un', 'un.id', '=', 'r.university_id')
                    ->join('users as us', 'us.id', '=', 'r.user_id')
                    ->where('r.number', $reviewNumber)
                    ->where('r.status', Config::get('status.active'))
                    ->first();
        return $review;
    }

    public function findByUniversity($universityId)
    {
        $reviews = Review::from('reviews as r')
                    ->select([
                        'r.*',
                        'us.first_name as user_first_name', 'us.last_name as user_last_name', 'us.avatar as user_avatar',
                        'un.name as university_name', 'un.logo as university_logo', 'un.slug as university_slug'
                    ])
                    ->join('universities as un', 'un.id', '=', 'r.university_id')
                    ->join('users as us', 'us.id', '=', 'r.user_id')
                    ->where('r.university_id', $universityId)
                    ->where('r.status', Config::get('status.active'))
                    ->orderBy('r.updated_at', 'desc')
                    ->paginate(Config::get('pagination.per_page'));
        return $reviews;
    }

    public function create($review)
    {
        $review = Review::create($review);

        // TODO: notification (email)

        return $review;
    }

    public function update($review, $id)
    {
        // user id
        //$review['user_id'] = $review['current_user_id']; 
        unset($review['current_user_id']);

        // UPDATE
        $review = Review::where('id', $id)
                        ->where('status', '!=', Config::get('status.delete'))
                        ->update($review);
        return $review;
    }

    public function delete($id)
    {
        Review::where('id', $id)
            ->update(['status' => Config::get('status.delete')]);
        return true;
    }

    public function validate(Request $request)
    {
        $validated = $request->validate([
            'university_id' => 'required',
            'text' => '',
            'star' => '',
            'current_user_id' => '',
            
            'status' => '',
        ]);

        // get&set number or index of university
        $university = University::where('id', $validated['university_id'])
                        ->first();

        $reviewCount = Review::where('university_id', $validated['university_id'])
                        ->get()
                        ->count();

        $validated['number'] = $university->index . ((int)$reviewCount + 1);

        // star validation
        if (isset($validated['star'])){
            if ((float)$validated['star']>5){
                $validated['star'] = 5;
            }
            if ((float)$validated['star']<0){
                $validated['star'] = 0.0;
            }
        }

        return $validated;
    }

}