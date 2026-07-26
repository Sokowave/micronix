<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'media_id',
    'title',
    'subtitle',
    'button_text',
    'url',
    'location',
    'position',
    'is_active',
])]
class Banner extends Model
{
    use HasUuids;

    /**
     * The columns that should receive unique UUIDs.
     */
    public function uniqueIds(): array
    {
        return ['public_id'];
    }
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    protected function casts(): array
    {
        return [
            'position' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}