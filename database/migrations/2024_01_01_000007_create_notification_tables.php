<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notificationlist', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subscriber');
            $table->string('notificationtype', 10);
            $table->string('type', 25);
            $table->unsignedBigInteger('provider')->nullable();
            $table->unsignedInteger('federation')->nullable();
            $table->string('email', 256)->nullable();
            $table->string('phone', 15)->nullable();
            $table->boolean('isenabled')->default(false);
            $table->boolean('isapproved')->default(false);
            $table->dateTime('created');
            $table->dateTime('updated');
            $table->index('type', 'type_idx');
            $table->index('subscriber', 'subscibe_idx');
            $table->foreign('subscriber')->references('id')->on('user')->cascadeOnDelete();
            $table->foreign('provider')->references('id')->on('provider')->nullOnDelete();
            $table->foreign('federation')->references('id')->on('federation')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notificationlist');
    }
};
