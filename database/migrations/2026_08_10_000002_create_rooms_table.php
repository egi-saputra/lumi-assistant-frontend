<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('owner_phone');
            $table->string('pin_hash')->nullable();
            $table->string('invite_code')->nullable()->unique();
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('deleted_at')->nullable();

            $table->foreign('owner_phone')
                ->references('phone')
                ->on('users')
                ->cascadeOnDelete();
        });

        DB::statement('CREATE INDEX idx_rooms_owner_phone ON rooms (owner_phone) WHERE deleted_at IS NULL');
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
