<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('federation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128)->unique();
            $table->string('sysname', 128)->unique()->nullable();
            $table->string('urn', 255)->unique();
            $table->string('descriptorid', 128)->nullable();
            $table->string('publisher', 512)->nullable();
            $table->string('publisherexport', 512)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_protected')->default(false);
            $table->boolean('is_public')->default(false);
            $table->boolean('is_lexport')->default(false);
            $table->boolean('is_local')->default(true);
            $table->string('digest', 10)->nullable();
            $table->string('digestexport', 10)->nullable();
            $table->boolean('attrreq_inmeta')->default(true);
            $table->text('tou')->nullable();
            $table->boolean('usealtmetaurl')->default(false);
            $table->string('altmetaurl', 512)->nullable();
            $table->string('owner', 255)->nullable();
        });

        Schema::create('fedcategory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shortname', 28)->unique();
            $table->string('descname', 56);
            $table->string('description', 512);
            $table->boolean('isdefault')->default(false);
        });

        Schema::create('fedcategory_members', function (Blueprint $table) {
            $table->unsignedInteger('federation_id');
            $table->unsignedInteger('fedcategory_id');
            $table->primary(['federation_id', 'fedcategory_id']);
            $table->foreign('federation_id')->references('id')->on('federation')->cascadeOnDelete();
            $table->foreign('fedcategory_id')->references('id')->on('fedcategory')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fedcategory_members');
        Schema::dropIfExists('fedcategory');
        Schema::dropIfExists('federation');
    }
};
