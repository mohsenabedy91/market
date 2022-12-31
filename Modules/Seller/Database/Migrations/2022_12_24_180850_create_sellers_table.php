<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create("sellers", static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("email");
            $table->string("phone_number");
            $table->string("company_name");
            $table->boolean("is_active");
            $table->text("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists("sellers");
    }
};
