<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Realisation;
use Illuminate\Auth\Access\HandlesAuthorization;

class RealisationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_realisation');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Realisation  $realisation
     * @return bool
     */
    public function view(User $user, Realisation $realisation): bool
    {
        return $user->can('view_realisation');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_realisation');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Realisation  $realisation
     * @return bool
     */
    public function update(User $user, Realisation $realisation): bool
    {
        return $user->can('update_realisation');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Realisation  $realisation
     * @return bool
     */
    public function delete(User $user, Realisation $realisation): bool
    {
        return $user->can('delete_realisation');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_realisation');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Realisation  $realisation
     * @return bool
     */
    public function forceDelete(User $user, Realisation $realisation): bool
    {
        return $user->can('force_delete_realisation');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_realisation');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Realisation  $realisation
     * @return bool
     */
    public function restore(User $user, Realisation $realisation): bool
    {
        return $user->can('restore_realisation');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_realisation');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Realisation  $realisation
     * @return bool
     */
    public function replicate(User $user, Realisation $realisation): bool
    {
        return $user->can('replicate_realisation');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_realisation');
    }

}
