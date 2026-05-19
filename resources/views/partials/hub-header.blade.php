@php
    $sky = config('sky');
    $logoMark = public_path('assets/img/logo.png');
    $logoText = public_path('assets/img/logo_text.png');
    $logoMarkUrl = file_exists($logoMark) ? asset('assets/img/logo.png') : asset('hub/assets/images/demo/company/logo.svg');
    $logoTextUrl = file_exists($logoText) ? asset('assets/img/logo_text.png') : asset('hub/assets/images/demo/company/hub-svg-logo.svg');
    $homeUrl = route('home');

    $route = Route::current();
    $routeName = Route::currentRouteName();
    $routeParams = ($routeName && $route) ? $route->parameters() : [];
    $switchUrl = static fn (string $loc): string => $routeName
        ? route($routeName, array_merge($routeParams, ['locale' => $loc]))
        : url('/'.$loc);

    $currentLocale = app()->getLocale();
    $localeLabel = $currentLocale === 'en' ? '🇺🇸 English' : '🇫🇷 Français';
    $otherLocale = $currentLocale === 'en' ? 'fr' : 'en';
    $otherLabel = $currentLocale === 'en' ? '🇫🇷 Français' : '🇺🇸 English';

    $itemClass = static fn (bool $current): string => $current
        ? 'inline-flex flex-col relative w-auto is-active'
        : 'inline-flex flex-col relative w-auto';
@endphp

