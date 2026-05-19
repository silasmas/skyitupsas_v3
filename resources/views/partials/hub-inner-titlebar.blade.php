@php
    $bgSeed = preg_replace('/[^a-zA-Z0-9_-]/', '', $title ?? 'page');
    $titlebarBg = $backgroundImage ?? 'https://picsum.photos/seed/sky-'.$bgSeed.'-title/1920/600';
@endphp

<section class="titlebar scheme-light text-center bg-cover bg-center z-3 text-white border-bottom border-black-10 relative" style="min-height: 14rem; background-image: url('{{ $titlebarBg }}');">
    <div class="titlebar-overlay lqd-overlay sky-titlebar-overlay"></div>

    <div class="titlebar-inner text-inherit pt-140 pb-80 relative z-2" id="titlebar">
        <div class="container titlebar-container">
            <div class="row titlebar-container flex flex-wrap items-center justify-center">
                <div class="titlebar-col col-12 col-lg-8 col-xl-6 px-15">
                    <h1 class="mt-0 mb-15">{{ $title }}</h1>
                    @if (! empty($subtitle))
                        <p class="mb-25 text-white-70">{{ $subtitle }}</p>
                    @endif

                    <nav class="hub-breadcrumb mb-25" aria-label="Breadcrumb">
                        <ul class="reset-ul inline-ul text-13 flex flex-wrap items-center justify-center gap-15 text-white-70 mb-30">
                            <li><a class="hover:text-white" href="{{ route('home') }}">{{ __('site.breadcrumb_home') }}</a></li>
                            @foreach ($crumbs ?? [] as $crumb)
                                <li aria-hidden="true">/</li>
                                <li><span class="text-white">{{ $crumb }}</span></li>
                            @endforeach
                        </ul>
                    </nav>

                    <a class="titlebar-scroll-link inline-flex text-white hover:text-primary" href="#lqd-site-content" data-localscroll="true">
                        <i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
