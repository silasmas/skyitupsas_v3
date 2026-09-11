@php
    /** @var \Illuminate\Support\Collection<int, \App\Models\ServicePillar>|null $homeServices */
    $tiles = isset($homeServices) ? $homeServices->take(5) : collect();
@endphp
@forelse ($tiles as $index => $pillar)
    @php
        $locale = app()->getLocale();
        $title = $pillar->getTranslation('title', $locale);
        $lead = $pillar->getTranslation('client_challenge', $locale, false)
            ?: $pillar->getTranslation('offer_summary', $locale, false);
    @endphp
    <div class="w-20percent flex flex-auto p-10 lg:w-50percent sm:w-full">
        <a href="{{ route('services').'#'.$pillar->slug }}" class="iconbox flex flex-grow-1 relative flex-col iconbox-default py-25 px-15 mb-30 items-center bg-accent rounded-6 transition-bg hover:bg-secondary hover:text-secondary hover:inner-text-white lg:m-0 no-underline">
            <span class="text-12 font-bold text-black-40 mb-10">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
            <h3 class="lqd-iconbox-heading text-center text-15 leading-1/2em mb-10 inner-text-white px-5">{{ $title }}</h3>
            @if ($lead)
                <p class="text-12 text-center text-white-80 mb-0 px-5 m-0">{{ \Illuminate\Support\Str::limit(strip_tags((string) $lead), 70) }}</p>
            @endif
        </a>
    </div>
@empty
    <div class="w-full text-center text-black-60 py-20">
        <p class="mb-0">{{ __('site.home_case_empty') }}</p>
    </div>
@endforelse
