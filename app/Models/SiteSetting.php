<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#[Fillable([
    'key',
    'value',
    'type',
])]
class SiteSetting extends Model
{
    protected static function booted(): void
    {
        static::saved(function (): void {
            Cache::forget('site_settings');
        });

        static::deleted(function (): void {
            Cache::forget('site_settings');
        });
    }

    public function getTypedValueAttribute(): mixed
    {
        return match ($this->type) {
            'boolean' => filter_var(
                $this->value,
                FILTER_VALIDATE_BOOLEAN
            ),
            'integer' => (int) $this->value,
            'float' => (float) $this->value,
            'json' => json_decode($this->value, true),
            default => $this->value,
        };
    }
}