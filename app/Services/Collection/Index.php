<?php

namespace App\Services\Collection;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Index
{
    /**
     * Get all active collections.
     */
    public function get(): EloquentCollection
    {
        return Collection::query()
            ->with('media')
            ->where('is_active', true)
            ->orderBy('position')
            ->orderBy('name')
            ->get();
    }
}