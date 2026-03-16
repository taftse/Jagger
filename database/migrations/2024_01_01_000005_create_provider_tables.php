<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coc', function (Blueprint $table) {
            $table->increments('id');
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
            $table->bigIncrements('id');
            $table->string('name', 255)->nullable();
            $table->text('lname')->nullable();
            $table->string('displayname', 255)->nullable();
            $table->text('ldisplayname')->nullable();
            $table->string('entityid', 128)->unique();
            $table->text('nameidformat')->nullable();
            $table->text('nameids')->nullable();
            $table->text('protocol')->nullable();
            $table->text('protocolsupport')->nullable();
            $table->string('type', 5)->nullable();
            $table->boolean('wantassertsigned')->nullable();
            $table->boolean('wantauthnreqsigned')->nullable();
            $table->boolean('authnreqsigned')->nullable();
            $table->text('scope')->nullable();
            $table->string('digest', 10)->nullable();
            $table->string('helpdeskurl', 255)->nullable();
            $table->text('lhelpdeskurl')->nullable();
            $table->string('privacyurl', 255)->nullable();
            $table->text('lprivacyurl')->nullable();
            $table->string('registrar', 255)->nullable();
            $table->dateTime('registerdate')->nullable();
            $table->text('regpolicy')->nullable();
            $table->dateTime('validfrom')->nullable();
            $table->dateTime('validto')->nullable();
            $table->text('description')->nullable();
            $table->string('country', 2)->nullable();
            $table->text('wayflist')->nullable();
            $table->text('excarps')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->boolean('is_static')->default(false);
            $table->boolean('is_local')->default(false);
            $table->boolean('hidepublic')->default(false);
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->index('type');
            $table->index('name');
            $table->index('is_local');
        });

        Schema::create('Provider_Coc', function (Blueprint $table) {
            $table->unsignedBigInteger('provider_id');
            $table->unsignedInteger('coc_id');
            $table->primary(['provider_id', 'coc_id']);
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
            $table->foreign('coc_id')->references('id')->on('coc')->cascadeOnDelete();
        });

        Schema::create('federation_members', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedInteger('federation_id');
            $table->integer('joinstate')->default(0);
            $table->boolean('isdisabled')->default(false);
            $table->boolean('isbanned')->default(false);
            $table->unique(['provider_id', 'federation_id'], 'memberspair_idx');
            $table->foreign('provider_id')->references('id')->on('provider')->cascadeOnDelete();
            $table->foreign('federation_id')->references('id')->on('federation')->cascadeOnDelete();
        });

        Schema::create('partner', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('contact');
            $table->string('phone');
            $table->string('homeurl')->unique();
            $table->text('description');
        });

        Schema::create('federation_partners', function (Blueprint $table) {
            $table->unsignedInteger('federation_id');
            $table->unsignedInteger('partner_id');
            $table->primary(['federation_id', 'partner_id']);
            $table->foreign('federation_id')->references('id')->on('federation')->cascadeOnDelete();
            $table->foreign('partner_id')->references('id')->on('partner')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('federation_partners');
        Schema::dropIfExists('partner');
        Schema::dropIfExists('federation_members');
        Schema::dropIfExists('Provider_Coc');
        Schema::dropIfExists('provider');
        Schema::dropIfExists('coc');
    }
};
