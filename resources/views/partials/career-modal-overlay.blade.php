{{-- Overlay recrutement (fixe, au-dessus de toute la page). --}}
<div id="sky-career-overlay" class="sky-career-overlay" hidden aria-hidden="true">
    <div class="sky-career-overlay__backdrop" data-sky-career-close tabindex="-1" aria-hidden="true"></div>
    <div class="sky-career-overlay__dialog" role="dialog" aria-modal="true">
        <button type="button" class="sky-career-overlay__close" data-sky-career-close aria-label="{{ app()->getLocale() === 'en' ? 'Close' : 'Fermer' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
        <div id="sky-career-overlay-slot" class="sky-career-overlay__slot"></div>
    </div>
</div>
