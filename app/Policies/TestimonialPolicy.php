<?php

namespace App\Policies;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Autorisations Filament Shield pour les témoignages clients.
 */
class TestimonialPolicy
{
    use HandlesAuthorization;

    /**
     * @param  User  $user  Utilisateur authentifié
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_testimonial');
    }

    /**
     * @param  User  $user  Utilisateur authentifié
     * @param  Testimonial  $testimonial  Témoignage ciblé
     * @return bool
     */
    public function view(User $user, Testimonial $testimonial): bool
    {
        return $user->can('view_testimonial');
    }

    /**
     * @param  User  $user  Utilisateur authentifié
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_testimonial');
    }

    /**
     * @param  User  $user  Utilisateur authentifié
     * @param  Testimonial  $testimonial  Témoignage ciblé
     * @return bool
     */
    public function update(User $user, Testimonial $testimonial): bool
    {
        return $user->can('update_testimonial');
    }

    /**
     * @param  User  $user  Utilisateur authentifié
     * @param  Testimonial  $testimonial  Témoignage ciblé
     * @return bool
     */
    public function delete(User $user, Testimonial $testimonial): bool
    {
        return $user->can('delete_testimonial');
    }

    /**
     * @param  User  $user  Utilisateur authentifié
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_testimonial');
    }

    /**
     * @param  User  $user  Utilisateur authentifié
     * @param  Testimonial  $testimonial  Témoignage ciblé
     * @return bool
     */
    public function forceDelete(User $user, Testimonial $testimonial): bool
    {
        return $user->can('force_delete_testimonial');
    }

    /**
     * @param  User  $user  Utilisateur authentifié
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_testimonial');
    }

    /**
     * @param  User  $user  Utilisateur authentifié
     * @param  Testimonial  $testimonial  Témoignage ciblé
     * @return bool
     */
    public function restore(User $user, Testimonial $testimonial): bool
    {
        return $user->can('restore_testimonial');
    }

    /**
     * @param  User  $user  Utilisateur authentifié
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_testimonial');
    }

    /**
     * @param  User  $user  Utilisateur authentifié
     * @param  Testimonial  $testimonial  Témoignage ciblé
     * @return bool
     */
    public function replicate(User $user, Testimonial $testimonial): bool
    {
        return $user->can('replicate_testimonial');
    }

    /**
     * @param  User  $user  Utilisateur authentifié
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_testimonial');
    }
}
