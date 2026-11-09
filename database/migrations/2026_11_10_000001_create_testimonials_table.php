<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crée la table des témoignages clients gérés depuis Filament.
     */
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('quote');
            $table->json('name');
            $table->json('role')->nullable();
            $table->json('company')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Supprime la table des témoignages.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
