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
        Schema::create('seo_landing_pages', function (Blueprint $table) {
            $table->id();

            // Page
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('h1');

            // Short description displayed below H1
            $table->text('intro')->nullable();

            // Dynamic product targeting
            $table->json('filters')->nullable();

            // SEO
            $table->string('meta_title');
            $table->text('meta_description')->nullable();

            // Publishing & indexing
            $table->boolean('is_active')->default(true);

            // Display ordering
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            // Indexes
            $table->index(['is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_landing_pages');
    }
};
