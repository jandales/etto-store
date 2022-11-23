<?php

namespace App\Models\Builder;


use Illuminate\Database\Eloquent\Builder;

class ProductBuilder extends Builder
{
    public function scopeFeatured()
    {
        return $this->where('featured', 1);
    }
}
