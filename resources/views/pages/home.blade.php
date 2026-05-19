@extends('layouts.app')

@push('hub-demo-css')
<link rel="stylesheet" href="{{ asset('hub/assets/css/demo/company/company.css') }}">
@endpush

@section('title', config('app.name').' â€” '.(app()->getLocale() === 'en' ? 'Welcome' : 'Bienvenue'))

@section('hub_body_class', 'sky-hub-home')

@section('content')

@php
    $sky = config('sky');
    $skyM = static fn (string $key): string => asset('assets/img/'.config('sky.site_media.'.$key));
    $mapPluginOptions = [
        'style' => 'assassinsCreedIV',
        'address' => (string) ($sky['address'] ?? 'Kinshasa'),
        'marker_style' => 'html',
        'markers' => null,
        'map' => [
            'zoom' => 14,
            'mapTypeId' => 'roadmap',
            'zoomControl' => true,
        ],
    ];
    $mapOptsJson = e(json_encode($mapPluginOptions, JSON_UNESCAPED_UNICODE));
    $gmapKey = trim((string) ($sky['google_maps_api_key'] ?? ''));
@endphp

{{-- DÃ©but Banner (index-company) --}}
<section class="lqd-section banner relative bg-center bg-cover transition-all" id="banner" style="background-image: url('{{ $skyM('banner') }}');">
    <div class="background-overlay transition-all bg-green-100 opacity-100"></div>
    <div class="container">
        <div class="row min-h-100vh items-center">
            <div class="w-55percent flex flex-col lg:w-full">
                <div class="ld-fancy-heading relative mask-text" data-custom-animations="true" data-ca-options='{"animationTarget": ".lqd-split-chars .lqd-chars .split-inner", "duration" : 1000 , "delay" : 40 , "ease": "power4.out", "direction": "random", "initValues": {"opacity" : 0} , "animations": {"opacity" : 1}}'>
                    <h1 class="ld-fh-element mb-0/15em inline-block relative lqd-highlight-custom lqd-highlight-custom-1 lqd-split-chars text-88 text-white leading-0/9em" data-inview="true" data-transition-delay="true" data-delay-options='{"elements": ".lqd-highlight-inner", "delayType": "transition"}' data-split-text="true" data-split-options='{"type": "chars, words"}'>
                        <mark class="lqd-highlight">
                            <span class="lqd-highlight-txt">{{ __('site.home_hub_banner_mark') }}</span>
                            <span class="lqd-highlight-inner bottom-0 left-0">
                                <svg class="lqd-highlight-brush-svg lqd-highlight-brush-svg-1" xmlns="http://www.w3.org/2000/svg" width="235.509" height="13.504" viewBox="0 0 235.509 13.504" aria-hidden="true" preserveAspectRatio="none" fill="#FFCD28">
                                    <path d="M163,.383a13.044,13.044,0,0,1,1.517-.072,3.528,3.528,0,0,1,1.237-.134q.618.044,1.237.044a.249.249,0,0,1-.1.178.337.337,0,0,0-.1.266q3.092.088,6.184-.044T178.953.4l-.206-.088a12,12,0,0,0,4.123,0,13.467,13.467,0,0,1,5.772,0q1.443-.178,2.68-.266A5.978,5.978,0,0,1,193.8.4,16.707,16.707,0,0,1,198.01.045q2.164.088,4.844.088-.618.088-.824.134L201.412.4a3.893,3.893,0,0,0,2.061,0,5.413,5.413,0,0,1,1.649-.356q.618.088,1.134.178a9.762,9.762,0,0,0,1.544.09,17,17,0,0,1,3.092-.266q1.649,0,3.5.178,2.886.088,5.875.044t5.875-.222q0,.088.206.088h.412a21.975,21.975,0,0,0,2.577.889A12.458,12.458,0,0,1,232.12,2.18a3.962,3.962,0,0,1,1.031.622A3.349,3.349,0,0,1,234.8,3.825a5.079,5.079,0,0,1,.618,1.111q.412.534-1.031.98-1.031.444-.618.98a2.09,2.09,0,0,1,.206.889q0,.444.825.889.618.8-.206,1.245l-1.237.534q-1.443-.088-2.68-.134a17.255,17.255,0,0,1-2.267-.222,3.128,3.128,0,0,0-.928-.044,3.129,3.129,0,0,1-.928-.044q-2.267-.178-4.432-.266T217.7,9.476q-1.649-.088-2.886-.088a17.343,17.343,0,0,1-2.474-.178q-3.916,0-7.73-.088t-7.73-.266l-12.471-.178q-6.287-.088-12.883-.088h-1.958q-.928,0-1.958.088h-2.061q-1.031,0-2.061-.088-2.68-.088-5.256-.134t-5.256.044h-5.462q-2.577,0-5.462.088-4.535.088-8.76.178t-8.554.088q-2.886.088-5.875.088t-5.875.088q-1.443.088-2.886.134t-3.092.044q-4.741.178-9.791.312t-9.791.312q-2.267.088-4.329.088T78.77,10.1q-4.329.266-8.863.49t-9.276.49q-1.237.088-2.68.134a24.356,24.356,0,0,0-2.683.224q-2.68.178-5.462.312t-5.668.4q-2.474.266-4.741.312t-4.741.044q-1.031-.088-1.958-.134a9.684,9.684,0,0,1-1.958-.312,12.5,12.5,0,0,0-1.443-.312q-.825-.134-1.856-.31-2.886.356-6.39.666t-6.8.845a26.709,26.709,0,0,1-2.886.356,20.758,20.758,0,0,1-9.482-.889Q.232,11.962.026,11.25T1.263,9.917q0-.266.825-.266a13.039,13.039,0,0,0,2.886-.444A17.187,17.187,0,0,1,7.86,8.672q3.092-.266,6.184-.8,1.649-.178,3.3-.312t3.5-.312q4.123-.354,8.039-.712t8.039-.622q9.478-.8,18.758-1.338,2.68-.178,5.153-.356t4.741-.356q2.474-.178,5.05-.356T75.88,3.24h1.34a4.829,4.829,0,0,0,1.34-.178q2.267-.178,4.329-.222t4.329-.134a7.256,7.256,0,0,1,2.267,0,3.459,3.459,0,0,0,1.031-.088,6.009,6.009,0,0,1,2.37-.266,14.745,14.745,0,0,0,2.783-.088q1.649,0,2.474.088a1.308,1.308,0,0,1,.185.011,1.226,1.226,0,0,1,.33-.1,3.656,3.656,0,0,0,.515-.088,4.433,4.433,0,0,1,2.886.266q.412-.088,1.031-.178l1.237-.178q.412,0,1.031.044a5.761,5.761,0,0,0,1.237-.044q2.886-.088,5.772-.044a53.829,53.829,0,0,0,5.772-.222,9.505,9.505,0,0,1,1.34-.088h1.34a4.428,4.428,0,0,1,.821-.258l.825-.178a15.178,15.178,0,0,1,1.855.444,3.028,3.028,0,0,1,1.031-.534,4.039,4.039,0,0,1,1.443-.178,6.158,6.158,0,0,1,1.649.178,5.05,5.05,0,0,0,2.267.268q1.855-.088,3.813-.134T138.13,1.2q1.031,0,2.164-.044t2.37-.044q-.206-.088.412-.534h3.092q.412,0,.309.266t.928,0a5.845,5.845,0,0,1,1.443,0,31.833,31.833,0,0,0,5.359.088,21.471,21.471,0,0,1,6.8.178,5.236,5.236,0,0,0,1.031-.4q.412-.222.825-.4a.694.694,0,0,1,.137.07Z" transform="translate(0 0.002)"></path>
                                </svg>
                            </span>
                        </mark>
                        <span>{{ __('site.home_hub_banner_rest') }}</span>
                    </h1>
                </div>
                <div data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "ease": "power4.out"}'>
                    <div class="animation-element" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "startDelay" : 800 , "ease": "power4.out", "initValues": {"y": "50px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
                        <div class="ld-fancy-heading pr-10percent relative animation-element">
                            <p class="ld-fh-element inline-block relative text-22 font-normal leading-1/6em mb-1/5em text-white-70">{{ __('site.home_hub_banner_lead') }}</p>
                        </div>
                        <a href="#contact" class="btn btn-solid btn-md font-bold btn-icon-right btn-hover-reveal whitespace-nowrap text-16 rounded-4 text-secondary bg-primary py-15 px-55 hover:text-white hover:bg-secondary animation-element" data-localscroll="true">
                            <span class="btn-txt" data-text="{{ __('site.home_hub_cta_quote') }}">{{ __('site.home_hub_cta_quote') }}</span>
                            <span class="btn-icon text-1/25em tracking-0" aria-hidden="true">
                                <i class="lqd-icn-ess icon-md-arrow-round-forward"></i>
                            </span>
                        </a>
                        <div class="inline-block w-auto relative animation-element">
                            <h6 class="ld-fh-element mt-0/5em ml-5em mb-0 inline-block relative">
                                <span class="text-13 text-white">{{ __('site.home_hub_call_now') }}</span>
                                <br>
                                <a href="tel:{{ $sky['phone_href'] }}" class="text-20 text-primary">{{ $sky['phone'] }}</a>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-45percent flex lg:w-full items-center p-0" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "duration" : 1800 , "startDelay" : 1500 , "delay" : 100 , "ease": "power4.out", "initValues": {"scaleX" : 2.05 , "scaleY" : 2.05 , "opacity" : 0} , "animations": {"scaleX" : 1 , "scaleY" : 1 , "opacity" : 1}}'>
                <div class="w-full items-center justify-end relative flex pr-100 lg:justify-start module-btn-circle animation-element">
                    <a href="https://www.youtube.com/watch?v=QxdxYr6CRN4&amp;ab_channel=Intapp" class="btn btn-naked top btn-icon-circle btn-icon-custom-size btn-icon-bordered btn-icon-border-thickest text-white text-15 whitespace-nowrap fresco" target="_blank" rel="noopener noreferrer">
                        <span class="btn-icon m-0 text-1/5em tracking-0 border-solid w-95 h-95 border-white">
                            <i aria-hidden="true" class="lqd-icn-ess icon-ion-ios-play"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Contact + formulaire dÃ©mo Hub --}}
