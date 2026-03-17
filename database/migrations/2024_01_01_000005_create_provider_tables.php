<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coc', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->string('type', 7)->nullable();
            $table->string('subtype', 128)->nullable();
            $table->string('url', 512);
            $table->text('cdescription')->nullable();
            $table->boolean('is_enabled')->default(false);
            $table->string('lang', 6)->nullable();
            $table->string('availfor', 5)->nullable();
        });

        Schema::create('provider', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255)->nullable();
            $table->text('localized_name')->nullable();
            $table->string('display_name', 255)->nullable();
            $table->text('localized_display_name')->nullable();
            $table->string('entity_id', 128)->unique();
            $table->text('nameid_format')->nullable();
            $table->text('name_ids')->nullable();
            $table->text('protocol')->nullable();
            $table->text('protocol_support')->nullable();
            $table->string('type', 32)->nullable();
            $table->boolean('want_assert_signed')->nullable();
            $table->boolean('want_authn_req_signed')->nullable();
            $table->boolean('authn_req_signed')->nullable();
            $table->text('scope')->nullable();
            $table->string('digest', 10)->nullable();
            $table->string('helpdesk_url', 255)->nullable();
            $table->text('localized_helpdesk_url')->nullable();
            $table->string('privacy_url', 255)->nullable();
            $table->text('localized_privacy_url')->nullable();
            $table->string('registrar', 255)->nullable();
            $table->dateTime('register_date')->nullable();
            $table->text('reg_policy')->nullable();
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('valid_to')->nullable();
            $table->text('description')->nullable();
            $table->string('country', 2)->nullable();
            $table->text('wayf_list')->nullable();
            $table->text('exc_arps')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->boolean('is_static')->default(false);
            $table->boolean('is_local')->default(false);
            $table->boolean('hide_from_public')->default(false);
            $table->uuid('owner_id')->nullable();
            $table->timestamps();
            $table->index('type');
            $table->index('name');
            $table->index('is_local');
        });

        Schema::create('Provider_Coc', function (Blueprint $table) {
            $table->uuid('provider_id');
            $table->uuid('coc_id');
            $table->primary(['provider_id', 'coc_id']);
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
            $table->foreign('coc_id')->references('id')->on('coc')->cascadeOnDelete();
        });

        Schema::create('federation_members', function (Blueprint $table) {
            $table->uuid('provider_id');
            $table->uuid('federation_id');
            $table->integer('join_state')->default(0);
            $table->boolean('is_disabled')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->primary(['provider_id', 'federation_id']);
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
            $table->foreign('federation_id')->references('id')->on('federation')->cascadeOnDelete();
        });

        Schema::create('partner', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('contact');
            $table->string('phone');
            $table->string('home_url')->unique();
            $table->text('description');
        });

        Schema::create('federation_partners', function (Blueprint $table) {
            $table->uuid('federation_id');
            $table->uuid('partner_id');
            $table->primary(['federation_id', 'partner_id']);
            $table->foreign('federation_id')->references('id')->on('federation')->cascadeOnDelete();
            $table->foreign('partner_id')->references('id')->on('partner')->cascadeOnDelete();
        });
    }

    public function down(): void {}
};
