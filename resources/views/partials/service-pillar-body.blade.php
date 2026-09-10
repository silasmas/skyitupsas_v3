@php
    /** @var \App\Models\ServicePillar $pillar */
    /** @var \Illuminate\Support\Collection<int, \App\Models\ServiceModule> $modules */
    $locale = app()->getLocale();
    $differentiator = $pillar->getTranslation('differentiator', $locale, false);
@endphp

@if ($modules->isNotEmpty())
    <div class="w-full relative mb-40">
        <h3 class="ld-fh-element relative mb-1em text-22">{{ __('site.services_modules_title') }}</h3>
        <div class="sky-service-modules space-y-25">
            @foreach ($modules as $module)
                @php
                    $moduleTitle = $module->getTranslation('title', $locale);
                    $benefit = $module->getTranslation('benefit_text', $locale, false);
                    $summary = $module->getTranslation('summary_text', $locale, false);
                    $cta = $module->getTranslation('cta_label', $locale, false);
                @endphp
                <article id="{{ $pillar->slug }}-{{ $module->slug }}" class="sky-service-module border-1 border-black-10 rounded-4 p-25 mb-25 bg-white">
                    <h4 class="text-18 text-secondary mt-0 mb-15">{{ $moduleTitle }}</h4>
                    @if ($benefit)
                        <div class="prose prose-sm max-w-none text-black-70 mb-15">
                            {!! $benefit !!}
                        </div>
                    @endif
                    @if ($summary)
                        <p class="mb-15 text-14 text-black-60"><em>{{ $summary }}</em></p>
                    @endif
                    @if ($cta)
                        <p class="mb-0">
                            <a href="{{ route('contact') }}" class="btn btn-sm bg-secondary text-white font-bold px-20 py-10 rounded-4 inline-block">
                                {{ $cta }}
                            </a>
                        </p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
@endif

@if ($differentiator)
    <div class="w-full relative sky-service-differentiator border-1 border-secondary rounded-4 p-25 bg-accent">
        <h3 class="ld-fh-element relative mb-1em text-18">{{ __('site.services_differentiator_title') }}</h3>
        <div class="prose prose-sm max-w-none text-black-70 mb-0">
            {!! $differentiator !!}
        </div>
    </div>
@endif
