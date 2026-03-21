<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->json('big_title')->nullable()->after('slug');
            $table->json('big_title_1')->nullable()->after('big_title');
            $table->json('big_title_2')->nullable()->after('big_title_1');
            $table->json('welcome_title_1')->nullable()->after('big_title_2');
            $table->json('welcome_title_2')->nullable()->after('welcome_title_1');
            $table->json('experience_label')->nullable()->after('content');
            $table->json('diploma_label')->nullable()->after('experience_label');
            $table->json('expertise_label')->nullable()->after('diploma_label');
            $table->json('work_countries_label')->nullable()->after('expertise_label');
            $table->json('content1')->nullable()->after('work_countries_label');
            $table->json('content2')->nullable()->after('content1');
        });
    }

    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn([
                'big_title', 'big_title_1', 'big_title_2',
                'welcome_title_1', 'welcome_title_2',
                'experience_label', 'diploma_label', 'expertise_label', 'work_countries_label',
                'content1', 'content2',
            ]);
        });
    }
};
