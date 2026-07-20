<?php

namespace App\Services\ProductListing\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchFilter
{
    public function apply(Builder $query, Request $request): void
    {
        $query->search(
            trim($request->input('q'))
        );
    }
}