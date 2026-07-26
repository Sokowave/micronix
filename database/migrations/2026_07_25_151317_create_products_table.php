<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Public identifier
            $table->uuid('public_id')->unique();

            // Relationships
            $table->foreignId('category_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('brand_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Product
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();

            // Pricing
            $table->decimal('price', 12, 2);
            $table->decimal('sale_price', 12, 2)->nullable();

            // Inventory
            $table->unsignedInteger('stock_quantity')->default(0);

            // Details
            $table->string('condition')->default('new');

            $table->unsignedInteger('warranty')
                ->nullable()
                ->comment('Warranty period in months');

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Indexes
            $table->index(['category_id', 'is_active']);
            $table->index(['brand_id', 'is_active']);
            $table->index(['is_featured', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};