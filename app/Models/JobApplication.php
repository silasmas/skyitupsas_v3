<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_REVIEWED = 'reviewed';

    public const STATUS_SHORTLISTED = 'shortlisted';

    public const STATUS_REJECTED = 'rejected';

    public const STATUS_HIRED = 'hired';

    protected $fillable = [
        'job_offer_id',
        'locale',
        'first_name',
        'last_name',
        'email',
        'phone',
        'cover_letter',
        'cover_letter_path',
        'cv_path',
        'linkedin_url',
        'status',
        'reviewed_at',
        'reviewed_by',
        'ip_address',
        'consent_privacy',
    ];

    protected $casts = [
        'consent_privacy' => 'boolean',
        'reviewed_at' => 'datetime',
    ];

    public function jobOffer(): BelongsTo
    {
        return $this->belongsTo(JobOffer::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public static function statusOptions(): array
    {
        return [
            self::STATUS_PENDING => 'En attente',
            self::STATUS_REVIEWED => 'Examinée',
            self::STATUS_SHORTLISTED => 'Présélection',
            self::STATUS_REJECTED => 'Refusée',
            self::STATUS_HIRED => 'Embauchée',
        ];
    }
}
