<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitation', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('token', 36)->unique();
            $table->string('validation_key', 36);
            $table->string('mail_from', 255);
            $table->string('mail_to', 255);
            $table->dateTime('valid_till')->nullable();
            $table->boolean('is_valid')->default(true);
            $table->string('target_type', 128)->nullable();
            $table->uuid('target_id')->nullable();
            $table->string('actiontype', 32);
            $table->string('actionvalue', 32);
            $table->timestamps();
        });

        Schema::create('jcrontab', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jminute', 255)->nullable();
            $table->string('jhour', 255)->nullable();
            $table->string('jdayofmonth', 255)->nullable();
            $table->string('jmonth', 255)->nullable();
            $table->string('jdayofweek', 255)->nullable();
            $table->string('jcommand', 255);
            $table->string('jparams', 512);
            $table->string('jservers', 512)->nullable();
            $table->boolean('tonotify')->default(false);
            $table->string('jcomment', 1024);
            $table->boolean('isenabled')->default(false);
            $table->boolean('istemplate')->default(false);
            $table->dateTime('lastrun')->nullable();
        });

        Schema::create('maillocalization', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('mgroup', 20);
            $table->string('lang', 6);
            $table->text('msgbody');
            $table->string('msgsubject', 50);
            $table->boolean('isdefault')->default(false);
            $table->boolean('isenabled')->default(true);
            $table->boolean('alwaysattach')->default(false);
        });

        Schema::create('mailqueue', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('deliverytype', 10);
            $table->string('rcptto', 256);
            $table->string('msubject', 128);
            $table->text('mbody');
            $table->string('frequence', 2);
            $table->dateTime('createdat');
            $table->dateTime('sentat')->nullable();
            $table->boolean('issent')->default(false);
            $table->index('frequence', 'freq_idx');
            $table->index('issent', 'issent_idx');
        });

        Schema::create('partnership', function (Blueprint $table) {
            $table->uuid('provider_id');
            $table->uuid('partner_id');
            $table->string('type');
            $table->primary(['provider_id', 'partner_id']);
            $table->foreign('provider_id')->references('id')->on('provider')->nullOnDelete();
            $table->foreign('partner_id')->references('id')->on('partner')->nullOnDelete();
        });

        Schema::create('preferences', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 30)->unique();
            $table->string('stype', 12);
            $table->string('scategory', 10);
            $table->string('descname', 50);
            $table->text('pvalue')->nullable();
            $table->text('serializedvalue')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->text('description');
        });

        Schema::create('staticpage', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pcode', 25)->unique();
            $table->string('pcategory', 25)->nullable();
            $table->string('ptitle', 128)->nullable();
            $table->text('ptext')->nullable();
            $table->boolean('ispublic')->default(false);
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });

        Schema::create('tracker', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('resource_type', 25)->nullable();
            $table->string('subtype', 25)->nullable();
            $table->string('resource_name', 128)->nullable();
            $table->string('source_ip', 40)->nullable();
            $table->string('user_agent', 128)->nullable();
            $table->string('user', 256)->nullable();
            $table->dateTime('created_at');
            $table->text('detail')->nullable();
            $table->index('resource_type', 'resourcetype_idx');
            $table->index('subtype', 'subtype_idx');
        });

        Schema::create('fedvalidator', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 20);
            $table->uuid('federation_id');
            $table->boolean('is_enabled')->default(false);
            $table->boolean('is_mandatory')->default(false);
            $table->boolean('is_reg_enabled')->default(false);
            $table->string('url', 256);
            $table->string('method', 4);
            $table->string('entity_param', 32);
            $table->text('opt_args')->nullable();
            $table->string('arg_separator', 10)->nullable();
            $table->string('document_type', 20);
            $table->text('description');
            $table->string('return_code_element', 256);
            $table->string('return_code_value', 512);
            $table->string('message_code_element', 256);
            $table->timestamps();
            $table->foreign('federation_id')->references('id')->on('federation')->cascadeOnDelete();
        });
    }

    public function down(): void {}
};
