<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token', 32);
            $table->string('validationkey', 32);
            $table->string('mailfrom', 255);
            $table->string('mailto', 255);
            $table->string('created_at', 255);
            $table->string('validto', 255);
            $table->boolean('is_valid')->default(true);
            $table->string('targettype', 32);
            $table->string('targetid', 32);
            $table->string('actiontype', 32);
            $table->string('actionvalue', 32);
        });

        Schema::create('jcrontab', function (Blueprint $table) {
            $table->increments('id');
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
            $table->increments('id');
            $table->string('mgroup', 20);
            $table->string('lang', 6);
            $table->text('msgbody');
            $table->string('msgsubject', 50);
            $table->boolean('isdefault')->default(false);
            $table->boolean('isenabled')->default(true);
            $table->boolean('alwaysattach')->default(false);
        });

        Schema::create('mailqueue', function (Blueprint $table) {
            $table->increments('id');
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
            $table->increments('id');
            $table->string('type');
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedInteger('partner_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('provider')->nullOnDelete();
            $table->foreign('partner_id')->references('id')->on('partner')->nullOnDelete();
        });

        Schema::create('preferences', function (Blueprint $table) {
            $table->bigIncrements('id');
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
            $table->bigIncrements('id');
            $table->string('pcode', 25)->unique();
            $table->string('pcategory', 25)->nullable();
            $table->string('ptitle', 128)->nullable();
            $table->text('ptext')->nullable();
            $table->boolean('ispublic')->default(false);
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });

        Schema::create('tracker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('resourcetype', 25)->nullable();
            $table->string('subtype', 25)->nullable();
            $table->string('resourcename', 128)->nullable();
            $table->string('sourceip', 40)->nullable();
            $table->string('useragent', 128)->nullable();
            $table->string('user', 256)->nullable();
            $table->dateTime('created_at');
            $table->text('detail')->nullable();
            $table->index('resourcetype', 'resourcetype_idx');
            $table->index('subtype', 'subtype_idx');
        });

        Schema::create('fedvalidator', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 20);
            $table->unsignedInteger('federation_id');
            $table->boolean('is_enabled')->default(false);
            $table->boolean('is_mandatory')->default(false);
            $table->boolean('is_regenabled')->default(false);
            $table->string('url', 256);
            $table->string('method', 4);
            $table->string('entityparam', 32);
            $table->text('optargs')->nullable();
            $table->string('argseparator', 10)->nullable();
            $table->string('documenttype', 20);
            $table->text('description');
            $table->string('returncodeelement', 256);
            $table->string('returncodevalue', 512);
            $table->string('messagecodeelement', 256);
            $table->timestamps();
            $table->foreign('federation_id')->references('id')->on('federation')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fedvalidator');
        Schema::dropIfExists('tracker');
        Schema::dropIfExists('staticpage');
        Schema::dropIfExists('preferences');
        Schema::dropIfExists('partnership');
        Schema::dropIfExists('mailqueue');
        Schema::dropIfExists('maillocalization');
        Schema::dropIfExists('jcrontab');
        Schema::dropIfExists('invitation');
    }
};
