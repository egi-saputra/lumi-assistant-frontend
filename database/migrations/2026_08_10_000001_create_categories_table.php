<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number')->nullable();
            $table->string('name');
            $table->boolean('is_system')->default(false);
            $table->timestampTz('created_at')->useCurrent();

            $table->foreign('phone_number')
                ->references('phone')
                ->on('users')
                ->cascadeOnDelete();
        });

        DB::statement('CREATE UNIQUE INDEX categories_phone_name_unique ON categories (phone_number, LOWER(name))');
        DB::statement('CREATE INDEX idx_categories_phone ON categories (phone_number)');
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
