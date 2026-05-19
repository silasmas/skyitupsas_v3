<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crée la table des abonnés à la newsletter.
     */
    public function up(): void
    {
        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('locale', 8)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamp('unsubscribed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Supprime la table newsletter_subscribers.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter_subscribers');
    }
};
