<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();

            $table->foreignId('media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();

            $table->string('button_text')->nullable();
            $table->string('url')->nullable();

            $table->string('location')->default('home_hero');

            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index([
                'location',
                'is_active',
                'position',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};