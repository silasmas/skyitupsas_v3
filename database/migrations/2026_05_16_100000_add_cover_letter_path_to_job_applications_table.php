<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajoute le chemin du fichier PDF de lettre de motivation.
     */
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->string('cover_letter_path')->nullable()->after('cover_letter');
        });
    }

    /**
     * Supprime la colonne cover_letter_path.
     */
    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropColumn('cover_letter_path');
        });
    }
};
