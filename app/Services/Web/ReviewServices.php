<?php

namespace App\Services\Web;

use App\Models\Review;
use App\Exceptions\ReviewNotFoundException;


class ReviewServices
{
    private $rate = 1;
    private $body;
    private $user_id;
    private $product_id;
    private $review;    
    
    public function get($product_id, $user_id)
    {
        $this->review  = Review::query()
            ->where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();

        if (!$this->review) {
            throw new ReviewNotFoundException("review not found", 422);
        }

        return $this->review;
    }

    public function write($product_id, $user_id, $rate, $body)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->rate = $rate;
        $this->body = $body;

        try {
           Self::get($this->product_id, $this->user_id);
           return Self::update();
        } catch (ReviewNotFoundException $e) {
           return Self::store();   
        }

    }

    private function store() {

        return Review::create([
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'body' => $this->body,
            'rate' => $this->rate,
        ]); 

    }

    private function update()
    {
        $this->review->rate = $this->rate;
        $this->review->body = $this->body;
        $this->review->save();
        return $this->review;
    }

    public function getProductRatings($id)
    {
       $total_review =  Review::where('product_id', $id)->get()->count();

       $ratings = Review::where('product_id', $id)
            ->selectRaw('count(*) as total, rate')
            ->orderBy('rate', 'desc')
            ->groupBy('rate')
            ->get();

        $new_ratings = Self::setRating($ratings, $total_review);

        $average = self::getAverage($ratings, $total_review);
       

        return [
            'average' => $average,
            'total_reviews' =>  $total_review,
            'ratings' => $new_ratings,
        ];

       
    }

    private function setRating($ratings, int $total_review)
    {
        $average = 0;

        $new_ratings =  $ratings->map(function ($item) use ($total_review, $average) { 
            $average = ($item->total / $total_review)  * 100;
            $rating = [
                'rate' => $item->rate,
                'average' => ceil($average) . '%',
            ];
            return $rating;
        });

        $rates = [5,4,3,2,1];
        
        foreach ($rates as $rate) {
            $result = $new_ratings->contains(function ($item) use ($rate) {            
                return $item['rate'] == $rate;  
            });
            if ($result === false) {
                $new_ratings->push([
                    'rate' => $rate,
                    'average' =>  '0%'
                ]);    
            }
        }

        return $new_ratings;
        
    }

    private function getAverage($ratings, int $total_review)
    {
        $average = 0;
        
        foreach ($ratings as $item) {

            $average += $item->total * $item->rate;

        }

        $average /=  $total_review;

        $average  = floor($average);  

        return $average;
    }





 
    
}