<section class="lqd-section contact" id="contact">
    <div class="container">
        <div class="row items-center">
            <div class="col col-12 col-xl-5 pt-40 pb-35 text-start xl:text-center module-title" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "duration" : 1800 , "delay" : 180 , "ease": "power4.out", "initValues": {"y": "60px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
                <div class="ld-fancy-heading relative animation-element">
                    <h6 class="ld-fh-element mb-1em inline-block relative">{{ __('site.home_contact_kicker') }}</h6>
                </div>
                <div class="ld-fancy-heading relative animation-element">
                    <h2 class="ld-fh-element mb-0/5em inline-block relative">{{ __('site.home_contact_title') }}</h2>
                </div>
                <div class="ld-fancy-heading relative animation-element">
                    <p class="ld-fh-element mb-0/5em inline-block relative">{{ __('site.home_contact_text') }}</p>
                </div>
            </div>
            <div class="col col-12 col-xl-6 offset-xl-1 p-0">
                <div id="contact-form" class="relative w-full module-form">
                    <div class="form-mini relative -mt-80 rounded-6 bg-white shadow-md pt-30 pl-50 pb-50 pr-50 transition-all" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "duration" : 1800 , "delay" : 180 , "ease": "power4.out", "initValues": {"y": "35px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
                        <div class="ld-fancy-heading relative animation-element">
                            <h6 class="ld-fh-element mb-1em inline-block relative mb-1em">{{ __('site.home_contact_form_kicker') }}</h6>
                        </div>
                        <div class="ld-fancy-heading relative animation-element">
                            <h2 class="ld-fh-element mb-1/15em text-30 inline-block relative">{{ __('site.home_contact_form_title') }}</h2>
                        </div>
                        <div class="mb-0 lqd-contact-form lqd-contact-form-inputs-filled lqd-contact-form-button-block lqd-contact-form-button-lg lqd-contact-form-button-round lqd-contact-form-inputs-lg animation-element">
                            <div role="form" id="mini-form-help" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
                                <div class="screen-reader-response">
                                    <p role="status" aria-live="polite" aria-atomic="true"></p>
                                </div>
                                @include('partials.contact-form', [
                                    'source' => \App\Models\ContactMessage::SOURCE_HOME_SECTION,
                                    'variant' => 'hub-section',
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Case Study --}}
<section class="lqd-section case-study pt-55 pb-70">
    <div class="container">
        <div class="row">
            <div class="col col-12 text-center">
                <div class="w-50percent flex flex-col mx-auto mb-35 text-center lg:w-full" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "ease": "power4.out", "initValues": {"y": "35px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
                    <div class="ld-fancy-heading relative animation-element">
                        <h2 class="ld-fh-element mb-0/5em inline-block relative">{{ __('site.home_case_title') }}</h2>
                    </div>
                    <div class="ld-fancy-heading relative animation-element">
                        <p class="ld-fh-element mb-0/5em inline-block relative">{{ __('site.home_case_lead') }}</p>
                    </div>
                </div>
                <div class="w-full flex flex-wrap">
                    @include('partials.hub-company-case-study-tiles', ['homeServices' => $homeServices ?? collect()])
                </div>
                <div class="w-full pt-15">
                    <div class="text-center p-10">
                        <a href="{{ route('services') }}" class="btn button whitespace-nowrap btn-naked btn-icon-right btn-hover-reveal font-bold text-secondary text-15">
                            <span class="btn-txt mr-5" data-text="{{ __('site.home_case_more') }}">{{ __('site.home_case_more') }}</span>
                            <span class="btn-icon text-1/15em" aria-hidden="true">
                                <i class="lqd-icn-ess icon-md-arrow-round-forward-2"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Thin Fixed BG --}}
<section class="lqd-section py-100 thin-fixed-bg bg-center bg-cover relative transition-all" style="background-image: url('{{ $skyM('thin_section_bg') }}')">
    <div class="background-overlay transition-all bg-secondary opacity-90"></div>
    <div class="container">
        <div class="row">
            <div class="col col-lg-12" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "duration" : 800 , "delay" : 100 , "ease": "power4.out", "initValues": {"opacity" : 0} , "animations": {"opacity" : 1}}'>
                <div class="ld-fancy-heading relative text-center">
                    <h2 class="ld-fh-element text-50 mb-0/5em inline-block relative animation-element">
                        <span class="text-white">{{ __('site.home_fixed_w') }}</span>
                        <span class="text-primary">{{ __('site.home_fixed_p') }}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Clients --}}
