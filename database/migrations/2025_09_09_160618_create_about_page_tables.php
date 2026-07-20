
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_page_settings', function (Blueprint $table) {
            $table->id();

            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();

            $table->foreignId('media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->text('story')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();

            $table->json('stats')->nullable();

            $table->string('cta_text')->nullable();
            $table->string('cta_link')->nullable();

            $table->timestamps();
        });

        Schema::create('awards', function (Blueprint $table) {
            $table->id();

            $table->year('year')->nullable();

            $table->string('title')->unique();
            $table->text('description')->nullable();

            $table->foreignId('media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('partners', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();

            $table->foreignId('media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('team_members', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('role');

            $table->foreignId('media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('timeline_milestones', function (Blueprint $table) {
            $table->id();

            $table->year('year');
            $table->string('title');
            $table->text('description');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timeline_milestones');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('partners');
        Schema::dropIfExists('awards');
        Schema::dropIfExists('about_page_settings');
    }
};
