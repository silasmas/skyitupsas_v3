<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>@yield('title', config('app.name'))</title>

{!! \Artesaos\SEOTools\Facades\SEOMeta::generate() !!}
{!! \Artesaos\SEOTools\Facades\OpenGraph::generate() !!}
{!! \Artesaos\SEOTools\Facades\TwitterCard::generate() !!}

@include('partials.hub-head')
@stack('head')
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
</head>

<body class="lqd-preloader-style-fade lqd-sticky-footer-shadow-2 lqd-search-style-slide-top @yield('hub_body_class')" data-localscroll-offset="72" data-mobile-nav-breakpoint="1199" data-mobile-nav-style="classic" data-mobile-nav-scheme="light" data-mobile-nav-trigger-alignment="right" data-mobile-header-scheme="gray" data-mobile-logo-alignment="default" data-overlay-onmobile="false">
<div class="bg-white" id="wrap">

    <div class="lqd-sticky-placeholder hidden"></div>

    @include('partials.hub-header')

    <main class="content bg-white bg-repeat" id="lqd-site-content" style="background-image: url({{ asset('hub/assets/images/demo/company/bg-lines.svg') }});">
        <div id="lqd-contents-wrap">
            @hasSection('before_content')
                @yield('before_content')
            @endif
            @yield('content')
        </div>
    </main>

    <div class="lqd-back-to-top fixed" data-back-to-top="true">
        <a href="#wrap" class="inline-flex items-center justify-center rounded-full relative overflow-hidden" data-localscroll="true">
            <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" width="21" height="32" viewbox="0 0 21 32" style="width: 1em; height: 1em;" aria-hidden="true">
                <path fill="white" d="M10.5 13.625l-7.938 7.938c-.562.562-1.562.562-2.124 0C.124 21.25 0 20.875 0 20.5s.125-.75.438-1.063L9.5 10.376c.563-.563 1.5-.5 2.063.063l9 9c.562.562.562 1.562 0 2.125s-1.563.562-2.125 0z"></path>
            </svg>
        </a>
    </div>

    @include('partials.hub-footer')

</div>

@stack('modals')

@include('partials.site-toast')
@include('partials.site-scripts')

@include('partials.hub-scripts')
@stack('scripts')
</body>
</html>