<section class="lqd-section clients pt-40 pb-55 bg-gray-100">
    <div class="container">
        <div class="row">
            <div class="col col-lg-12">
                <div class="ld-fancy-heading relative text-center">
                    <p class="ld-fh-element mb-0/5em inline-block relative">{{ __('site.home_clients_lead') }}</p>
                </div>
                <div class="w-full block pt-50">
                    <div class="carousel-container relative carousel-nav-shaped">
                        <div class="carousel-items relative lqd-fade-sides" data-lqd-flickity="{&quot;marquee&quot;: true, &quot;equalHeightCells&quot;: true, &quot;middleAlignContent&quot;: true, &quot;pauseAutoPlayOnHover&quot;: true}">
                            <div class="flickity-viewport relative w-full overflow-hidden">
                                <div class="flickity-slider text-center flex w-full h-full relative">
                                    @forelse ($partners ?? [] as $partner)
                                    <div class="col col-4 col-md-3 w-20percent carousel-item flex flex-col justify-center items-center px-10">
                                        @if ($partner->website_url)
                                            <a href="{{ $partner->website_url }}" class="inline-flex items-center justify-center max-w-full" @if($partner->open_in_new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                                @if ($partner->logo)
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($partner->logo) }}" alt="{{ $partner->name }}" width="120" height="48" class="max-w-full h-auto object-contain">
                                                @else
                                                    <span class="text-14 font-semibold text-secondary">{{ $partner->name }}</span>
                                                @endif
                                            </a>
                                        @else
                                            <span class="inline-flex items-center justify-center max-w-full">
                                                @if ($partner->logo)
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($partner->logo) }}" alt="{{ $partner->name }}" width="120" height="48" class="max-w-full h-auto object-contain">
                                                @else
                                                    <span class="text-14 font-semibold text-secondary">{{ $partner->name }}</span>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                    @empty
                                        @foreach (config('sky.site_partner_logos', []) as $partnerRel)
                                        <div class="col col-4 col-md-3 w-20percent carousel-item flex flex-col justify-center items-center">
                                            <img src="{{ asset('assets/img/'.$partnerRel) }}" alt="" width="120" height="48" class="max-w-full h-auto object-contain">
                                        </div>
                                        @endforeach
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Ã‰quipe : maquette type Â« Our Team Â» ; visuels = news_1 / news_2 / news_3 (anciennement bloc offres) --}}
<section class="lqd-section team pt-100 pb-65" id="consultation">
    <div class="container">
        <div class="row">
            <div class="col col-12">
                <div class="w-full flex flex-col items-center text-center px-15percent pb-10 sm:px-0">
                    <h2 class="ld-fh-element relative mb-0/5em">{{ __('site.home_team_section_title') }}</h2>
                    <p class="ld-fh-element relative mb-0/5em text-black-60">{{ __('site.home_team_section_lead') }}</p>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        @php
                            $homeTeam = isset($teamMembers) ? $teamMembers->values()->take(3) : collect();
                        @endphp
                        @foreach (range(0, 2) as $idx)
                            @php
                                $member = $homeTeam->get($idx);
                                $teamImg = $skyM('news_'.($idx + 1));
                            @endphp
                            <div class="col col-12 col-md-4 flex flex-col items-start text-start p-20 module-col" data-custom-animations="true" data-ca-options='{"addChildTimelines":false,"animationTarget":"img, h4, h6, p","duration":1200,"startDelay":200,"delay":100,"ease":["power4.out"],"initValues":{"y":"20px","opacity":0},"animations":{"y":"0px","opacity":1}}'>
                                <img class="mb-1em w-full rounded-4 object-cover" width="660" height="492" src="{{ $teamImg }}" alt="{{ $member?->name ?? 'SkyITup' }}" loading="lazy">
                                @if ($member)
                                    <h4 class="ld-fh-element relative mb-0/5em text-24 font-bold">{{ $member->name }}</h4>
                                    <div class="ld-fancy-heading p-5 mb-0/6em bg-accent rounded-6">
                                        <h6 class="ld-fh-element relative p-5 mb-0/5em text-10 uppercase font-normal leading-1em tracking-1 text-gray-400">{{ $member->role }}</h6>
                                    </div>
                                    <p class="ld-fh-element relative mb-0/5em text-15 leading-1/6em text-black-60">{{ $member->bio ?: __('site.home_team_card_fallback_bio') }}</p>
                                @else
                                    <h4 class="ld-fh-element relative mb-0/5em text-24 font-bold">{{ config('app.name') }}</h4>
                                    <div class="ld-fancy-heading p-5 mb-0/6em bg-accent rounded-6">
                                        <h6 class="ld-fh-element relative p-5 mb-0/5em text-10 uppercase font-normal leading-1em tracking-1 text-gray-400">{{ __('site.nav_team') }}</h6>
                                    </div>
                                    <p class="ld-fh-element relative mb-0/5em text-15 leading-1/6em text-black-60">{{ __('site.home_team_slot_empty') }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Accordion --}}
