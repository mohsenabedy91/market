<?php

namespace Modules\Authorization\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Authorization\Models\Constants\PermissionConstant;
use Modules\Authorization\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (PermissionConstant::$getPermissions as $permission) {
            Permission::query()->create([
                "name" => $permission
            ]);
        }
    }
}
