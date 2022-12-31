<?php

namespace Modules\Authorization\Services\V1\Permissions\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Modules\Authorization\Models\Permission;

trait HasPermissions
{
    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @param ...$permissions
     * @return $this
     */
    public function givePermissionsTo(...$permissions): static
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions->isEmpty()) {
            return $this;
        }

        $this->permissions()->syncWithoutDetaching($permissions);

        return $this;
    }

    /**
     * @param ...$permissions
     * @return $this
     */
    public function withdrawPermissions(...$permissions): static
    {
        $permissions = $this->getAllPermissions($permissions);

        $this->permissions()->detach($permissions);

        return $this;
    }

    /**
     * @param ...$permissions
     * @return $this
     */
    public function refreshPermissions(...$permissions): static
    {
        $permissions = $this->getAllPermissions($permissions);

        $this->permissions()->sync($permissions);

        return $this;
    }

    /**
     * @param array $permissions
     * @return Collection
     */
    public function getAllPermissions(array $permissions): Collection
    {
        return Permission::query()->whereIn("name", Arr::flatten($permissions))->get();
    }

    /**
     * @param Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission): bool
    {
        return
            $this->hasPermissionsThroughRole($permission) ||
            $this->permissions->contains($permission);
    }

    /**
     * @param Permission $permission
     * @return bool
     */
    protected function hasPermissionsThroughRole(Permission $permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }

        return false;
    }
}
