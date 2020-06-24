<?php


namespace App\EloquentFilters\EventDate;


use App\EloquentFilters\Filter;

class HasLimit extends Filter
{

    protected function apply($builder)
    {
        return $builder->where('limit', '>', 0);
    }
}
