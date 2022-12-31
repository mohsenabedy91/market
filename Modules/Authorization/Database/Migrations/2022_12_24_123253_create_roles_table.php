<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the Migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create("roles", static function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the Migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists("roles");
    }
};
