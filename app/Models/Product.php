<?php

namespace App\Models;

use App\Models\Builder\ProductBuilder;
use Domains\Shared\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function newEloquentBuilder($query)
    {
        return new ProductBuilder($query);
    }

}
