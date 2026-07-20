<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'entry_no',
        'user_type',

        'f_name',
        'l_name',

        'email',
        'phone',

        'status',

        'password',

        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    protected $appends = [
        'name',
        'name_initials',
    ];

    protected static function booted(): void
    {
        static::creating(function ($user) {
            do {
                $user->entry_no = 'USR-' . random_int(10000000, 99999999);
            } while (static::where('entry_no', $user->entry_no)->exists());
        });
    }

    public function getNameAttribute(): string
    {
        return trim("{$this->f_name} {$this->l_name}");
    }

    public function getNameInitialsAttribute(): string
    {
        return strtoupper(
            collect([$this->f_name, $this->l_name])
                ->filter()
                ->map(fn ($name) => substr($name, 0, 1))
                ->implode('')
        );
    }

    public function isSuperAdmin(): bool
    {
        return $this->user_type === 'superadmin';
    }

    public function isStaff(): bool
    {
        return $this->user_type === 'staff';
    }

    public function isBackoffice(): bool
    {
        return in_array($this->user_type, [
            'superadmin',
            'staff',
        ], true);
    }

    public function getRouteKeyName(): string
    {
        return 'entry_no';
    }
}