<?php

namespace App\Models\Traits;


trait UserACLTrait
{
    public function permissions()
    {
        $plan = $this->tenant->plan;

        $permissions = [];

        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
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
