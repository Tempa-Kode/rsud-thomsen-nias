<?php

namespace App\Policies;

use App\Models\RawatJalan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RawatJalanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->role == 'pasien'
            ? Response::allow()
            : Response::deny('anda tidak memiliki akses untuk melihat data rawat jalan.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RawatJalan $rawatJalan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role == 'pasien'
            ? Response::allow()
            : Response::deny('anda tidak memiliki akses untuk membuat data rawat jalan.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RawatJalan $rawatJalan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RawatJalan $rawatJalan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RawatJalan $rawatJalan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RawatJalan $rawatJalan): bool
    {
        return false;
    }
}
