<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificate', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type', 12);
            $table->string('cert_usage', 12)->nullable();
            $table->string('cert_type', 26)->nullable();
            $table->text('cert_data')->nullable();
            $table->text('enc_methods')->nullable();
            $table->string('subject', 128)->nullable();
            $table->uuid('provider_id');
            $table->boolean('is_default')->default(true);
            $table->string('key_name', 512)->nullable();
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
        });

        Schema::create('contact', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('given_name', 255)->nullable();
            $table->string('surname', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('type', 64);
            $table->boolean('is_sirtfi')->default(false);
            $table->string('phone', 24)->nullable();
            $table->uuid('provider_id');
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
        });

        Schema::create('service_location', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->string('binding_name');
            $table->string('url');
            $table->boolean('is_default')->default(false);
            $table->integer('ordered_no')->nullable();
            $table->uuid('provider_id');
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
        });

        Schema::create('provider_metadata', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('metadata');
            $table->uuid('provider_id')->unique();
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
        });

        Schema::create('extend_metadata', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('etype', 12);
            $table->uuid('provider_id');
            $table->string('namespace', 32);
            $table->uuid('parent_id')->nullable();
            $table->string('element', 32);
            $table->text('evalue')->nullable();
            $table->string('attributes', 255)->nullable();
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
            $table->foreign('parent_id')->references('id')->on('extend_metadata')->nullOnDelete();
        });

        Schema::create('attribute_release_policy', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type', 10);
            $table->uuid('attribute_id');
            $table->uuid('provider_id');
            $table->uuid('requester_id')->nullable();
            $table->foreign('attribute_id')->references('id')->on('attribute')->cascadeOnDelete();
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
            $table->foreign('requester_id')->references('id')->on('provider')->nullOnDelete();
        });

        Schema::create('attribute_requirement', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('attribute_id');
            $table->uuid('provider_id')->nullable();
            $table->uuid('federation_id')->nullable();
            $table->string('type', 5);
            $table->string('status', 10)->nullable();
            $table->string('reason')->nullable();
            $table->index('type', 'type_idx');
            $table->foreign('attribute_id')->references('id')->on('attribute')->cascadeOnDelete();
            $table->foreign('provider_id')->references('id')->on('provider')->nullOnDelete();
            $table->foreign('federation_id')->references('id')->on('federation')->nullOnDelete();
        });

        Schema::create('providerstatsdef', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('short_name', 20);
            $table->string('title_name', 128);
            $table->uuid('provider_id');
            $table->string('type', 20);
            $table->string('predefined_col', 50)->nullable();
            $table->string('method', 5)->nullable();
            $table->string('format_type', 20)->nullable();
            $table->string('source_url', 512)->nullable();
            $table->string('access_type', 20)->nullable();
            $table->string('auth_user', 20)->nullable();
            $table->string('auth_pass', 50)->nullable();
            $table->text('display_options')->nullable();
            $table->text('post_options')->nullable();
            $table->text('description');
            $table->boolean('overwrite')->nullable();
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
        });

        Schema::create('providerstatscollection', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('provider_id');
            $table->uuid('stats_def_id');
            $table->string('format', 15);
            $table->string('stat_filename', 50);
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
            $table->foreign('stats_def_id')->references('id')->on('providerstatsdef')->cascadeOnDelete();
        });
    }

    public function down(): void {}
};
