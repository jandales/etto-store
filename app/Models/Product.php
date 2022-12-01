<?php

namespace App\Models;

use Domains\Shared\Concerns\HasUuid;
use App\Models\Builder\ProductBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category_id',
        'slug',
        'short_description',
        'imagePath',
        'long_description',
        'sku',
        'barcode',
        'tags',
        'sale_price',
        'regular_price',
        'status',
        'is_taxable',
        'featured',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];

    public function category()
    {
        return $this->belongsTo(
            related: Category::class,
            foreignKey: 'category_id'
        );
    }

    public function stock()
    {
        return $this->hasOne(
            related: Stock::class,
            foreignKey: 'product_id'
        );
    }

    public function images()
    {
        return $this->hasMany(
            related: ProductImage::class,
            foreignKey: 'product_id',
        );
    }

    public function reviews()
    {
        return $this->hasMany(
            related: Review::class,
            foreignKey: 'product_id',
        );
    }

    public function comments()
    {
        return $this->morphMany(
            related: Comment::class,
            name: 'commentable'
        );
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function newEloquentBuilder($query)
    {
        return new ProductBuilder($query);
    }

    public function scopeCreateReview($query)
    {
        $query->each(function($item) {
            $item->reviews()->create([
                'comment' => 'my first Comment',
                'rate' => rand(1,5),
                'product_id' => $item->id,
                'user_id' => auth()->user()->id ?? 1,
            ]);
        });
    }


    public function totalReviews()
    {
        return $this->reviews->count();
    }

    public function ratings()
    {
        
        $this->reviews
            ->selectRaw('count(*) as total, rate')
            ->orderBy('rate', 'desc')
            ->groupBy('rate')
            ->get();  
       
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('slug', 'like', '%' . $keyword . '%');

    }
 

}
