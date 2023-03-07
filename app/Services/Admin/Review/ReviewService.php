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

    public function findAllFront($page = '', $filter = '', $direction = '')
    {
        $reviews = Review::from('reviews as r')
                        ->select([
                            'r.*', 
                            'us.avatar as user_avatar', 'us.first_name as user_first_name', 'us.last_name as user_last_name', 
                            'un.name as university_name', 'un.logo as university_logo', 'un.slug as university_slug'
                        ])
                        ->join('users as us', 'us.id', '=', 'r.user_id')
                        ->join('universities as un', 'un.id', '=', 'r.university_id')
                        ->where('r.status', Config::get('status.active'))
                        ->when($direction!='', function ($q) use($direction){
                            $q->join('university_directions as ud', 'ud.university_id', '=', 'un.id')
                                ->where('ud.direction_id', $direction);
                        })
                        ->when($filter!='', function($q) use($filter){ // specific filter
                            if ($filter=='po_reytingu_pol'){ // filter by rate plus
                                $q->orderBy('r.star', 'desc');
                            }else if ($filter=='po_reytingu_neg'){ // filter by rate minus
                                $q->orderBy('r.star', 'asc');
                            }else if ($filter=='svejie'){ // filter by new
                                $q->orderBy('r.updated_at', 'desc');
                            }else if ($filter=='starie'){ // filter by old
                                $q->orderBy('r.updated_at', 'asc');
                            }
                        })
                        ->when($filter=='', function($q) { // default filter by star
                            $q->orderBy('r.star', 'desc');
                        })
                        ->paginate(Config::get('pagination.per_page'), [], '', $page);
        return $reviews;
    }

    public function first()
    {
        $review = Review::from('reviews as r')
                    ->select([
                        'r.*',
                        'us.first_name as user_first_name', 'us.last_name as user_last_name', 'us.avatar as user_avatar',
                        'un.id as university_id', 'un.name as university_name', 'un.logo as university_logo', 'un.slug as university_slug'
                    ])
                    ->join('universities as un', 'un.id', '=', 'r.university_id')
                    ->join('users as us', 'us.id', '=', 'r.user_id')
                    ->first();
        return $review;
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
        if ($review==null){
            return false;
        }
        return $review;
    }

    public function findByUniversity($universityId, $page = '')
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
                    ->paginate(Config::get('pagination.per_page'), [], '', $page);
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

    public function staticticByUniversity($universityId)
    {
        $all = Review::where('status', Config::get('status.active'))
                    ->where('university_id', $universityId)
                    ->count();
                
        $one = Review::where('status', Config::get('status.active'))
                    ->where('university_id', $universityId)
                    ->whereBetween('star', [0, 1.5])
                    ->count();

        $two = Review::where('status', Config::get('status.active'))
                    ->where('university_id', $universityId)
                    ->whereBetween('star', [1.6, 2.5])
                    ->count();

        $three = Review::where('status', Config::get('status.active'))
                    ->where('university_id', $universityId)
                    ->whereBetween('star', [2.6, 3.5])
                    ->count();

        $four = Review::where('status', Config::get('status.active'))
                    ->where('university_id', $universityId)
                    ->whereBetween('star', [3.7, 4.5])
                    ->count();

        $five = Review::where('status', Config::get('status.active'))
                    ->where('university_id', $universityId)
                    ->whereBetween('star', [4.6, 5])
                    ->count();
        return [
            'one' => round(($one==0?0:($one*100)/$all)),
            'two' => round(($two==0?0:($two*100)/$all)),
            'three' => round(($three==0?0:($three*100)/$all)),
            'four' => round(($four==0?0:($four*100)/$all)),
            'five' => round(($five==0?0:($five*100)/$all)),
        ];
    }

}