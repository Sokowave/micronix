<?php

namespace App\Traits;

trait HasRatingScore
{
    protected function ratingValue(): float
    {
        return (float) (
            $this->averageRating ??
            $this->rating ??
            0
        );
    }

    public function getRatingColorAttribute(): string
    {
        return match (true) {

            $this->ratingValue() >= 4.8 => 'text-green-500',

            $this->ratingValue() >= 4.0 => 'text-lime-500',

            $this->ratingValue() >= 3.0 => 'text-yellow-400',

            $this->ratingValue() >= 2.0 => 'text-brand-400',

            default => 'text-red-500',
        };
    }

    public function getRatingBgColorAttribute(): string
    {
        return match (true) {

            $this->ratingValue() >= 4.8 => 'bg-green-500',

            $this->ratingValue() >= 4.0 => 'bg-lime-500',

            $this->ratingValue() >= 3.0 => 'bg-yellow-400',

            $this->ratingValue() >= 2.0 => 'bg-brand-400',

            default => 'bg-red-500',
        };
    }

    public function getRatingLabelAttribute(): string
    {
        return match (true) {

            $this->ratingValue() >= 4.8 => 'Excellent',

            $this->ratingValue() >= 4.0 => 'Very Good',

            $this->ratingValue() >= 3.0 => 'Good',

            $this->ratingValue() >= 2.0 => 'Average',

            default => 'Poor',
        };
    }
}