<section class="lqd-section has-accordion pt-60 pb-120">
    <div class="container">
        <div class="row items-center">
            <div class="col col-12 col-xl-5" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "duration" : 1800 , "delay" : 180 , "ease": "power4.out", "initValues": {"y": "35px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}' data-localscroll="true" data-localscroll-options="{&quot;itemsSelector&quot;:&quot;a&quot;}">
                <div class="ld-fancy-heading relative animation-element">
                    <h2 class="ld-fh-element mb-0/5em inline-block relative">{{ __('site.home_acc_left_title') }}</h2>
                </div>
                <div class="ld-fancy-heading relative animation-element">
                    <p class="ld-fh-element mb-2/5em inline-block relative">{{ __('site.home_acc_left_text') }}</p>
                </div>
                <a href="#what-we-do" class="btn btn-solid btn-md font-bold btn-icon-right btn-hover-reveal text-16 text-secondary bg-primary rounded-4 hover:bg-secondary hover:text-white animation-element" rel="nofollow">
                    <span class="btn-txt" data-text="{{ __('site.home_acc_left_cta') }}">{{ __('site.home_acc_left_cta') }}</span>
                    <span class="btn-icon text-1/15em" aria-hidden="true">
                        <i class="lqd-icn-ess icon-md-arrow-round-forward"></i>
                    </span>
                </a>
            </div>
            <div class="col col-12 col-xl-6 offset-xl-1" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "duration" : 1800 , "delay" : 180 , "ease": "power4.out", "initValues": {"y": "35px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
                <div class="accordion accordion-lg accordion-side-spacing accordion-title-round accordion-expander-lg accordion-active-has-fill" id="accordion-bg-title" role="tablist" aria-multiselectable="true">
                    <div class="accordion-item mb-30 panel animation-element active">
                        <div class="accordion-heading" role="tab">
                            <h4 class="accordion-title" id="heading-hub-home-1">
                                <a class="text-16 font-bold leading-1/5em text-white rounded-4 py-1em px-1/5em bg-slate-100" role="button" data-bs-toggle="collapse" href="#collapse-hub-home-1" aria-expanded="true" aria-controls="collapse-hub-home-1">
                                    <span class="accordion-title-txt">{{ __('site.home_acc_1_title') }}</span>
                                    <span class="accordion-expander text-22">
                                        <i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
                                        <i class="lqd-icn-ess icon-ion-ios-arrow-up"></i>
                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-hub-home-1" class="accordion-collapse collapse show" data-bs-parent="#accordion-bg-title" role="tabpanel" aria-labelledby="heading-hub-home-1">
                            <div class="pb-0 px-1/5em pt-1/5em">{{ __('site.home_acc_body') }}</div>
                        </div>
                    </div>
                    <div class="accordion-item mb-30 panel animation-element">
                        <div class="accordion-heading" role="tab">
                            <h4 class="accordion-title" id="heading-hub-home-2">
                                <a class="collapsed text-16 font-bold leading-1/5em text-white rounded-4 py-1em px-1/5em bg-slate-100" role="button" data-bs-toggle="collapse" href="#collapse-hub-home-2" aria-expanded="false" aria-controls="collapse-hub-home-2">
                                    <span class="accordion-title-txt">{{ __('site.home_acc_2_title') }}</span>
                                    <span class="accordion-expander text-22">
                                        <i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
                                        <i class="lqd-icn-ess icon-ion-ios-arrow-up"></i>
                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-hub-home-2" class="accordion-collapse collapse" data-bs-parent="#accordion-bg-title" role="tabpanel" aria-labelledby="heading-hub-home-2">
                            <div class="pb-0 px-1/5em pt-1/5em">
                                <p>{{ __('site.home_acc_body') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item panel animation-element">
                        <div class="accordion-heading" role="tab">
                            <h4 class="accordion-title" id="heading-hub-home-3">
                                <a class="collapsed text-16 font-bold leading-1/5em text-white rounded-4 py-1em px-1/5em bg-slate-100" role="button" data-bs-toggle="collapse" href="#collapse-hub-home-3" aria-expanded="false" aria-controls="collapse-hub-home-3">
                                    <span class="accordion-title-txt">{{ __('site.home_acc_3_title') }}</span>
                                    <span class="accordion-expander text-22">
                                        <i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
                                        <i class="lqd-icn-ess icon-ion-ios-arrow-up"></i>
                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-hub-home-3" class="accordion-collapse collapse" data-bs-parent="#accordion-bg-title" role="tabpanel" aria-labelledby="heading-hub-home-3">
                            <div class="pb-0 px-1/5em pt-1/5em">
                                <p>{{ __('site.home_acc_body') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- What We Do --}}
<section class="lqd-section what-we-do my-50" id="what-we-do">
    <div class="container">
        <div class="row items-center">
            <div class="col col-12 col-xl-6 p-0">
                <div class="w-full flex flex-wrap content-center items-center relative p-10">
                    <div class="w-auto relative">
                        <div class="lqd-imggrp-single block relative" data-shadow-style="4">
                            <div class="lqd-imggrp-img-container inline-flex relative items-center justify-center w-50percent">
                                <figure class="w-full relative">
                                    <img class="rounded-6" width="492" height="596" src="{{ $skyM('offer_primary') }}" alt="{{ __('site.home_offer_image_alt') }}">
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="w-auto relative">
                        <div class="-mt-40percent -mr-40percent mb-0 ml-35percent">
                            <div class="lqd-imggrp-single block relative" data-shadow-style="4">
                                <div class="lqd-imggrp-img-container inline-flex relative items-center justify-center w-55percent">
                                    <figure class="w-full relative">
                                        <img class="rounded-6" width="666" height="808" src="{{ $skyM('offer_secondary') }}" alt="{{ __('site.home_offer_image_alt') }}">
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-xl-6 p-0" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "duration" : 1800 , "delay" : 180 , "ease": "power4.out", "initValues": {"y": "35px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
                <div class="w-full flex flex-col items-start pr-5percent pl-30percent module-content">
                    <div class="ld-fancy-heading relative animation-element">
                        <h6 class="ld-fh-element mb-0/5em inline-block relative lqd-highlight-classic lqd-highlight-grow-left">{{ __('site.home_what_kicker_hub') }}</h6>
                    </div>
                    <div class="ld-fancy-heading relative animation-element">
                        <h2 class="ld-fh-element mb-0/5em inline-block relative lqd-highlight-classic lqd-highlight-grow-left">{{ __('site.home_what_title_hub') }}</h2>
                    </div>
                    <div class="ld-fancy-heading pb-0/5em relative animation-element">
                        <p class="ld-fh-element mb-1/25em inline-block relative lqd-highlight-classic lqd-highlight-grow-left">{{ __('site.home_what_text_hub') }}</p>
                    </div>
                    <div class="mb-20 iconbox flex flex-grow-1 relative items-center iconbox-side animation-element">
                        <div class="iconbox-icon-wrap">
                            <div class="iconbox-icon-container inline-flex text-18 text-green-700">
                                <i aria-hidden="true" class="text-secondary lqd-icn-ess icon-ion-ios-checkmark"></i>
                            </div>
                        </div>
                        <h3 class="lqd-iconbox-heading text-16 font-bold m-0">{{ __('site.home_what_li1') }}</h3>
                    </div>
                    <div class="mb-40 iconbox flex flex-grow-1 relative items-center iconbox-side animation-element">
                        <div class="iconbox-icon-wrap">
                            <div class="iconbox-icon-container inline-flex text-18 text-green-700">
                                <i aria-hidden="true" class="text-secondary lqd-icn-ess icon-ion-ios-checkmark"></i>
                            </div>
                        </div>
                        <h3 class="lqd-iconbox-heading text-16 font-bold m-0">{{ __('site.home_what_li2') }}</h3>
                    </div>
                    <a href="#contact-modal" class="btn btn-solid btn-md font-bold btn-icon-right btn-hover-reveal text-16 text-secondary bg-primary rounded-4 hover:bg-secondary hover:text-white animation-element" data-lity="#contact-modal">
                        <span class="btn-txt" data-text="{{ __('site.home_hub_cta_quote') }}">{{ __('site.home_hub_cta_quote') }}</span>
                        <span class="btn-icon text-1/15em" aria-hidden="true">
                            <i class="lqd-icn-ess icon-md-arrow-round-forward"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Subscribe bande Ã©tapes Hub --}}
<section class="lqd-section subscribe pt-40 pb-180">
    <div class="container">
        <div class="row">
            <div class="col col-12 flex flex-wrap pt-35 pb-25 border-1 border-black-10 rounded-100 transition-all lg:border-0">
                <div class="lqd-pb-container lqd-pb-nums lqd-pb-icon-between lqd-pb-icon-between-middle flex flex-wrap flex-grow-1 justify-between">
                    @foreach ([1, 2, 3] as $stepNum)
                        <div class="flex flex-grow-1 flex-auto items-center justify-center relative w-33percent mb-10 md:w-50percent md:justify-start sm:w-full @if ($stepNum === 3) md:justify-start md:w-full @endif">
                            <div class="lqd-pb lqd-pb-style-5 lqd-pb-shaped lqd-pb-circle flex items-center justify-center">
                                <div class="lqd-pb-in-container lqd-pb-num-container relative mr-15">
                                    <div class="lqd-pb-in lqd-pb-num lqd-pb-active-shape flex rounded-full relative z-1 bg-white"></div>
                                </div>
                                <div class="lqd-pb-content">
                                    <h5 class="text-16 text-blue-700 tracking-0 m-0">{{ __('site.home_subscribe_'.$stepNum) }}</h5>
                                </div>
                            </div>
                            @if ($stepNum < 3)
                                <div class="absolute inline-block right-15 text-20 leading-1em md:hidden" aria-hidden="true">
                                    <svg class="w-1em h-1em" xmlns="http://www.w3.org/2000/svg" width="12" height="32" viewbox="0 0 12 32">
                                        <path fill="#2c2e30" d="M8.375 16L.437 8.062C-.125 7.5-.125 6.5.438 5.938s1.563-.563 2.126 0l9 9c.562.562.624 1.5.062 2.062l-9.063 9.063c-.312.312-.687.437-1.062.437s-.75-.125-1.063-.438c-.562-.562-.562-1.562 0-2.125z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- RÃ©alisations (flipboxes Hub) â€” avant tÃ©moignages --}}
<section class="lqd-section consultation pt-80" id="realisations-showcase">
    <div class="container">
        <div class="row">
            <div class="col col-12 flex flex-row flex-wrap justify-center" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "duration" : 1800 , "delay" : 180 , "ease": "power4.out", "initValues": {"y": "35px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
                <div class="w-45percent flex flex-col justify-center text-center mb-55 md:w-full">
                    <div class="ld-fancy-heading relative animation-element">
                        <h2 class="ld-fh-element mb-0/5em inline-block relative">{{ __('site.home_realisations_flip_title') }}</h2>
                    </div>
                    <div class="ld-fancy-heading relative animation-element">
                        <p class="ld-fh-element mb-0/5em inline-block relative">{{ __('site.home_realisations_flip_lead') }}</p>
                    </div>
                </div>
                <div class="w-full"></div>
                @php
                    $flipKeys = ['flip_1', 'flip_2', 'flip_3'];
                    $realList = isset($homeRealisations) ? $homeRealisations->values() : collect();
                @endphp
                @foreach (range(0, 2) as $i)
                    @php
                        $real = $realList->get($i);
                        $bgKey = $flipKeys[$i] ?? 'flip_1';
                        $bgUrl = $skyM($bgKey);
                        if ($real && $real->featured_image && file_exists(public_path('assets/img/'.$real->featured_image))) {
                            $bgUrl = asset('assets/img/'.$real->featured_image);
                        }
                        $label = $real ? ($real->client ?: \Illuminate\Support\Str::limit(strip_tags((string) $real->title), 24)) : __('site.home_flip_'.($i + 1).'_label');
                        $heading = $real ? $real->title : __('site.home_flip_'.($i + 1).'_heading');
                    @endphp
                    <div class="flex w-33percent flex p-15 lg:w-full animation-element">
                        <div class="ld-flipbox w-full h-full relative perspective rounded-4">
                            <div class="ld-flipbox-wrap w-full h-full relative transform-style-3d">
                                <div class="ld-flipbox-face ld-flipbox-front flex flex-col w-full h-full backface-hidden transform-style-3d bg-center bg-cover" style="background-image: url('{{ $bgUrl }}')">
                                    <span class="ld-flipbox-overlay lqd-overlay flex bg-transparent" style="background-image: linear-gradient(180deg, rgba(24, 27, 49, 0) 0%, rgba(24, 27, 49, 0.65) 100%);"></span>
                                    <div class="ld-flipbox-inner w-full flex-grow-1 items-center justify-center backface-hidden">
                                        <div class="w-full flex flex-col flex-wrap items-start p-10 px-15">
                                            <div class="ld-fancy-heading relative w-auto mb-2em rounded-4 bg-white">
                                                <h5 class="ld-fh-element m-0 inline-block relative bg-white text-15 font-semibold leading-1em tracking-0/5 py-0/5em px-1em rounded-4">{{ \Illuminate\Support\Str::limit($label, 42) }}</h5>
                                            </div>
                                            <div class="ld-fancy-heading relative">
                                                <h5 class="ld-fh-element mb-0/5em inline-block relative text-30 text-white leading-1em">{{ \Illuminate\Support\Str::limit($heading, 80) }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ld-flipbox-face ld-flipbox-back flex flex-col lqd-overlay flex h-full backface-hidden transform-style-3d">
                                    <span class="ld-flipbox-overlay lqd-overlay flex"></span>
                                    <div class="ld-flipbox-inner flex flex-col flex-grow-1 items-center justify-center w-full backface-hidden py-40 px-50">
                                        @if ($i === 1)
                                            <div class="ld-fancy-heading rounded-4 relative hover:text-white text-center mb-25 px-15">
                                                <p class="ld-fh-element text-white-60 inline-block relative">{{ $real ? \Illuminate\Support\Str::limit(strip_tags((string) $real->description), 220) : __('site.home_flip_back_line') }}</p>
                                            </div>
                                            <div class="fancy-btn">
                                                <a href="{{ route('realisations') }}" class="btn btn-naked btn-hover-txt-liquid-y whitespace-nowrap font-bold text-white text-15">
                                                    <span class="btn-txt" data-text="{{ __('site.home_realisations_flip_cta') }}">{{ __('site.home_realisations_flip_cta') }}</span>
                                                </a>
                                            </div>
                                        @else
                                            <a href="{{ $real ? route('realisations') : route('contact') }}" class="btn btn-solid btn-md whitespace-nowrap text-15 font-bold py-1/15em px-2/1em text-secondary rounded-4 bg-white hover:text-white hover:bg-primary">
                                                <span class="btn-txt" data-text="{{ __('site.home_realisations_flip_cta') }}">{{ __('site.home_realisations_flip_cta') }}</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Testimonial carousel --}}
<section class="lqd-section testimonial py-150 bg-center bg-cover relative transition-all" style="background-image: url('{{ $skyM('testimonials_bg') }}');">
    <div class="background-overlay transition-all bg-green-100 opacity-100" style="background-image: linear-gradient(115deg, rgb(24, 67, 65) 48%, rgba(242, 41, 91, 0) 82%);"></div>
    <div class="container">
        <div class="row">
            <div class="col col-12 col-xl-8 relative sm:p-0" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "duration" : 1800 , "delay" : 180 , "ease": "power4.out", "initValues": {"y": "35px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
                <div class="ld-fancy-heading relative animation-element">
                    <h2 class="ld-fh-element mb-1em text-primary inline-block relative  lqd-highlight-classic lqd-highlight-grow-left">{{ app()->getLocale() === 'en' ? 'testimonials' : 'tÃ©moignages' }}</h2>
                </div>
                <div class="carousel-container pr-45 relative carousel-nav-left carousel-nav-size-default carousel-nav-left carousel-dots-mobile-outside carousel-dots-mobile-left sm:pr-0 animation-element">
                    <div class="carousel-items relative" data-lqd-flickity="{&quot;prevNextButtons&quot;: true, &quot;groupCells&quot;: true, &quot;navArrow&quot;: &quot;6&quot;, &quot;addSlideNumbersToArrows&quot;: true, &quot;cellAlign&quot;: &quot;left&quot;, &quot;buttonsAppendTo&quot;: &quot;self&quot;, &quot;pageDots&quot;: false}">
                        @foreach (range(1, 3) as $__t)
                            <div class="carousel-item flex flex-col justify-center">
                                <div class="carousel-item-inner relative w-full">
                                    <div class="carousel-item-content relative w-full">
                                        <span class="text-white text-24 leading-40">{{ __('site.home_testimonial_slide1') }}</span>
                                        <h6 class="mt-1em mb-0/5em">
                                            <span class="text-white-50">{{ __('site.home_testimonial_meta1') }}</span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="absolute lqd-imggrp-single block w-auto -top-25" data-parallax="true" data-parallax-options='{"ease": "linear", "start": "top bottom", "end": "bottom+=0px top"}' data-parallax-from='{"y": "140px"}' data-parallax-to='{"y": "40px"}'>
                    <div class="lqd-imggrp-img-container inline-flex relative items-center justify-center">
                        <figure class="w-full relative">
                            <img src="{{ asset('hub/assets/images/demo/company/icon-quote.svg') }}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Offres dâ€™emploi (BDD) --}}
<section class="lqd-section blog pt-80" id="offres">
    <div class="container mb-50">
        <div class="row">
            <div class="col col-12 flex flex-col">
                <div class="w-45percent flex flex-col mx-auto lg:w-full" data-custom-animations="true" data-ca-options='{"addChildTimelines": false, "animationTarget": ".animation-element", "duration" : 1800 , "delay" : 180 , "ease": "power4.out", "initValues": {"y": "35px"} , "animations": {"y": "0px"}}'>
                    <div class="flex flex-col text-center mb-35">
                        <div class="ld-fancy-heading relative animation-element">
                            <h2 class="ld-fh-element mb-0/5em inline-block relative lqd-highlight-classic lqd-highlight-grow-left">{{ __('site.home_jobs_kicker') }}</h2>
                        </div>
                        <div class="ld-fancy-heading relative animation-element">
                            <p class="ld-fh-element mb-0/5em inline-block relative lqd-highlight-classic lqd-highlight-grow-left p">{{ __('site.home_jobs_lead') }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mr-15 -ml-15">
                    @forelse (($homeJobOffers ?? collect()) as $job)
                        <div class="w-33percent flex mb-30 px-15 md:w-full">
                            <article class="flex flex-col h-full w-full rounded-6 border-1 border-black-10 bg-white p-25 shadow-sm text-start">
                                <header class="mb-1em">
                                    <h2 class="entry-title text-20 font-bold text-secondary m-0 mb-10">{{ $job->getTranslation('title', app()->getLocale()) }}</h2>
                                </header>
                                <div class="mb-1em flex-grow-1">
                                    <p class="text-14 text-black-60 m-0 mb-10">{{ \Illuminate\Support\Str::limit(strip_tags((string) $job->description), 220) }}</p>
                                    @if ($job->location)
                                        <p class="text-13 text-black-50 mb-0">{{ $job->location }} @if ($job->contract_type) Â· {{ strtoupper((string) $job->contract_type) }} @endif</p>
                                    @endif
                                </div>
                                <footer class="mt-auto pt-10">
                                    <a
                                        href="{{ route('careers', ['offer' => $job->slug]) }}"
                                        class="btn btn-solid btn-sm font-bold text-secondary bg-primary rounded-4 hover:bg-secondary hover:text-white"
                                    >{{ __('site.home_jobs_read') }}</a>
                                </footer>
                            </article>
                        </div>
                    @empty
                        <div class="w-full px-15 text-center text-black-60">
                            <p class="mb-0">{{ __('site.home_jobs_empty') }}</p>
                            <a href="{{ route('careers') }}" class="btn btn-solid btn-sm mt-20 text-secondary bg-primary">{{ __('site.nav_careers') }}</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Carte Hub : ajoutez GOOGLE_MAPS_API_KEY dans .env --}}
<section class="lqd-section map bg-yellow-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-12 p-0">
                <div class="ld-gmap-container relative h-550">
                    <div class="ld-gmap w-full h-full" data-plugin-map="true" data-plugin-options="{{ $mapOptsJson }}"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Modal contact Hub (lity), alignÃ© index-company --}}
