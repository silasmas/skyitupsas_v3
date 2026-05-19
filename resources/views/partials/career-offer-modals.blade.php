@php
    $contractLabels = $contractLabels ?? [
        'cdi' => 'CDI',
        'cdd' => 'CDD',
        'stage' => app()->getLocale() === 'en' ? 'Internship' : 'Stage',
        'mission' => app()->getLocale() === 'en' ? 'Contract / assignment' : 'Mission / prestation',
        'freelance' => 'Freelance',
    ];
    $locale = app()->getLocale();
    $applyQuerySlug = request()->query('apply');
@endphp

@foreach ($offers as $offer)
    @php
        $title = $offer->getTranslation('title', $locale);
        $description = $offer->getTranslation('description', $locale, false);
        $requirements = $offer->getTranslation('requirements', $locale, false);
        $descPlain = trim(strip_tags((string) $description));
        $reqPlain = trim(strip_tags((string) $requirements));
        $hasDetails = $descPlain !== '' || $reqPlain !== '';
        $accepting = $offer->isOpenForApplications();
        $showSuccess = session('career_success') && session('career_applied_slug') === $offer->slug;
        $showErrors = $errors->any() && $applyQuerySlug === $offer->slug;
    @endphp

    {{-- Panneau détail --}}
    <div id="career-detail-{{ $offer->slug }}" class="sky-career-panel sky-career-panel--detail" data-offer-slug="{{ $offer->slug }}">
        <div class="sky-career-modal__shell">
            <header class="sky-career-modal__hero">
                <p class="sky-career-modal__kicker">{{ __('site.page_careers_apply_kicker') }}</p>
                <h2 class="sky-career-modal__title">{{ $title }}</h2>
                @include('partials.career-offer-meta', ['offer' => $offer, 'contractLabels' => $contractLabels])
            </header>
            <div class="sky-career-modal__body">
                @if ($hasDetails)
                    @if ($descPlain !== '')
                        <div class="sky-career-modal__prose">
                            {!! $description !!}
                        </div>
                    @endif
                    @if ($reqPlain !== '')
                        <h3 class="sky-career-modal__section-title">{{ $locale === 'en' ? 'Requirements' : 'Profil recherché' }}</h3>
                        <div class="sky-career-modal__prose">
                            {!! $requirements !!}
                        </div>
                    @endif
                @else
                    <div class="sky-career-empty-state" role="status">
                        <div class="sky-career-empty-state__icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                        </div>
                        <p class="sky-career-empty-state__title">{{ __('site.career_no_details_title') }}</p>
                        <p class="sky-career-empty-state__text">{{ __('site.career_no_details_body') }}</p>
                    </div>
                @endif
            </div>
            @if ($accepting)
                <footer class="sky-career-modal__footer">
                    <button
                        type="button"
                        class="btn btn-solid btn-md font-bold text-secondary bg-primary rounded-4 hover:bg-secondary hover:text-white"
                        data-sky-career-open="apply"
                        data-sky-career-slug="{{ $offer->slug }}"
                    >{{ __('site.career_apply_now') }}</button>
                </footer>
            @endif
        </div>
    </div>

    {{-- Panneau candidature (personnalisé par offre) --}}
    <div id="career-apply-{{ $offer->slug }}" class="sky-career-panel sky-career-panel--apply" data-offer-slug="{{ $offer->slug }}">
        <div class="sky-career-modal__shell sky-career-modal__shell--apply">
            <header class="sky-career-modal__hero sky-career-modal__hero--compact">
                <p class="sky-career-modal__kicker">{{ __('site.career_form_kicker') }}</p>
                <h2 class="sky-career-modal__title">{{ $title }}</h2>
                @include('partials.career-offer-meta', ['offer' => $offer, 'contractLabels' => $contractLabels])
            </header>
            <div class="sky-career-modal__body sky-career-modal__body--form">
                @if ($showSuccess)
                    <div class="sky-career-feedback sky-career-feedback--success" role="status">
                        <div class="sky-career-feedback__icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
                        </div>
                        <p class="sky-career-feedback__title">{{ __('site.career_form_success') }}</p>
                        <p class="sky-career-feedback__text">{{ __('site.career_form_success_hint') }}</p>
                        <p class="sky-career-feedback__text mt-10">{{ __('site.career_toast_body') }}</p>
                    </div>
                @elseif (! $accepting)
                    <div class="sky-career-feedback sky-career-feedback--muted" role="status">
                        <p class="sky-career-feedback__text m-0">{{ __('site.career_form_closed') }}</p>
                    </div>
                @else
                    <form
                        method="post"
                        action="{{ route('careers.apply', ['locale' => app()->getLocale(), 'jobOffer' => $offer->slug]) }}"
                        enctype="multipart/form-data"
                        class="sky-career-form"
                        data-sky-career-form
                    >
                        @csrf
                        @include('partials.career-form-fields', ['offer' => $offer])
                    </form>
                @endif
            </div>
        </div>
    </div>
@endforeach
