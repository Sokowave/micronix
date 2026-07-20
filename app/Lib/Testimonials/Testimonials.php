<?php

namespace App\Lib\Testimonials;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Collection;

class Testimonials
{
    /**
     * Get random active testimonials.
     */
    public static function get(int $limit = 4): Collection
    {
        return Testimonial::query()
            ->active()
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }
}