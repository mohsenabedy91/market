<?php

namespace Modules\Authorization\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Authorization\Models\Constants\RoleConstant;
use Modules\Authorization\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (RoleConstant::$getRoles as $role) {
            Role::query()->create([
                "name" => $role
            ]);
        }
    }
}
