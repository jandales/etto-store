<?php

namespace App\Models;

use Domains\Shared\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuid;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'active',
    ];

    protected $cast = [
        'active' => 'boolean',
    ];

    public function products(){

        return $this->hasMany(
            related:Product::class,
            foreignKey: 'category_id'
        );
        
    }
}
