<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crée les tables piliers et modules de services.
     */
    public function up(): void
    {
        Schema::create('service_pillars', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('title');
            $table->json('tagline')->nullable();
            $table->json('client_challenge')->nullable();
            $table->json('offer_summary')->nullable();
            $table->json('differentiator')->nullable();
            $table->json('meta_description')->nullable();
            $table->string('icon')->nullable();
            $table->string('featured_image')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('service_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_pillar_id')->constrained('service_pillars')->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->json('title');
            $table->json('benefit_text')->nullable();
            $table->json('summary_text')->nullable();
            $table->json('cta_label')->nullable();
            $table->string('cta_delay')->nullable();
            $table->json('meta_description')->nullable();
            $table->string('icon')->nullable();
            $table->string('featured_image')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Supprime les tables piliers et modules.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_modules');
        Schema::dropIfExists('service_pillars');
    }
};
