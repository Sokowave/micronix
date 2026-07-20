<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {

            $table->id();

            // Placement
            $table->string('location');

            // Content
            $table->string('title')
                ->nullable();

            $table->foreignId('media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            // Destination
            $table->enum('target_type', [
                'none',
                'product',
                'category',
                'brand',
                'custom',
            ])->default('none');

            $table->unsignedBigInteger('target_id')
                ->nullable();

            $table->string('custom_url')
                ->nullable();

            // Display
            $table->unsignedInteger('priority')
                ->default(0);

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->index([
                'location',
                'is_active',
            ]);

            $table->index([
                'location',
                'priority',
            ]);

            $table->index('media_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};