<?php

namespace Modules\Authorization\Services\Roles\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Modules\Authorization\Models\Role;

trait HasRoles
{
    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param ...$roles
     * @return $this
     */
    public function giveRolesTo(...$roles): static
    {
        $roles = $this->getAllRoles($roles);
        if ($roles->isEmpty()) {
            return $this;
        }

        $this->roles()->syncWithoutDetaching($roles);

        return $this;
    }

    /**
     * @param ...$roles
     * @return $this
     */
    public function withdrawRoles(...$roles): static
    {
        $roles = $this->getAllRoles($roles);
        $this->roles()->detach($roles);

        return $this;
    }

    /**
     * @param ...$roles
     * @return $this
     */
    public function refreshRoles(...$roles): static
    {
        $roles = $this->getAllRoles($roles);

        $this->roles()->sync($roles);

        return $this;
    }

    /**
     * @param array $roles
     * @return Collection
     */
    private function getAllRoles(array $roles): Collection
    {
        return Role::query()->whereIn("name", Arr::flatten($roles))->get();
    }

    /**
     * @param ...$roles
     * @return bool
     */
    public function hasRoles(...$roles): bool
    {
        foreach (Arr::flatten($roles) as $role) {
            if (!$this->roles->contains("name", $role)) {
                continue;
            }
            return $this->roles->contains("name", $role);
        }

        return false;
    }
}
