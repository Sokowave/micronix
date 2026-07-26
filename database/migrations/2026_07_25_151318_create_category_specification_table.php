<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_specification', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('specification_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('position')->default(0);

            $table->unique([
                'category_id',
                'specification_id',
            ]);

            $table->index([
                'category_id',
                'position',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_specification');
    }
};