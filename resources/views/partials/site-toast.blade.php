@php
    $toastType = session('site_toast_type', 'contact');
    $toastTitle = $toastType === 'newsletter'
        ? __('site.newsletter_toast_title')
        : __('site.contact_toast_title');
    $toastBody = $toastType === 'newsletter'
        ? __('site.newsletter_toast_body')
        : __('site.contact_toast_body');
@endphp
<div id="sky-site-toast" class="sky-site-toast" role="status" aria-live="polite" aria-atomic="true" hidden>
    <div class="sky-site-toast__inner">
        <span class="sky-site-toast__icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
        </span>
        <div class="sky-site-toast__content">
            <p class="sky-site-toast__title" data-sky-site-toast-title>{{ $toastTitle }}</p>
            <p class="sky-site-toast__text" data-sky-site-toast-text>{{ $toastBody }}</p>
        </div>
        <button type="button" class="sky-site-toast__close" data-sky-site-toast-close aria-label="{{ app()->getLocale() === 'en' ? 'Close' : 'Fermer' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
    </div>
</div>
