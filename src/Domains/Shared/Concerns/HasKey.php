<?php

namespace Domains\Shared\Concerns;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait HasKey
{
    public static function bootHasKey()
    {
        static::creating(function (Model $model) {
            $model->key = Str::uuid()->toString();
        });
    }
}