<div id="contact-modal" class="lqd-modal lity-hide" data-modal-type="fullscreen">
    <div class="lqd-modal-inner py-25 px-2em">
        <div class="lqd-modal-head">
            <h2>{{ __('site.page_contact_title') }}</h2>
        </div>
        <div class="lqd-modal-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col col-12">
                        <div class="ld-gmap-container h-340">
                            <div class="ld-gmap w-full h-full" data-plugin-map="true" data-plugin-options="{{ $mapOptsJson }}"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative flex flex-wrap py-80 -mr-15 -ml-15 module-bottom">
                <div class="container-fluid">
                    <div class="row items-center">
                        <div class="col col-12 col-md-6">
                            <div class="relative flex flex-col justify-content transition-all border-1 border-black-10 rounded-4 pt-55 pb-35 px-60 module-inner">
                                <div class="ld-fancy-heading">
                                    <h2 class="ld-fh-element mb-0/5em text-34 font-semibold">{{ __('site.page_contact_title') }}</h2>
                                </div>
                                <div class="ld-fancy-heading">
                                    <p class="ld-fh-element mb-2/5em">{{ __('site.home_contact_text') }}</p>
                                </div>
                                <div class="iconbox text-align-default mb-10 items-start">
                                    <div class="iconbox-icon-wrap flex">
                                        <span class="iconbox-icon-container text-gray-200 text-16 mr-15">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="1em" viewBox="0 0 384 512"><path d="M384 192c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192z"/></svg>
                                        </span>
                                    </div>
                                    <h3 class="text-15 text-black-60 leading-1/5em">{{ $sky['address'] }}</h3>
                                </div>
                                <div class="iconbox text-align-default mb-10 items-start">
                                    <div class="iconbox-icon-wrap flex">
                                        <span class="iconbox-icon-container text-gray-200 text-16 mr-15">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="1em" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                                        </span>
                                    </div>
                                    <h3 class="text-15 text-black-60 leading-1/5em">
                                        <span>{{ __('site.footer_email') }}: </span>
                                        <a class="text-black-60 break-all" href="mailto:{{ $sky['email'] }}">{{ $sky['email'] }}</a>
                                    </h3>
                                </div>
                                <div class="iconbox text-align-default mb-10 items-start">
                                    <div class="iconbox-icon-wrap flex">
                                        <span class="iconbox-icon-container text-gray-200 text-16 mr-15">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="1em" viewBox="0 0 384 512"><path d="M16 64C16 28.7 44.7 0 80 0H304c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H80c-35.3 0-64-28.7-64-64V64zM144 448c0 8.8 7.2 16 16 16h64c8.8 0 16-7.2 16-16s-7.2-16-16-16H160c-8.8 0-16 7.2-16 16zM304 64H80V384H304V64z"/></svg>
                                        </span>
                                    </div>
                                    <h3 class="text-15 text-black-60 leading-1/5em">{{ __('site.footer_phone') }}: {{ $sky['phone'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12 col-md-6 col-lg-5 offset-lg-1">
                            <div class="lqd-contact-form lqd-contact-form-inputs-filled lqd-contact-form-inputs-round lqd-contact-form-button-block lqd-contact-form-button-round pr-12percent">
                                <div role="form" class="lqd-cf" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
                                    <div class="screen-reader-response">
                                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                                    </div>
                                    @include('partials.contact-form', [
                                        'source' => \App\Models\ContactMessage::SOURCE_HOME_MODAL,
                                        'variant' => 'hub-modal',
                                    ])
                                    <div class="lqd-cf-response-output"></div>
                                    <p class="text-center text-black-50 text-13 mt-20 mb-0">
                                        <a class="underline" href="mailto:{{ $sky['email'] }}">{{ __('site.footer_email') }}</a>
                                        Â· <a class="underline" href="{{ route('contact') }}">{{ __('site.home_news_read') }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lqd-modal-foot"></div>
    </div>
</div>

@endsection

@if ($gmapKey !== '')
    @push('scripts')
        <script src="https://maps.googleapis.com/maps/api/js?key={{ $gmapKey }}"></script>
    @endpush
@endif
