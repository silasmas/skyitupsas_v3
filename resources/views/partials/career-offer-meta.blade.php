{{-- Badges métadonnées d'une offre (contrat, lieu, clôture). --}}
@php
    $contractLabels = $contractLabels ?? [];
    $locale = app()->getLocale();
    $location = $offer->getTranslation('location', $locale, false);
@endphp
<ul class="sky-career-modal__meta list-none m-0 p-0 flex flex-wrap gap-10">
    @if ($offer->contract_type)
        <li class="sky-career-modal__pill">
            <span class="sky-career-modal__pill-label">{{ __('site.page_careers_contract') }}</span>
            <span class="sky-career-modal__pill-value">{{ $contractLabels[$offer->contract_type] ?? $offer->contract_type }}</span>
        </li>
    @endif
    @if ($location)
        <li class="sky-career-modal__pill">
            <span class="sky-career-modal__pill-label">{{ __('site.page_careers_location') }}</span>
            <span class="sky-career-modal__pill-value">{{ $location }}</span>
        </li>
    @endif
    @if ($offer->closes_at)
        <li class="sky-career-modal__pill">
            <span class="sky-career-modal__pill-label">{{ __('site.page_careers_deadline') }}</span>
            <span class="sky-career-modal__pill-value">{{ $offer->closes_at->translatedFormat('d M Y') }}</span>
        </li>
    @endif
</ul>
