<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class JobOffer extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'requirements',
        'location',
        'contract_type',
        'published_at',
        'closes_at',
        'sort_order',
        'is_active',
    ];

    public array $translatable = [
        'title',
        'description',
        'requirements',
        'location',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'closes_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('published_at');
    }

    public function scopePublishedForPublic(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function (Builder $q): void {
                $q->whereNull('closes_at')
                    ->orWhere('closes_at', '>=', now());
            });
    }

    public function isOpenForApplications(): bool
    {
        if (! $this->is_active || $this->published_at === null) {
            return false;
        }
        if ($this->published_at->isFuture()) {
            return false;
        }
        if ($this->closes_at !== null && $this->closes_at->isPast()) {
            return false;
        }

        return true;
    }
}
