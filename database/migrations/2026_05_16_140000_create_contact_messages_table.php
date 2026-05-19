<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crée la table des messages de contact reçus depuis le site.
     */
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 40)->nullable();
            $table->text('message');
            $table->string('source', 32)->default('contact_page');
            $table->string('locale', 8)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->boolean('consent_privacy')->default(false);
            $table->string('status', 32)->default('new')->index();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Supprime la table contact_messages.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
