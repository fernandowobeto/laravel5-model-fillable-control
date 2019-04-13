<?php

namespace ModelFillableControl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ModelFillableDataControl
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
        return isset($this->fillable[$attribute]);
    }

}