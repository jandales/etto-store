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
    
}
