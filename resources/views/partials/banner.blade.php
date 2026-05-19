@php
    $title = $pageTitle ?? config('app.name');
    $subtitle = $pageSubtitle ?? null;
    $compact = $bannerCompact ?? false;
@endphp

<section
    @class([
        'relative overflow-hidden border-b border-[#e3e3e0] dark:border-[#3E3E3A]',
        'py-12 lg:py-20' => ! $compact,
        'py-8 lg:py-12' => $compact,
    ])
    aria-label="En-tête de page"
>
    <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-sky-50/80 via-transparent to-amber-50/60 dark:from-sky-950/40 dark:to-amber-950/20" aria-hidden="true"></div>

    <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-semibold tracking-tight text-[#1b1b18] dark:text-[#EDEDEC] sm:text-4xl lg:text-5xl">
            {{ $title }}
        </h1>
        @if ($subtitle)
            <p class="mt-3 max-w-2xl text-base leading-relaxed text-[#706f6c] dark:text-[#A1A09A] sm:text-lg">
                {{ $subtitle }}
            </p>
        @endif
    </div>
</section>
