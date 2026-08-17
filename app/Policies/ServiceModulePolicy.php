<?php

namespace App\Policies;

use App\Models\ServiceModule;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Autorisations Filament pour les modules de services.
 */
class ServiceModulePolicy
{
    use HandlesAuthorization;

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_service_module');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServiceModule  $serviceModule  Module ciblé
     */
    public function view(User $user, ServiceModule $serviceModule): bool
    {
        return $user->can('view_service_module');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function create(User $user): bool
    {
        return $user->can('create_service_module');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServiceModule  $serviceModule  Module ciblé
     */
    public function update(User $user, ServiceModule $serviceModule): bool
    {
        return $user->can('update_service_module');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServiceModule  $serviceModule  Module ciblé
     */
    public function delete(User $user, ServiceModule $serviceModule): bool
    {
        return $user->can('delete_service_module');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_service_module');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServiceModule  $serviceModule  Module ciblé
     */
    public function forceDelete(User $user, ServiceModule $serviceModule): bool
    {
        return $user->can('force_delete_service_module');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_service_module');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServiceModule  $serviceModule  Module ciblé
     */
    public function restore(User $user, ServiceModule $serviceModule): bool
    {
        return $user->can('restore_service_module');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_service_module');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     * @param  ServiceModule  $serviceModule  Module ciblé
     */
    public function replicate(User $user, ServiceModule $serviceModule): bool
    {
        return $user->can('replicate_service_module');
    }

    /**
     * @param  User  $user  Utilisateur connecté
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_service_module');
    }
}
