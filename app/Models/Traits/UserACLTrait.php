<?php

namespace App\Models\Traits;

use App\Models\Tenant;

trait UserACLTrait
{
    public function permissions(): array
    {
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();

        $permissions = [];
        foreach ($permissionsRole as $permissionRole) {
            if (in_array($permissionRole, $permissionsPlan)) {
                array_push($permissions, $permissionRole);
            }
        }

        return $permissions;
    }

    public function permissionsPlan(): array
    {
        //$plan = $this->tenant->plan;
        $tenant = Tenant::with('plan.profiles.permissions')->where('id', $this->tenant_id)->first();
        $plan = $tenant->plan;

        $permissions = [];

        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }

    public function permissionsRole(): array
    {
        $roles = $this->roles()->with('permissions')->get();

        $permissions = [];

        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }

    public function hasPermission(string $permissonName): bool
    {
        return in_array($permissonName, $this->permissions());
    }

    public function isAdmin(): bool
    {
        return in_array($this->email, config('tenant.admins'));
    }

    public function isTenant(): bool
    {
        return in_array($this->email, config('tenant.admins'));
    }
}
