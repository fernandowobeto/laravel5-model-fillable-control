<?php

namespace FernandoWobeto\ModelFillableControl;

use Illuminate\Database\Eloquent\Model as LaravelModel;
use Illuminate\Support\Arr;

class Model extends LaravelModel
{

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        return parent::__construct(Arr::only($attributes, $this->fillable));
    }

    public function __set($key, $value)
    {
        if ($this->hasFillableAttribute($key)) {
            return parent::__set($key, $value);
        }
    }

    private function hasFillableAttribute(string $attribute): bool
    {
        return array_search($attribute, $this->fillable);
    }

}