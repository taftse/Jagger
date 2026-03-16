<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 128)->unique();
            $table->string('password', 64);
            $table->string('salt', 40)->nullable();
            $table->string('email', 255);
            $table->string('givenname', 255)->nullable();
            $table->string('surname', 255)->nullable();
            $table->text('userpref')->nullable();
            $table->boolean('local')->default(false);
            $table->boolean('federated')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('enabled')->default(false);
            $table->boolean('validated')->default(false);
            $table->dateTime('lastlogin')->nullable();
            $table->string('lastip', 64)->nullable();
        });

        Schema::create('aclrole_members', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->primary(['user_id', 'role_id']);
            $table->foreign('user_id')->references('id')->on('user')->cascadeOnDelete();
            $table->foreign('role_id')->references('id')->on('acl_role')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aclrole_members');
        Schema::dropIfExists('user');
    }
};
