import './bootstrap';

document.querySelectorAll('[data-mobile-nav-toggle]').forEach((btn) => {
    btn.addEventListener('click', () => {
        const panel = document.querySelector('[data-mobile-nav-panel]');
        if (!panel) {
            return;
        }
        const open = panel.classList.toggle('hidden') === false;
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
});
