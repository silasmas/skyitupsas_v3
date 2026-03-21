<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('picture')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->json('name'); // translatable
            $table->json('role'); // translatable
            $table->json('assets')->nullable(); // translatable: [{asset1, asset2, asset3, asset4}]
            $table->json('experience')->nullable(); // translatable: [{company, role, tasks}]
            $table->json('diplomas')->nullable(); // translatable: [{diploma}]
            $table->json('expertises')->nullable(); // translatable: [{expertise}]
            $table->json('work_countries')->nullable(); // translatable: [{region, countries}]
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
