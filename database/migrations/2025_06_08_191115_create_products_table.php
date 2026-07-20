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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->uuid('public_id')->unique();

            $table->foreignId('category_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('brand_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('title');
            $table->string('slug')->unique();

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->json('specifications')->nullable();

            $table->string('sku')->nullable()->unique();
            $table->unsignedInteger('stock')->default(0);

            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();

            $table->dateTime('sale_starts_at')->nullable();
            $table->dateTime('sale_ends_at')->nullable();

            $table->boolean('featured')->default(false);

            $table->enum('condition', [
                'new',
                'refurbished',
                'used',
            ])->default('refurbished');

            $table->string('color')->nullable();
            $table->string('model')->nullable();
            $table->unsignedInteger('warranty') ->default(0) ->comment('Warranty in months');

            $table->enum('status', [
                'draft',
                'published',
            ])->default('draft');

            $table->timestamp('published_at')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index(['category_id', 'status']);
            $table->index('brand_id');
            $table->index('featured');
            $table->index('condition');
            $table->index('model');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};