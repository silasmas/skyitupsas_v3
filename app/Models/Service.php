<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'description',
        'content',
        'meta_description',
        'icon',
        'featured_image',
        'sort_order',
        'is_active',
    ];

    public array $translatable = [
        'title',
        'subtitle',
        'description',
        'content',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Retourne l’URL publique de l’image du service (BDD ou repli config).
     *
     * @return string URL absolue de l’image
     */
    public function imageUrl(): string
    {
        if ($this->featured_image && file_exists(public_path('assets/img/'.$this->featured_image))) {
            return asset('assets/img/'.$this->featured_image);
        }

        $fallback = config('sky.service_images.'.$this->slug);

        if ($fallback && file_exists(public_path('assets/img/'.$fallback))) {
            return asset('assets/img/'.$fallback);
        }

        $hubDefault = public_path('hub/assets/images/demo/company/services-2/portfoliodetail.jpg');
        if (file_exists($hubDefault)) {
            return asset('hub/assets/images/demo/company/services-2/portfoliodetail.jpg');
        }

        return asset('assets/img/'.config('sky.site_media.offer_primary', 'welcomer.jpg'));
    }
}
