<?php

namespace Domains\Shared\Concerns;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait HasNumber
{
    public static function bootHasNumber()
    {
        static::creating(function (Model $model) {        
            $model->number = now()->timestamp . rand();
        });
    }
}
