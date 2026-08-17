<?php

namespace App\Policies;

use App\Models\ServicePillar;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Autorisations Filament pour les piliers de services.
 */
class ServicePillarPolicy
{
    use HandlesAuthorization;

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_service_pillar');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServicePillar  $servicePillar  Pilier ciblé
     */
    public function view(User $user, ServicePillar $servicePillar): bool
    {
        return $user->can('view_service_pillar');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function create(User $user): bool
    {
        return $user->can('create_service_pillar');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServicePillar  $servicePillar  Pilier ciblé
     */
    public function update(User $user, ServicePillar $servicePillar): bool
    {
        return $user->can('update_service_pillar');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServicePillar  $servicePillar  Pilier ciblé
     */
    public function delete(User $user, ServicePillar $servicePillar): bool
    {
        return $user->can('delete_service_pillar');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_service_pillar');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServicePillar  $servicePillar  Pilier ciblé
     */
    public function forceDelete(User $user, ServicePillar $servicePillar): bool
    {
        return $user->can('force_delete_service_pillar');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_service_pillar');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServicePillar  $servicePillar  Pilier ciblé
     */
    public function restore(User $user, ServicePillar $servicePillar): bool
    {
        return $user->can('restore_service_pillar');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_service_pillar');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServicePillar  $servicePillar  Pilier ciblé
     */
    public function replicate(User $user, ServicePillar $servicePillar): bool
    {
        return $user->can('replicate_service_pillar');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_service_pillar');
    }
}
