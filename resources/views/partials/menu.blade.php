@php
    $logoMark = public_path('assets/img/logo.png');
    $logoText = public_path('assets/img/logo_text.png');
    $logoMarkUrl = file_exists($logoMark) ? asset('assets/img/logo.png') : null;
    $logoTextUrl = file_exists($logoText) ? asset('assets/img/logo_text.png') : null;
    $sky = config('sky');
@endphp

<header class="main-header header-style-one">
    <div class="main-box sky-main-box">
        <div class="logo-box sky-logo-box">
            <div class="logo">
                <a href="{{ route('home') }}" class="sky-logo-link" title="{{ config('app.name') }}">
                    {{-- Wordmark seul si dispo (évite double logo icône + texte) ; sinon pictogramme seul --}}
                    @if ($logoTextUrl)
                        <img src="{{ $logoTextUrl }}" alt="{{ config('app.name') }}" class="sky-logo-wordmark-only" width="220" height="52">
                    @elseif ($logoMarkUrl)
                        <img src="{{ $logoMarkUrl }}" alt="{{ config('app.name') }}" class="sky-logo-mark-only" width="64" height="64">
                    @else
                        <span class="text-white fw-bold">{{ config('app.name') }}</span>
                    @endif
                </a>
            </div>
            <button type="button" class="ui-btn ui-btn search-btn" aria-label="{{ __('site.search_placeholder') }}">
                <span class="icon lnr lnr-icon-search"></span>
            </button>
        </div>

        <div class="nav-outer sky-nav-outer">
            <nav class="nav main-menu">
                <ul class="navigation">
                    <li class="{{ request()->routeIs('home') ? 'current' : '' }}">
                        <a href="{{ route('home') }}">{{ __('site.nav_home') }}</a>
                    </li>
                    <li class="{{ request()->routeIs('about') ? 'current' : '' }}">
                        <a href="{{ route('about') }}">{{ __('site.nav_about') }}</a>
                    </li>
                    <li class="{{ request()->routeIs('services') ? 'current' : '' }}">
                        <a href="{{ route('services') }}">{{ __('site.nav_services') }}</a>
                    </li>
                    <li class="{{ request()->routeIs('realisations') ? 'current' : '' }}">
                        <a href="{{ route('realisations') }}">{{ __('site.nav_realisations') }}</a>
                    </li>
                    <li class="{{ request()->routeIs('contact') ? 'current' : '' }}">
                        <a href="{{ route('contact') }}">{{ __('site.nav_contact') }}</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="outer-box sky-outer-box">
            <a href="tel:{{ $sky['phone_href'] }}" class="info-btn">
                <i class="icon fa fa-phone"></i>
                <strong class="text">{{ $sky['phone'] }}</strong>
            </a>
            @include('partials.lang-switch')
            <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
        </div>
    </div>

    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box">
            <div class="upper-box">
                <div class="nav-logo">
                    <a href="{{ route('home') }}" class="sky-logo-link">
                        @if ($logoTextUrl)
                            <img src="{{ $logoTextUrl }}" alt="{{ config('app.name') }}" class="sky-logo-wordmark-only" width="200" height="48">
                        @elseif ($logoMarkUrl)
                            <img src="{{ $logoMarkUrl }}" alt="{{ config('app.name') }}" class="sky-logo-mark-only" width="56" height="56">
                        @else
                            <span class="text-dark fw-bold">{{ config('app.name') }}</span>
                        @endif
                    </a>
                </div>
                <div class="close-btn"><i class="icon fa fa-times"></i></div>
            </div>

            <ul class="navigation clearfix"></ul>

            <ul class="contact-list-one">
                <li>
                    <div class="contact-info-box">
                        <i class="icon lnr-icon-phone-handset"></i>
                        <span class="title">{{ __('site.mobile_call') }}</span>
                        <a href="tel:{{ $sky['phone_href'] }}">{{ $sky['phone'] }}</a>
                    </div>
                </li>
                <li>
                    <div class="contact-info-box">
                        <span class="icon lnr-icon-envelope1"></span>
                        <span class="title">{{ __('site.mobile_email_label') }}</span>
                        <a href="mailto:{{ $sky['email'] }}">{{ $sky['email'] }}</a>
                    </div>
                </li>
            </ul>

            <div class="px-3 py-3">
                @include('partials.lang-switch', ['class' => 'justify-content-center border-0'])
            </div>

            <ul class="social-links">
                <li><a href="{{ $sky['social']['twitter'] }}" rel="noopener noreferrer" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
                <li><a href="{{ $sky['social']['facebook'] }}" rel="noopener noreferrer" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="{{ $sky['social']['instagram'] }}" rel="noopener noreferrer" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </nav>
    </div>

    <div class="search-popup">
        <span class="search-back-drop"></span>
        <button type="button" class="close-search"><span class="fa fa-times"></span></button>
        <div class="search-inner">
            <form method="get" action="{{ route('home') }}">
                <div class="form-group">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="{{ __('site.search_placeholder') }}">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="sticky-header" style="display: none !important;">
        <div class="auto-container">
            <div class="inner-container">
                <div class="logo">
                    <a href="{{ route('home') }}" class="sky-logo-link" title="{{ config('app.name') }}">
                        @if ($logoTextUrl)
                            <img src="{{ $logoTextUrl }}" alt="{{ config('app.name') }}" class="sky-logo-wordmark-only sky-logo-wordmark--compact" width="180" height="44">
                        @elseif ($logoMarkUrl)
                            <img src="{{ $logoMarkUrl }}" alt="{{ config('app.name') }}" class="sky-logo-mark-only" width="44" height="44">
                        @else
                            <span class="text-dark fw-bold">{{ config('app.name') }}</span>
                        @endif
                    </a>
                </div>
                <div class="nav-outer">
                    <nav class="main-menu">
                        <div class="navbar-collapse show collapse clearfix">
                            <ul class="navigation clearfix"></ul>
                        </div>
                    </nav>
                    @include('partials.lang-switch')
                    <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                </div>
            </div>
        </div>
    </div>
</header>
