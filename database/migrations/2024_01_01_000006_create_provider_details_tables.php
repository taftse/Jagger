<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 12);
            $table->string('certusage', 12)->nullable();
            $table->string('certtype', 26)->nullable();
            $table->text('certdata')->nullable();
            $table->text('encmethods')->nullable();
            $table->string('subject', 128)->nullable();
            $table->unsignedBigInteger('provider_id');
            $table->boolean('is_default')->default(true);
            $table->string('keyname', 512)->nullable();
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
        });

        Schema::create('contact', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('givenname', 255)->nullable();
            $table->string('surname', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('type', 64);
            $table->boolean('issirfty')->default(false);
            $table->string('phone', 24)->nullable();
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
        });

        Schema::create('service_location', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('binding_name');
            $table->string('url');
            $table->boolean('is_default')->default(false);
            $table->integer('ordered_no')->nullable();
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
        });

        Schema::create('provider_metadata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('metadata');
            $table->unsignedBigInteger('provider_id')->unique();
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
        });

        Schema::create('extend_metadata', function (Blueprint $table) {
            $table->increments('id');
            $table->string('etype', 12);
            $table->unsignedBigInteger('provider_id');
            $table->string('namespace', 32);
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('element', 32);
            $table->text('evalue')->nullable();
            $table->string('attrs', 255)->nullable();
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
            $table->foreign('parent_id')->references('id')->on('extend_metadata')->nullOnDelete();
        });

        Schema::create('attribute_release_policy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 10);
            $table->unsignedInteger('attribute_id');
            $table->unsignedBigInteger('idp_id');
            $table->integer('requester')->nullable();
            $table->index('requester', 'requester_idx');
            $table->foreign('attribute_id')->references('id')->on('attribute')->cascadeOnDelete();
            $table->foreign('idp_id')->references('id')->on('provider')->cascadeOnDelete();
        });

        Schema::create('attribute_requirement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('attribute_id');
            $table->unsignedBigInteger('sp_id')->nullable();
            $table->unsignedInteger('fed_id')->nullable();
            $table->string('type', 5);
            $table->string('status', 10)->nullable();
            $table->string('reason')->nullable();
            $table->index('type', 'type_idx');
            $table->foreign('attribute_id')->references('id')->on('attribute')->cascadeOnDelete();
            $table->foreign('sp_id')->references('id')->on('provider')->nullOnDelete();
            $table->foreign('fed_id')->references('id')->on('federation')->nullOnDelete();
        });

        Schema::create('providerstatsdef', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shortname', 20);
            $table->string('titlename', 128);
            $table->unsignedBigInteger('provider_id');
            $table->string('type', 20);
            $table->string('predefinedcol', 50)->nullable();
            $table->string('method', 5)->nullable();
            $table->string('formattype', 20)->nullable();
            $table->string('sourceurl', 512)->nullable();
            $table->string('accesstype', 20)->nullable();
            $table->string('authuser', 20)->nullable();
            $table->string('authpass', 50)->nullable();
            $table->text('displayoptions')->nullable();
            $table->text('postoptions')->nullable();
            $table->text('description');
            $table->boolean('overwrite')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
        });

        Schema::create('providerstatscollection', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('statdefinition_id');
            $table->string('format', 15);
            $table->string('statfilename', 50);
            $table->dateTime('created_at');
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
            $table->foreign('statdefinition_id')->references('id')->on('providerstatsdef')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('providerstatscollection');
        Schema::dropIfExists('providerstatsdef');
        Schema::dropIfExists('attribute_requirement');
        Schema::dropIfExists('attribute_release_policy');
        Schema::dropIfExists('extend_metadata');
        Schema::dropIfExists('provider_metadata');
        Schema::dropIfExists('service_location');
        Schema::dropIfExists('contact');
        Schema::dropIfExists('certificate');
    }
};