<header id="site-header" class="main-header main-header-overlay sticky-header-noshadow" data-sticky-header="true">
    <section class="lqd-section sky-hide-topbar-mobile lqd-hide-onstuck w-full flex flex-wrap items-center justify-between border-bottom border-white-10 transition-all px-2percent md:hidden">
        <div class="w-50percent flex items-center justify-start py-10">
            <div class="flex flex-row text-white">
                <div class="iconbox items-center mb-0">
                    <div class="iconbox-icon-wrap mr-10">
                        <span class="iconbox-icon-container grow">
                            <svg class="w-1em leading-0 text-white text-13" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" aria-hidden="true">
                                <path d="M64 208.1L256 65.9 448 208.1v47.4L289.5 373c-9.7 7.2-21.4 11-33.5 11s-23.8-3.9-33.5-11L64 255.5V208.1zM256 0c-12.1 0-23.8 3.9-33.5 11L25.9 156.7C9.6 168.8 0 187.8 0 208.1V448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V208.1c0-20.3-9.6-39.4-25.9-51.4L289.5 11C279.8 3.9 268.1 0 256 0z" />
                            </svg>
                        </span>
                    </div>
                    <h3 class="m-0 text-13 font-normal text-white iconbox-heading">
                        <a class="text-white hover:text-primary" href="mailto:{{ $sky['email'] }}">{{ $sky['email'] }}</a>
                    </h3>
                </div>
                <div class="iconbox items-center mb-0 ml-20 pl-25 border-left border-white-10">
                    <div class="iconbox-icon-wrap mr-10">
                        <span class="iconbox-icon-container grow">
                            <svg class="w-1em leading-0 text-white text-13" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" aria-hidden="true">
                                <path d="M565.6 36.24C572.1 40.72 576 48.11 576 56V392C576 401.1 569.8 410.9 560.5 414.4L392.5 478.4C387.4 480.4 381.7 480.5 376.4 478.8L192.5 417.5L32.54 478.4C25.17 481.2 16.88 480.2 10.38 475.8C3.882 471.3 0 463.9 0 456V120C0 110 6.15 101.1 15.46 97.57L183.5 33.57C188.6 31.6 194.3 31.48 199.6 33.23L383.5 94.52L543.5 33.57C550.8 30.76 559.1 31.76 565.6 36.24H565.6zM48 421.2L168 375.5V90.83L48 136.5V421.2zM360 137.3L216 89.3V374.7L360 422.7V137.3zM408 421.2L528 375.5V90.83L408 136.5V421.2z" />
                            </svg>
                        </span>
                    </div>
                    <h3 class="iconbox-heading m-0 text-13 font-normal text-white">{{ \Illuminate\Support\Str::limit($sky['address'], 42) }}</h3>
                </div>
            </div>
        </div>
        <div class="w-50percent flex items-center justify-end py-10 link-white link-font-normal link-14">
            <a href="{{ $homeUrl }}#consultation" class="btn btn-naked leading-16" data-localscroll="true">
                <span class="btn-txt" data-text="{{ app()->getLocale() === 'en' ? 'Consultation' : 'Consultation' }}">{{ app()->getLocale() === 'en' ? 'Consultation' : 'Consultation' }}</span>
            </a>
            <div class="pl-20 ml-20 border-left text-white-10">
                <a href="{{ $homeUrl }}#contact" class="btn btn-naked leading-16" data-localscroll="true">
                    <span class="btn-txt" data-text="{{ app()->getLocale() === 'en' ? 'Contact us' : 'Contactez-nous' }}">{{ app()->getLocale() === 'en' ? 'Contact us' : 'Contactez-nous' }}</span>
                </a>
            </div>
            <div class="ld-dropdown-menu link-black flex relative pl-20 ml-20 border-left border-white-10" role="menubar">
                <span class="ld-module-trigger text-14 transition-color collapsed" role="button" data-ld-toggle="true" data-bs-toggle="collapse" data-bs-target="#dropdown-minimenu" aria-controls="dropdown-minimenu" aria-expanded="false" data-bs-toggle-options='{ "type": "hoverFade" }'>
                    <span class="ld-module-trigger-txt text-white">{{ $localeLabel }} <i class="lqd-icn-ess icon-ion-ios-arrow-down"></i></span>
                </span>
                <div class="ld-module-dropdown collapse absolute right lqd-dropdown-fade-onhover" id="dropdown-minimenu" aria-expanded="false" role="menuitem">
                    <div class="ld-dropdown-menu-content">
                        <ul id="menu-footer-nav-3">
                            <li>
                                <a href="{{ $switchUrl($currentLocale) }}">{{ $localeLabel }}</a>
                            </li>
                            <li>
                                <a href="{{ $switchUrl($otherLocale) }}">{{ $otherLabel }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="pl-20 ml-20 border-left border-white-10 ld-module-search lqd-module-search-slide-top items-center" data-module-style="lqd-search-style-slide-top">
                <span class="ld-module-trigger collapsed lqd-module-trigger-txt-left lqd-module-show-icon lqd-module-icon-plain text-14" role="button" data-ld-toggle="true" data-bs-toggle="collapse" data-bs-target="#search-header-top" aria-controls="search-header-top" aria-expanded="false">
                    <span class="ld-module-trigger-txt"></span>
                    <span class="ld-module-trigger-icon text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="1em" viewBox="0 0 512 512" aria-hidden="true"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                    </span>
                </span>
                <div class="ld-module-dropdown flex w-full flex-col fixed overflow-hidden backface-hidden" id="search-header-top" role="searchbox">
                    <div class="ld-search-form-container flex flex-col justify-center h-full mx-auto backface-hidden">
                        <form role="search" method="get" action="{{ route('search', ['locale' => app()->getLocale()]) }}" class="ld-search-form w-full" data-sky-search-form>
                            <input class="w-full" type="search" placeholder="{{ __('site.search_placeholder') }}" value="" name="q" data-sky-search-input autocomplete="off">
                            <span class="input-icon inline-flex items-center justify-center absolute collapsed" data-ld-toggle="true" data-bs-toggle="collapse" data-bs-target="#search-header-top" aria-controls="search-header-top" aria-expanded="false" role="search">
                                <i class="lqd-icn-ess icon-ld-search"></i>
                            </span>
                        </form>
                        <p class="lqd-module-search-info">{{ __('site.search_hint') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lqd-section w-full flex flex-wrap items-center justify-between px-2percent module-header md:hidden">
        <div class="w-15percent flex items-center justify-start sky-hub-header-logo">
            <a class="navbar-brand flex relative py-15" href="{{ route('home') }}" rel="home">
                <span class="navbar-brand-inner post-rel">
                    <img class="logo-sticky" src="{{ $logoTextUrl }}" alt="{{ config('app.name') }}" width="190" height="52">
                    <img class="logo-default" src="{{ $logoMarkUrl }}" alt="{{ config('app.name') }}" width="74" height="74">
                </span>
            </a>
        </div>

        <div class="w-85percent flex items-stretch justify-end">
            <div class="module-primary-nav flex">
                <div class="navbar-collapse lqd-submenu-default-style inline-flex h-auto p-0" id="main-header-collapse" aria-expanded="false" role="navigation">
                    <ul class="main-nav flex reset-ul inline-ul lqd-menu-counter-right lqd-menu-items-inline main-nav-hover-fade-inactive lqd-submenu-toggle-hover link-14 link-bold" data-submenu-options='{"toggleType": "fade", "handler": "mouse-in-out"}' data-localscroll="true" data-localscroll-options='{"itemsSelector":"> li > a", "trackWindowScroll": true}'>
                        <li class="{{ $itemClass(request()->routeIs('home')) }}">
                            <a class="text-white hover:text-primary" href="{{ $homeUrl }}#banner">{{ __('site.nav_home') }}<sup class="link-sup">01</sup></a>
                        </li>
                        <li class="{{ $itemClass(request()->routeIs('about')) }}">
                            <a class="text-white hover:text-primary" href="{{ route('about') }}">{{ __('site.nav_about') }}<sup class="link-sup">02</sup></a>
                        </li>
                        <li class="{{ $itemClass(request()->routeIs('services')) }}">
                            <a class="text-white hover:text-primary" href="{{ route('services') }}">{{ __('site.nav_services') }}<sup class="link-sup">03</sup></a>
                        </li>
                        <li class="menu-item-has-children inline-flex flex-col relative w-auto {{ request()->routeIs('team', 'realisations') ? 'is-active' : '' }}">
                            <a class="text-white hover:text-primary" href="#wrap">
                                <span>{{ __('site.nav_team_menu') }}</span>
                                <span class="submenu-expander">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="32" viewBox="0 0 21 32" style="width: 1em; height: 1em;" aria-hidden="true">
                                        <path fill="currentColor" d="M10.5 18.375l7.938-7.938c.562-.562 1.562-.562 2.125 0s.562 1.563 0 2.126l-9 9c-.563.562-1.5.625-2.063.062L.437 12.562C.126 12.25 0 11.876 0 11.5s.125-.75.438-1.063c.562-.562 1.562-.562 2.124 0z"></path>
                                    </svg>
                                </span>
                                <sup class="link-sup">04</sup>
                            </a>
                            <ul class="nav-item-children">
                                <li><a href="{{ route('team') }}">{{ __('site.nav_team') }}</a></li>
                                <li><a href="{{ route('realisations') }}">{{ __('site.nav_realisations') }}</a></li>
                            </ul>
                        </li>
                        <li class="{{ $itemClass(request()->routeIs('careers', 'careers.show')) }}">
                            <a class="text-white hover:text-primary" href="{{ route('careers') }}">{{ __('site.nav_careers') }}<sup class="link-sup">05</sup></a>
                        </li>
                        <li class="{{ $itemClass(request()->routeIs('contact')) }}">
                            <a class="text-white hover:text-primary" href="{{ route('contact') }}">{{ __('site.nav_contact') }}<sup class="link-sup">06</sup></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ml-20 text-end hidden lg:block">
                <h6 class="mt-1em text-white">
                    <span class="text-13 text-inherit">{{ app()->getLocale() === 'en' ? 'Call us now' : 'Appelez-nous' }}</span>
                    <br>
                    <span class="text-primary text-16"><a href="tel:{{ $sky['phone_href'] }}" class="text-primary hover:text-white">{{ $sky['phone'] }}</a></span>
                </h6>
            </div>
        </div>
    </section>

    <div class="lqd-mobile-sec relative w-full">
        <div class="lqd-mobile-sec-inner navbar-header flex items-stretch w-full">
            <div class="lqd-mobile-modules-container empty"></div>
            <button type="button" class="navbar-toggle nav-trigger style-mobile collapsed flex relative items-center justify-end border-none p-0 bg-transparent" data-ld-toggle="true" data-bs-toggle="collapse" data-bs-target="#lqd-mobile-sec-nav" aria-expanded="false" data-bs-toggle-options='{ "changeClassnames": {"html":"mobile-nav-activated"} }'>
                <span class="sr-only">Menu</span>
                <span class="bars inline-block relative z-1">
                    <span class="bars-inner flex flex-col w-full h-full">
                        <span class="bar inline-block"></span>
                        <span class="bar inline-block"></span>
                        <span class="bar inline-block"></span>
                    </span>
                </span>
            </button>
            <a class="navbar-brand flex relative" href="{{ route('home') }}">
                <span class="navbar-brand-inner">
                    <img class="logo-default" src="{{ $logoTextUrl }}" alt="{{ config('app.name') }}" width="160" height="42">
                </span>
            </a>
        </div>
        <div class="lqd-mobile-sec-nav w-full absolute z-10 bg-white text-black">
            <div class="mobile-navbar-collapse navbar-collapse collapse w-full" id="lqd-mobile-sec-nav" aria-expanded="false" role="navigation">
                <ul id="mobile-primary-nav" class="reset-ul lqd-mobile-main-nav main-nav nav">
                    <li class="{{ request()->routeIs('home') ? 'is-active' : '' }}"><a href="{{ route('home') }}">{{ __('site.nav_home') }}</a></li>
                    <li class="{{ request()->routeIs('about') ? 'is-active' : '' }}"><a href="{{ route('about') }}">{{ __('site.nav_about') }}</a></li>
                    <li class="{{ request()->routeIs('services') ? 'is-active' : '' }}"><a href="{{ route('services') }}">{{ __('site.nav_services') }}</a></li>
                    <li class="{{ request()->routeIs('team') ? 'is-active' : '' }}"><a href="{{ route('team') }}">{{ __('site.nav_team') }}</a></li>
                    <li class="{{ request()->routeIs('realisations') ? 'is-active' : '' }}"><a href="{{ route('realisations') }}">{{ __('site.nav_realisations') }}</a></li>
                    <li class="{{ request()->routeIs('careers', 'careers.show') ? 'is-active' : '' }}"><a href="{{ route('careers') }}">{{ __('site.nav_careers') }}</a></li>
                    <li class="{{ request()->routeIs('contact') ? 'is-active' : '' }}"><a href="{{ route('contact') }}">{{ __('site.nav_contact') }}</a></li>
                </ul>
                <div class="py-25 px-20">
                    @include('partials.lang-switch', ['class' => 'sky-lang-switch sky-lang-switch--hub justify-content-center border-0 text-black'])
                </div>
            </div>
        </div>
    </div>
</header>
