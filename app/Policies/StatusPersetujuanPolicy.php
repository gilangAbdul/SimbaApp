<?php

namespace App\Policies;

use App\Models\StatusPersetujuan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StatusPersetujuanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, StatusPersetujuan $statusPersetujuan): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StatusPersetujuan $statusPersetujuan): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, StatusPersetujuan $statusPersetujuan): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, StatusPersetujuan $statusPersetujuan): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, StatusPersetujuan $statusPersetujuan): bool
    {
        //
    }
}
