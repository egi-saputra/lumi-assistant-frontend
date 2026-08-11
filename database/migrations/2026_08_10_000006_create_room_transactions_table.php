<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('category_name');
            $table->text('description')->default('');
            $table->text('payment_method')->nullable();
            $table->unsignedBigInteger('room_id');
            $table->string('type')->default('expense');
            $table->text('raw_message')->default('');
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('deleted_at')->nullable();

            $table->foreign('phone_number')
                ->references('phone')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->cascadeOnDelete();
        });

        DB::statement('ALTER TABLE room_transactions ADD CONSTRAINT room_transactions_amount_nonnegative CHECK (amount >= 0)');
        DB::statement("ALTER TABLE room_transactions ADD CONSTRAINT room_transactions_type_check CHECK (type IN ('expense', 'income'))");
        DB::statement('CREATE INDEX idx_room_transactions_room_created ON room_transactions (room_id, created_at DESC) WHERE deleted_at IS NULL');
    }

    public function down(): void
    {
        Schema::dropIfExists('room_transactions');
    }
};
