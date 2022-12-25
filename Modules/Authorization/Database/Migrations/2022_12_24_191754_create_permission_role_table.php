<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Authorization\Models\Permission;
use Modules\Authorization\Models\Role;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create("permission_role", static function (Blueprint $table) {
            $table->foreignIdFor(Permission::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Role::class)->constrained()->cascadeOnDelete();

            $table->primary(["permission_id", "role_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists("permission_role");
    }
};