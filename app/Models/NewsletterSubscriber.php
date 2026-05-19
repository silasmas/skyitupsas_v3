<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Abonné à la newsletter du site.
 */
class NewsletterSubscriber extends Model
{
    protected $fillable = [
        'email',
        'locale',
        'ip_address',
        'is_active',
        'subscribed_at',
        'unsubscribed_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];
}
