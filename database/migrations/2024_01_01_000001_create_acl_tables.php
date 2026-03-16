<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acl_resource', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('resource', 30)->unique();
            $table->string('description', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('default_value', 10)->nullable();
            $table->foreign('parent_id')->references('id')->on('acl_resource')->nullOnDelete();
        });

        Schema::create('acl_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('type', 10);
            $table->string('description', 128);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('acl_role')->nullOnDelete();
        });

        Schema::create('acl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resource_id');
            $table->unsignedBigInteger('role_id');
            $table->string('action', 10);
            $table->boolean('access');
            $table->foreign('resource_id')->references('id')->on('acl_resource')->cascadeOnDelete();
            $table->foreign('role_id')->references('id')->on('acl_role')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acl');
        Schema::dropIfExists('acl_role');
        Schema::dropIfExists('acl_resource');
    }
};
