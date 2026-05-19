<div id="sky-career-toast" class="sky-career-toast" role="status" aria-live="polite" aria-atomic="true" hidden>
    <div class="sky-career-toast__inner">
        <span class="sky-career-toast__icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
        </span>
        <div class="sky-career-toast__content">
            <p class="sky-career-toast__title">{{ __('site.career_toast_title') }}</p>
            <p class="sky-career-toast__text">{{ __('site.career_toast_body') }}</p>
        </div>
        <button type="button" class="sky-career-toast__close" data-sky-career-toast-close aria-label="{{ app()->getLocale() === 'en' ? 'Close' : 'Fermer' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
    </div>
</div>
