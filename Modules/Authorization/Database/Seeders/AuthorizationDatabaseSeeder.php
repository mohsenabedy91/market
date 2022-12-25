<?php

namespace Modules\Authorization\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Authorization\Models\Constants\RoleConstant;
use Modules\Authorization\Models\Permission;
use Modules\Authorization\Models\Role;

class AuthorizationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);

        /** @var Role $adminRole */
        $adminRole = Role::query()->where("name", RoleConstant::DEVELOPER)->first();
        $adminRole->givePermissionsTo(Permission::query()->pluck("name"));
    }
}
