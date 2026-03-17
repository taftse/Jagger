<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('username', 128)->unique();
            $table->string('password');
            $table->string('old_password', 64)->nullable();
            $table->string('old_salt', 40)->nullable();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('given_name', 255)->nullable();
            $table->string('surname', 255)->nullable();
            $table->text('user_pref')->nullable();
            $table->boolean('is_local')->default(false);
            $table->boolean('is_federated')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_enabled')->default(false);
            $table->boolean('is_validated')->default(false);
            $table->dateTime('last_login')->nullable();
            $table->string('last_ip', 64)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('aclrole_members', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('role_id');
            $table->primary(['user_id', 'role_id']);
            $table->foreign('user_id')->references('id')->on('user')->cascadeOnDelete();
            $table->foreign('role_id')->references('id')->on('acl_role')->cascadeOnDelete();
        });
    }

    public function down(): void {}
};
