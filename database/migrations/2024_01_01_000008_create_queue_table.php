<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('queue', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('action')->nullable();
            $table->string('recipient', 255)->nullable();
            $table->string('recipienttype', 20)->nullable();
            $table->string('type');
            $table->text('objdata');
            $table->string('objtype', 20);
            $table->uuid('creator')->nullable();
            $table->string('email', 255);
            $table->string('fullname', 255)->nullable();
            $table->string('srcip', 64);
            $table->string('token', 36);
            $table->boolean('is_confirmed')->default(false);
            $table->string('created_at', 255);
            $table->index(['creator', 'token'], 'search_idx');
            $table->foreign('creator')->references('id')->on('user')->nullOnDelete();
        });
    }

    public function down(): void {}
};
