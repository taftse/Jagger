<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attribute', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 128)->unique();
            $table->string('full_name', 255);
            $table->string('oid', 255);
            $table->string('urn', 255);
            $table->boolean('in_metadata')->default(true);
            $table->text('description')->nullable();
        });
    }

    public function down(): void {}
};
