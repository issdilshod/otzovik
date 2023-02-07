<?php

namespace App\Http\Services\Admin\Review;

use App\Http\Services\Service;
use App\Models\Admin\Review\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ReviewService extends Service{

    public function findAll($name = '')
    {
        $reviews = Review::from('reviews as r')
                        ->select(['r.*', 'us.first_name as user_first_name', 'us.last_name as user_last_name', 'un.name as university_name'])
                        ->join('users as us', 'us.id', '=', 'r.user_id')
                        ->join('universities as un', 'un.id', '=', 'r.university_id')
                        ->orderBy('r.created_at', 'desc')
                        ->where('r.status', '!=', Config::get('status.delete'))
                        ->paginate(Config::get('pagination.per_page'));
        return $reviews;
    }

    public function findById($id)
    {
        $review = Review::where('status', '!=', Config::get('status.delete'))
                    ->where('id', $id)
                    ->first();
        if ($review!=null){
            return $review;
        }
        return false;
    }

    public function create($review)
    {
        $review = Review::create($review);

        // TODO: notification (email)

        return $review;
    }

    public function update($review, $id)
    {
        //
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
            'university_id' => '',
            'text' => '',
            'star' => '',
        ]);

        return $validated;
    }

}