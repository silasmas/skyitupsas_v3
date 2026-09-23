@php
    $t = [
        'welcome' => __('tour.welcome'),
        'welcomeText' => __('tour.welcomeText'),
        'next' => __('tour.next'),
        'prev' => __('tour.prev'),
        'finish' => __('tour.finish'),
        'sidebar' => __('tour.sidebar'),
        'sidebarText' => __('tour.sidebarText'),
        'menuTeam' => __('tour.menuTeam'),
        'menuTeamText' => __('tour.menuTeamText'),
        'menuAbout' => __('tour.menuAbout'),
        'menuAboutText' => __('tour.menuAboutText'),
        'menuPillars' => __('tour.menuPillars'),
        'menuPillarsText' => __('tour.menuPillarsText'),
        'menuModules' => __('tour.menuModules'),
        'menuModulesText' => __('tour.menuModulesText'),
        'menuBlog' => __('tour.menuBlog'),
        'menuBlogText' => __('tour.menuBlogText'),
        'menuRealisations' => __('tour.menuRealisations'),
        'menuRealisationsText' => __('tour.menuRealisationsText'),
        'menuPartners' => __('tour.menuPartners'),
        'menuPartnersText' => __('tour.menuPartnersText'),
        'menuContacts' => __('tour.menuContacts'),
        'menuContactsText' => __('tour.menuContactsText'),
        'menuContactMessages' => __('tour.menuContactMessages'),
        'menuContactMessagesText' => __('tour.menuContactMessagesText'),
        'menuJobs' => __('tour.menuJobs'),
        'menuJobsText' => __('tour.menuJobsText'),
        'menuUsers' => __('tour.menuUsers'),
        'menuUsersText' => __('tour.menuUsersText'),
        'menuShield' => __('tour.menuShield'),
        'menuShieldText' => __('tour.menuShieldText'),
        'search' => __('tour.search'),
        'searchText' => __('tour.searchText'),
        'profile' => __('tour.profile'),
        'profileText' => __('tour.profileText'),
        'fin' => __('tour.fin'),
        'finText' => __('tour.finText'),
        'loadError' => __('tour.loadError'),
    ];
@endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/shepherd.js@11.2.0/dist/css/shepherd.css" />
<script src="https://cdn.jsdelivr.net/npm/shepherd.js@11.2.0/dist/js/shepherd.min.js"></script>
<style>
    /* Au-dessus de la topbar / sidebar Filament */
    .shepherd-modal-overlay-container,
    .shepherd-element {
        z-index: 100000 !important;
    }
    .shepherd-button {
        background: #f59e0b !important;
        border: none !important;
        color: #111 !important;
    }
    .shepherd-button.shepherd-button-secondary {
        background: #e5e7eb !important;
        color: #111 !important;
    }
