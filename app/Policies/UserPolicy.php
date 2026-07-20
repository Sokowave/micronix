<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any users.
     */
    public function viewAny(User $user): bool
    {
        return $user->isBackoffice();
    }

    /**
     * Determine whether the user can view the user.
     */
    public function view(User $user, User $model): bool
    {
        return $user->isBackoffice();
    }

    /**
     * Determine whether the user can create users.
     */
    public function create(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can update the user.
     */
    public function update(User $user, User $model): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->is($model);
    }

    /**
     * Determine whether the user can delete the user.
     */
    public function delete(User $user, User $model): bool
    {
        if (! $user->isSuperAdmin()) {
            return false;
        }

        return $user->isNot($model);
    }

    /**
     * Determine whether the user can restore the user.
     */
    public function restore(User $user, User $model): bool
    {
        return $this->delete($user, $model);
    }

    /**
     * Determine whether the user can permanently delete the user.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $this->delete($user, $model);
    }
}