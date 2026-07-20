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
        Schema::create('categories', function (Blueprint $table) {

            $table->id();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->foreignId('media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->string('public_id')->unique();

            $table->string('name');
            $table->string('slug');

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Same slug allowed under different parents
            $table->unique(['parent_id', 'slug']);

            $table->index(['parent_id', 'is_active']);
            $table->index('media_id');
            $table->index('is_featured');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};