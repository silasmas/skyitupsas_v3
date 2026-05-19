<?php

return [

    'phone' => env('SKY_CONTACT_PHONE', '(+243) 821 790 718'),

    'phone_href' => env('SKY_CONTACT_PHONE_HREF', '+243821790718'),

    'email' => env('SKY_CONTACT_EMAIL', 'contact@skyitupsas.com'),

    'address' => env('SKY_ADDRESS', 'République Démocratique du Congo'),

    /** Pour les blocs carte Hub ( ld-gmap ) : https://developers.google.com/maps/documentation/javascript/get-api-key */
    'google_maps_api_key' => env('GOOGLE_MAPS_API_KEY'),

    'social' => [
        'facebook' => env('SKY_SOCIAL_FACEBOOK', '#'),
        'twitter' => env('SKY_SOCIAL_TWITTER', '#'),
        'instagram' => env('SKY_SOCIAL_INSTAGRAM', '#'),
        'linkedin' => env('SKY_SOCIAL_LINKEDIN', '#'),
    ],

    /**
     * Chemins relatifs à public/assets/img — mêmes visuels que https://skyitupsas.com/
     */
    /** Images services (ancien site skyitupsas.com/service) — chemin relatif à public/assets/img */
    'service_images' => [
        'service-consulting' => 'services/service-1.png',
        'support-et-assistance' => 'welcomer.jpg',
        'solutions-numeriques-logiciels' => 'services/service-2.jpg',
        'infrastructure-informatique' => 'services/service-3.jpg',
        'formation-transformation-digitale' => 'services/service-4.jpg',
        'service-assistance' => 'services/service-5.jpg',
    ],

    'site_media' => [
        'banner' => 'sliders/slider-1.png',
        'thin_section_bg' => 'sliders/slider-2.png',
        'flip_1' => 'sliders/slider-1.png',
        'flip_2' => 'sliders/slider-2.png',
        'flip_3' => 'sliders/slider-3.png',
        'offer_primary' => 'welcomer.jpg',
        'offer_secondary' => 'team/member-1.jpg',
        'testimonials_bg' => 'watermark.png',
        'news_1' => 'team/member-1.jpg',
        'news_2' => 'team/member-2.jpg',
        'news_3' => 'team/member-3.jpg',
        'about_titlebar' => 'sliders/slider-2.png',
        'about_gallery_large' => 'sliders/slider-1.png',
        'about_gallery_top_right' => 'sliders/slider-2.png',
        'about_gallery_small_1' => 'welcomer.jpg',
        'about_gallery_small_2' => 'team/member-2.jpg',
        'about_accordion_visual' => 'team/member-4.jpg',
        'og' => 'sliders/slider-1.png',
    ],

    'site_partner_logos' => [
        'partners/partner-1.png',
        'partners/partner-2.png',
        'partners/partner-3.png',
        'partners/partner-4.png',
        'partners/partner-5.png',
        'partners/partner-6.png',
    ],

];
