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
        'menuServices' => __('tour.menuServices'),
        'menuServicesText' => __('tour.menuServicesText'),
        'menuBlog' => __('tour.menuBlog'),
        'menuBlogText' => __('tour.menuBlogText'),
        'menuRealisations' => __('tour.menuRealisations'),
        'menuRealisationsText' => __('tour.menuRealisationsText'),
        'menuContacts' => __('tour.menuContacts'),
        'menuContactsText' => __('tour.menuContactsText'),
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
    ];
@endphp
<script src="https://cdn.jsdelivr.net/npm/shepherd.js@11/dist/js/shepherd.min.js"></script>
<script>
(function() {
    var t = @json($t);
    function initTour() {
        if (typeof Shepherd === 'undefined') return;

        window.startFilamentTour = function() {
            if (window._filamentTour) {
                try { window._filamentTour.cancel(); } catch (e) {}
            }

            var tour = new Shepherd.Tour({
                useModalOverlay: true,
                defaultStepOptions: {
                    cancelIcon: { enabled: true },
                    scrollTo: { behavior: 'smooth', block: 'center' },
                    classes: 'shadow-lg'
                }
            });

            var sidebar = document.querySelector('.fi-sidebar-nav');
            var globalSearch = document.querySelector('.fi-topbar-actions') || document.querySelector('.fi-global-search-field');
            var userMenu = document.querySelector('.fi-user-menu-trigger');

            tour.addStep({
                id: 'welcome',
                title: t.welcome,
                text: t.welcomeText,
                buttons: [
                    { text: t.next, action: function() { tour.next(); } }
                ]
            });

            if (sidebar) {
                tour.addStep({
                    id: 'sidebar',
                    title: t.sidebar,
                    text: t.sidebarText,
                    attachTo: { element: sidebar, on: 'right' },
                    buttons: [
                        { text: t.prev, action: function() { tour.back(); }, secondary: true },
                        { text: t.next, action: function() { tour.next(); } }
                    ]
                });
            }

            var menuItems = [
                { sel: 'a[href*="team-members"]', title: t.menuTeam, text: t.menuTeamText },
                { sel: 'a[href*="abouts"]', title: t.menuAbout, text: t.menuAboutText },
                { sel: 'a[href*="services"]', title: t.menuServices, text: t.menuServicesText },
                { sel: 'a[href*="blogs"]', title: t.menuBlog, text: t.menuBlogText },
                { sel: 'a[href*="realisations"]', title: t.menuRealisations, text: t.menuRealisationsText },
                { sel: 'a[href*="contacts"]', title: t.menuContacts, text: t.menuContactsText },
                { sel: 'a[href*="/users"]', title: t.menuUsers, text: t.menuUsersText },
                { sel: 'a[href*="roles"]', title: t.menuShield, text: t.menuShieldText }
            ];

            menuItems.forEach(function(item, idx) {
                var el = document.querySelector('.fi-main-sidebar ' + item.sel);
                if (el) {
                    tour.addStep({
                        id: 'menu-' + idx,
                        title: item.title,
                        text: item.text,
                        attachTo: { element: el, on: 'right' },
                        buttons: [
                            { text: t.prev, action: function() { tour.back(); }, secondary: true },
                            { text: t.next, action: function() { tour.next(); } }
                        ]
                    });
                }
            });

            if (globalSearch) {
                tour.addStep({
                    id: 'search',
                    title: t.search,
                    text: t.searchText,
                    attachTo: { element: globalSearch, on: 'bottom' },
                    buttons: [
                        { text: t.prev, action: function() { tour.back(); }, secondary: true },
                        { text: t.next, action: function() { tour.next(); } }
                    ]
                });
            }

            if (userMenu) {
                tour.addStep({
                    id: 'profile',
                    title: t.profile,
                    text: t.profileText,
                    attachTo: { element: userMenu, on: 'bottom' },
                    buttons: [
                        { text: t.prev, action: function() { tour.back(); }, secondary: true },
                        { text: t.next, action: function() { tour.next(); } }
                    ]
                });
            }

            tour.addStep({
                id: 'fin',
                title: t.fin,
                text: t.finText,
                buttons: [
                    { text: t.prev, action: function() { tour.back(); }, secondary: true },
                    { text: t.finish, action: function() { tour.complete(); } }
                ]
            });

            window._filamentTour = tour;
            tour.start();
        };
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTour);
    } else {
        initTour();
    }
    document.addEventListener('livewire:navigated', initTour);
})();
</script>
