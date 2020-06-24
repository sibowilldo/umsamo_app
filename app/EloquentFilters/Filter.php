<?php


namespace App\EloquentFilters;


use Closure;
use Illuminate\Support\Str;

abstract class Filter
{
    public function handle($request, Closure $next)
    {
        if(! request()->has($this->filter_name())){
            return $next($request);
        }

        return $this->apply($next($request));
    }

    protected function filter_name()
    {
        return Str::snake(class_basename($this));
    }
    protected abstract function apply($builder);
}