</style>
<script>
(function () {
    var t = @json($t);
    var shepherdReady = false;

    /**
     * Ouvre la sidebar Filament et déplie les groupes pour rendre les liens visibles.
     */
    function prepareNavigation() {
        try {
            if (window.Alpine && Alpine.store('sidebar')) {
                Alpine.store('sidebar').isOpen = true;
            }
        } catch (e) {}

        document.querySelectorAll('.fi-sidebar-group').forEach(function (group) {
            var items = group.querySelector('.fi-sidebar-group-items');
            if (!items) {
                return;
            }
            var hidden =
                items.hasAttribute('x-cloak') ||
                getComputedStyle(items).display === 'none' ||
                items.offsetHeight === 0;
            if (!hidden) {
                return;
            }
            var btn =
                group.querySelector('button.fi-sidebar-group-button') ||
                group.querySelector('.fi-sidebar-group-collapse-button');
            if (btn) {
                btn.click();
            }
        });
    }

    /**
     * Résout un élément de menu dans la sidebar Filament (v3 = .fi-sidebar).
     *
     * @param {string} selector Sélecteur CSS relatif
     * @returns {Element|null}
     */
    function findNavItem(selector) {
        return (
            document.querySelector('.fi-sidebar ' + selector) ||
            document.querySelector('.fi-main-sidebar ' + selector) ||
            document.querySelector(selector)
        );
    }

    /**
     * Charge Shepherd si le CDN defer n'a pas encore fini.
     *
     * @param {Function} done Callback une fois prêt
     */
    function whenShepherdReady(done) {
        if (typeof Shepherd !== 'undefined') {
            done();
            return;
        }

        var waited = 0;
        var timer = setInterval(function () {
            waited += 100;
            if (typeof Shepherd !== 'undefined') {
                clearInterval(timer);
                done();
            } else if (waited >= 5000) {
                clearInterval(timer);
                window.alert(t.loadError || 'Impossible de charger le tutoriel.');
            }
        }, 100);
    }

    /**
     * Initialise la fonction globale startFilamentTour.
     */
    function initTour() {
        if (shepherdReady) {
            return;
        }
        shepherdReady = true;

        window.startFilamentTour = function () {
            whenShepherdReady(function () {
                if (window._filamentTour) {
                    try {
                        window._filamentTour.cancel();
                    } catch (e) {}
                }

                prepareNavigation();

                var tour = new Shepherd.Tour({
                    useModalOverlay: true,
                    defaultStepOptions: {
                        cancelIcon: { enabled: true },
                        scrollTo: { behavior: 'smooth', block: 'center' },
                        classes: 'shadow-lg shepherd-theme-arrows',
                        modalOverlayOpeningPadding: 4,
                        modalOverlayOpeningRadius: 8,
                    },
                });

                var sidebar =
                    document.querySelector('.fi-sidebar-nav') ||
                    document.querySelector('.fi-sidebar');
                var globalSearch =
                    document.querySelector('.fi-global-search-field') ||
                    document.querySelector('.fi-topbar-item-button') ||
                    document.querySelector('.fi-topbar-actions');
                var userMenu =
                    document.querySelector('.fi-user-menu-trigger') ||
                    document.querySelector('button[aria-label*="user" i]') ||
                    document.querySelector('.fi-avatar');

                tour.addStep({
                    id: 'welcome',
                    title: t.welcome,
                    text: t.welcomeText,
                    buttons: [{ text: t.next, action: function () { tour.next(); } }],
                });

                if (sidebar) {
                    tour.addStep({
                        id: 'sidebar',
                        title: t.sidebar,
                        text: t.sidebarText,
                        attachTo: { element: sidebar, on: 'right' },
                        buttons: [
                            { text: t.prev, action: function () { tour.back(); }, secondary: true },
                            { text: t.next, action: function () { tour.next(); } },
                        ],
                    });
                }

                var menuItems = [
                    { sel: 'a[href*="team-members"]', title: t.menuTeam, text: t.menuTeamText },
                    { sel: 'a[href*="abouts"]', title: t.menuAbout, text: t.menuAboutText },
                    { sel: 'a[href*="service-pillars"]', title: t.menuPillars, text: t.menuPillarsText },
                    { sel: 'a[href*="service-modules"]', title: t.menuModules, text: t.menuModulesText },
                    { sel: 'a[href*="blogs"]', title: t.menuBlog, text: t.menuBlogText },
                    { sel: 'a[href*="realisations"]', title: t.menuRealisations, text: t.menuRealisationsText },
                    { sel: 'a[href*="partners"]', title: t.menuPartners, text: t.menuPartnersText },
                    { sel: 'a[href*="/contacts"]', title: t.menuContacts, text: t.menuContactsText },
                    { sel: 'a[href*="contact-messages"]', title: t.menuContactMessages, text: t.menuContactMessagesText },
                    { sel: 'a[href*="job-offers"]', title: t.menuJobs, text: t.menuJobsText },
                    { sel: 'a[href*="/users"]', title: t.menuUsers, text: t.menuUsersText },
                    { sel: 'a[href*="roles"]', title: t.menuShield, text: t.menuShieldText },
                ];

                menuItems.forEach(function (item, idx) {
                    var el = findNavItem(item.sel);
                    if (!el) {
                        return;
                    }
                    tour.addStep({
                        id: 'menu-' + idx,
                        title: item.title,
                        text: item.text,
                        attachTo: { element: el, on: 'right' },
                        buttons: [
                            { text: t.prev, action: function () { tour.back(); }, secondary: true },
                            { text: t.next, action: function () { tour.next(); } },
                        ],
                    });
                });

                if (globalSearch) {
                    tour.addStep({
                        id: 'search',
                        title: t.search,
                        text: t.searchText,
                        attachTo: { element: globalSearch, on: 'bottom' },
                        buttons: [
                            { text: t.prev, action: function () { tour.back(); }, secondary: true },
                            { text: t.next, action: function () { tour.next(); } },
                        ],
                    });
                }

                if (userMenu) {
                    tour.addStep({
                        id: 'profile',
                        title: t.profile,
                        text: t.profileText,
                        attachTo: { element: userMenu, on: 'bottom' },
                        buttons: [
                            { text: t.prev, action: function () { tour.back(); }, secondary: true },
                            { text: t.next, action: function () { tour.next(); } },
                        ],
                    });
                }

                tour.addStep({
                    id: 'fin',
                    title: t.fin,
                    text: t.finText,
                    buttons: [
                        { text: t.prev, action: function () { tour.back(); }, secondary: true },
                        { text: t.finish, action: function () { tour.complete(); } },
                    ],
                });

                window._filamentTour = tour;
                tour.start();
            });
        };
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTour);
    } else {
        initTour();
    }
    document.addEventListener('livewire:navigated', function () {
        shepherdReady = false;
        initTour();
    });
    document.addEventListener('livewire:init', initTour);
})();
</script>
