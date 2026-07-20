<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getResolvedValueAttribute()
    {
        return match ($this->type) {

            'boolean' => filter_var(
                $this->value,
                FILTER_VALIDATE_BOOLEAN
            ),

            'number' => is_numeric($this->value)
                ? $this->value + 0
                : 0,

            'json' => json_decode(
                $this->value,
                true
            ),

            'media' => Media::find(
                $this->value
            ),

            default => $this->value,
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public static function get(
        string $key,
        $default = null
    ) {

        $setting = self::where(
            'key',
            $key
        )->first();

        if (!$setting) {
            return $default;
        }

        return $setting->resolved_value;
    }

    public static function set(
        string $key,
        $value,
        string $type = 'string'
    ): self {

        return self::updateOrCreate(
            [
                'key' => $key,
            ],
            [
                'value' => is_array($value)
                    ? json_encode($value)
                    : $value,

                'type' => $type,
            ]
        );
    }

    public static function allSettings(): array
    {
        return static::query()
            ->get()
            ->mapWithKeys(fn (self $setting) => [
                $setting->key => $setting->resolved_value,
            ])
            ->toArray();
    }

    /*
    |--------------------------------------------------------------------------
    | Media Helper
    |--------------------------------------------------------------------------
    */

    public function media()
    {
        if ($this->type !== 'media') {
            return null;
        }

        return Media::find(
            $this->value
        );
    }
}