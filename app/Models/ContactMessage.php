<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Message envoyé via un formulaire de contact du site public.
 */
class ContactMessage extends Model
{
    public const STATUS_NEW = 'new';

    public const STATUS_READ = 'read';

    public const STATUS_REPLIED = 'replied';

    public const SOURCE_HOME_SECTION = 'home_section';

    public const SOURCE_HOME_MODAL = 'home_modal';

    public const SOURCE_CONTACT_PAGE = 'contact_page';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'source',
        'locale',
        'ip_address',
        'consent_privacy',
        'status',
        'read_at',
    ];

    protected $casts = [
        'consent_privacy' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Libellés des statuts pour l’administration.
     *
     * @return array<string, string>
     */
    public static function statusOptions(): array
    {
        return [
            self::STATUS_NEW => 'Nouveau',
            self::STATUS_READ => 'Lu',
            self::STATUS_REPLIED => 'Répondu',
        ];
    }

    /**
     * Libellés des sources de formulaire.
     *
     * @return array<string, string>
     */
    public static function sourceOptions(): array
    {
        return [
            self::SOURCE_HOME_SECTION => 'Accueil (section)',
            self::SOURCE_HOME_MODAL => 'Accueil (modale)',
            self::SOURCE_CONTACT_PAGE => 'Page contact',
        ];
    }
}
