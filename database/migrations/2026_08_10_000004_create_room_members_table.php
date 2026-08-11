<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_members', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->string('phone_number');
            $table->string('role')->default('member');
            $table->string('joined_via')->nullable();
            $table->timestampTz('joined_at')->useCurrent();

            $table->primary(['room_id', 'phone_number']);
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->cascadeOnDelete();
            $table->foreign('phone_number')
                ->references('phone')
                ->on('users')
                ->cascadeOnDelete();
        });

        DB::statement('CREATE INDEX idx_room_members_phone ON room_members (phone_number)');
    }

    public function down(): void
    {
        Schema::dropIfExists('room_members');
    }
};
