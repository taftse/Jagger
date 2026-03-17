<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notificationlist', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('notification_type', 10);
            $table->string('type', 25);
            $table->uuid('provider_id')->nullable();
            $table->uuid('federation_id')->nullable();
            $table->string('email', 256)->nullable();
            $table->string('phone', 15)->nullable();
            $table->boolean('is_enabled')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            $table->index('type', 'type_idx');
            $table->foreign('user_id')->references('id')->on('user')->cascadeOnDelete();
            $table->foreign('provider_id')->references('id')->on('provider')->nullOnDelete();
            $table->foreign('federation_id')->references('id')->on('federation')->nullOnDelete();
        });
    }

    public function down(): void {}
};
