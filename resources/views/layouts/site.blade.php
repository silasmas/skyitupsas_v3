<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {!! \Artesaos\SEOTools\Facades\SEOMeta::generate() !!}
        {!! \Artesaos\SEOTools\Facades\OpenGraph::generate() !!}
        {!! \Artesaos\SEOTools\Facades\TwitterCard::generate() !!}

        <title>@yield('title', config('app.name'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            {{-- Évite ViteManifestNotFoundException si assets non compilés : lancez `npm run dev` ou `npm run build` --}}
            <style>
                .hidden { display: none !important; }
                body { font-family: 'Instrument Sans', system-ui, sans-serif; margin: 0; line-height: 1.5; }
            </style>
            <script>
                document.querySelectorAll('[data-mobile-nav-toggle]').forEach((btn) => {
                    btn.addEventListener('click', () => {
                        const panel = document.querySelector('[data-mobile-nav-panel]');
                        if (!panel) return;
                        const open = panel.classList.toggle('hidden') === false;
                        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
                    });
                });
            </script>
        @endif
        @stack('head')
    </head>
    <body class="min-h-screen flex flex-col bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] antialiased">
        @include('partials.menu')

        @include('partials.banner')

        <main class="flex-1 w-full">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
                @yield('content')
            </div>
        </main>

        @include('partials.footer')

        @stack('scripts')
    </body>
</html>
