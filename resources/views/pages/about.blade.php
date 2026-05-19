@extends('layouts.app')

@php
    $skyM = static fn (string $key): string => asset('assets/img/'.config('sky.site_media.'.$key));
@endphp

@push('hub-demo-css')
<link rel="stylesheet" href="{{ asset('hub/assets/css/demo/company/company-about.css') }}">
@endpush

@section('hub_body_class', 'sky-about-page')

@section('title', __('site.page_about_title').' — '.config('app.name'))

@section('before_content')
    @include('partials.hub-inner-titlebar', [
        'title' => __('site.page_about_title'),
        'subtitle' => $about?->subtitle ?? __('site.about_titlebar_lead'),
        'crumbs' => [__('site.page_about_title')],
        'backgroundImage' => $skyM('about_titlebar'),
    ])
@endsection

@section('content')

    {{-- Onglets (page-company-about Hub) --}}
    <section class="lqd-section tab-items">
        <div class="container">
            <div class="row">
                <div class="col col-12 py-50 px-0">
                    <div class="lqd-tabs lqd-tabs-style-3 lqd-tabs-nav-iconbox lqd-tabs-nav-items-not-expanded lqd-nav-underline-" data-tabs-options='{"trigger":"click"}'>
                        <nav class="lqd-tabs-nav-wrap mb-2rem">
                            <ul class="reset-ul lqd-tabs-nav flex items-center justify-center relative border-black-10 md:justify-between" role="tablist">
                                <li class="text-center" data-controls="lqd-tab-about-1" role="presentation">
                                    <a class="block text-17 font-bold text-secondary active" href="#lqd-tab-about-1" aria-expanded="true" aria-controls="lqd-tab-about-1" role="tab" data-bs-toggle="tab">
                                        <span class="lqd-tabs-nav-icon d-block">
                                            <span class="lqd-tabs-nav-content d-block">
                                                <span class="d-block relative h3 mt-0 mb-0">{{ $about?->experience_label ?? __('site.home_flip_1_tag') }}</span>
                                            </span>
                                        </span>
                                        <span class="lqd-tabs-nav-progress"><span class="lqd-tabs-nav-progress-inner"></span></span>
                                    </a>
                                </li>
                                <li class="text-center" data-controls="lqd-tab-about-2" role="presentation">
                                    <a class="block text-17 font-bold text-secondary" href="#lqd-tab-about-2" aria-expanded="false" aria-controls="lqd-tab-about-2" role="tab" data-bs-toggle="tab">
                                        <span class="lqd-tabs-nav-icon d-block">
                                            <span class="lqd-tabs-nav-content d-block">
                                                <span class="d-block relative h3 mt-0 mb-0">{{ $about?->diploma_label ?? __('site.home_flip_2_tag') }}</span>
                                            </span>
                                        </span>
                                        <span class="lqd-tabs-nav-progress"><span class="lqd-tabs-nav-progress-inner"></span></span>
                                    </a>
                                </li>
                                <li class="text-center" data-controls="lqd-tab-about-3" role="presentation">
                                    <a class="block text-17 font-bold text-secondary" href="#lqd-tab-about-3" aria-expanded="false" aria-controls="lqd-tab-about-3" role="tab" data-bs-toggle="tab">
                                        <span class="lqd-tabs-nav-icon d-block">
                                            <span class="lqd-tabs-nav-content d-block">
                                                <span class="d-block relative h3 mt-0 mb-0">{{ $about?->expertise_label ?? __('site.home_flip_3_tag') }}</span>
                                            </span>
                                        </span>
                                        <span class="lqd-tabs-nav-progress"><span class="lqd-tabs-nav-progress-inner"></span></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="lqd-tabs-content relative px-25percent">
                            <div id="lqd-tab-about-1" role="tabpanel" class="lqd-tabs-pane fade active in">
                                <div class="text-center text-black-60 leading-normal m-0">{!! nl2br(e((string) ($about?->content1 ?? __('site.home_accordion_intro')))) !!}</div>
                            </div>
                            <div id="lqd-tab-about-2" role="tabpanel" class="lqd-tabs-pane fade">
                                <div class="text-center text-black-60 leading-normal m-0">{!! nl2br(e((string) ($about?->content2 ?? __('site.home_consult_lead')))) !!}</div>
                            </div>
                            <div id="lqd-tab-about-3" role="tabpanel" class="lqd-tabs-pane fade">
                                <p class="text-center text-black-60 leading-normal m-0">{{ __('site.home_offer_text') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Grille médias --}}
    <section class="lqd-section image-box pb-130">
        <div class="container">
            <div class="row">
                <div class="col col-12 p-0 module-col">
                    <div class="ld-media-row flex flex-wrap -mx-10" data-liquid-masonry="true">
                        <div class="masonry-item w-50percent h-645 px-10 mb-20 module-img lg:w-full">
                            <div class="ld-media-item pos-rel overflow-hidden h-full">
                                <figure class="bg-cover h-full">
                                    <img class="w-full h-full objfit-cover objpos-center" width="1076" height="1146" src="{{ $skyM('about_gallery_large') }}" alt="">
                                </figure>
                                <div class="ld-media-item-overlay flex flex-col items-center lqd-overlay text-center justify-center">
                                    <div class="ld-media-bg lqd-overlay"></div>
                                    <div class="ld-media-content pos-rel z-2">
                                        <div class="ld-media-txt">
                                            <h3 class="m-0 text-secondary">{{ __('site.home_flip_1_tag') }}</h3>
                                            <h6 class="m-0 uppercase ltr-sp-135 text-white-70">{{ __('site.home_flip_1_title') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ $skyM('about_gallery_large') }}" target="_blank" rel="nofollow" class="lqd-overlay z-2 fresco" data-fresco-group="gallery-about"></a>
                            </div>
                        </div>
                        <div class="masonry-item w-50percent h-310 px-10 mb-20 module-img lg:w-full">
                            <div class="ld-media-item pos-rel overflow-hidden h-full">
                                <figure class="bg-cover h-full">
                                    <img class="w-full h-full objfit-cover objpos-center" width="1182" height="546" src="{{ $skyM('about_gallery_top_right') }}" alt="">
                                </figure>
                                <div class="ld-media-item-overlay flex flex-col items-center lqd-overlay text-center justify-end">
                                    <div class="ld-media-bg lqd-overlay"></div>
                                    <div class="ld-media-content pos-rel z-2">
                                        <div class="ld-media-txt">
                                            <h3 class="m-0 text-secondary">{{ __('site.home_news_kicker') }}</h3>
                                            <h6 class="m-0 uppercase ltr-sp-135 text-white-70">{{ __('site.home_case_studies_kicker') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ $skyM('about_gallery_top_right') }}" class="lqd-overlay z-2 fresco" data-fresco-group="gallery-about"></a>
                            </div>
                        </div>
                        <div class="masonry-item w-25percent h-310 px-10 mb-20 module-img lg:w-full">
                            <div class="ld-media-item pos-rel overflow-hidden h-full">
                                <figure class="bg-cover h-full">
                                    <img class="w-full h-full objfit-cover objpos-center" width="556" height="546" src="{{ $skyM('about_gallery_small_1') }}" alt="">
                                </figure>
                                <div class="ld-media-item-overlay flex flex-col items-center lqd-overlay text-center justify-end">
                                    <div class="ld-media-bg lqd-overlay"></div>
                                    <div class="ld-media-content pos-rel z-2">
                                        <div class="ld-media-txt">
                                            <h3 class="m-0 text-secondary">{{ __('site.page_realisations_title') }}</h3>
                                            <h6 class="m-0 uppercase ltr-sp-135 text-white-70">{{ __('site.home_projects_kicker') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ $skyM('about_gallery_small_1') }}" target="_blank" rel="nofollow" class="lqd-overlay z-2 fresco" data-fresco-group="gallery-about"></a>
                            </div>
                        </div>
                        <div class="masonry-item w-25percent h-310 px-10 mb-20 module-img lg:w-full">
                            <div class="ld-media-item pos-rel overflow-hidden h-full">
                                <figure class="bg-cover h-full">
                                    <img class="w-full h-full objfit-cover objpos-center" width="580" height="546" src="{{ $skyM('about_gallery_small_2') }}" alt="">
                                </figure>
                                <div class="ld-media-item-overlay flex flex-col items-center lqd-overlay text-center justify-end">
                                    <div class="ld-media-bg lqd-overlay"></div>
                                    <div class="ld-media-content pos-rel z-2">
                                        <div class="ld-media-txt">
                                            <h3 class="m-0 text-secondary">{{ __('site.nav_contact') }}</h3>
                                            <h6 class="m-0 uppercase ltr-sp-135 text-white-70">{{ __('site.footer_contact') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ $skyM('about_gallery_small_2') }}" class="lqd-overlay z-2 fresco" data-fresco-group="gallery-about"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Accordéon + visuel --}}
    <section class="lqd-section has-accordion-page pt-100 bg-gray-200">
        <div class="container">
            <div class="row">
                <div class="col col-12 col-xl-6">
                    <h2 class="ld-fh-element relative mb-0/5em text-40 text-secondary">{{ __('site.home_accordion_title') }}</h2>
                    <p class="ld-fh-element relative mb-2/25em text-black-60">{{ __('site.home_accordion_intro') }}</p>
                    <div class="accordion accordion-sm accordion-side-spacing accordion-title-round accordion-expander-lg accordion-active-has-fill" id="accordion-about-sky" role="tablist" aria-multiselectable="true">
                        <div class="accordion-item mb-20 panel animation-element active">
                            <div class="accordion-heading" role="tab">
                                <h4 class="accordion-title leading-1/5em text-blue-300" id="heading-about-1">
                                    <a class="py-0/65em px-1/5em bg-white text-16 font-bold" role="button" data-bs-toggle="collapse" href="#collapse-about-1" aria-expanded="true" aria-controls="collapse-about-1">
                                        <span class="accordion-title-txt">{{ __('site.home_acc_1_title') }}</span>
                                        <span class="accordion-expander text-22">
                                            <i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
                                            <i class="lqd-icn-ess icon-ion-ios-arrow-up"></i>
                                        </span>
                                    </a>
                                </h4>
                            </div>
                            <div class="accordion-collapse collapse show" id="collapse-about-1" data-bs-parent="#accordion-about-sky" role="tabpanel" aria-labelledby="heading-about-1">
                                <div class="pt-1/5em pl-1/5em">
                                    <p class="m-0 text-black-60">{{ __('site.home_acc_body') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-20 panel animation-element">
                            <div class="accordion-heading" role="tab">
                                <h4 class="accordion-title leading-1/5em text-blue-300" id="heading-about-2">
                                    <a class="collapsed py-0/65em px-1/5em bg-white text-16 font-bold" role="button" data-bs-toggle="collapse" href="#collapse-about-2" aria-expanded="false" aria-controls="collapse-about-2">
                                        <span class="accordion-title-txt">{{ __('site.home_acc_2_title') }}</span>
                                        <span class="accordion-expander text-22">
                                            <i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
                                            <i class="lqd-icn-ess icon-ion-ios-arrow-up"></i>
                                        </span>
                                    </a>
                                </h4>
                            </div>
                            <div class="accordion-collapse collapse" id="collapse-about-2" data-bs-parent="#accordion-about-sky" role="tabpanel" aria-labelledby="heading-about-2">
                                <div class="pt-1/5em pl-1/5em">
                                    <p class="m-0 text-black-60">{{ __('site.home_acc_body') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item panel animation-element">
                            <div class="accordion-heading" role="tab">
                                <h4 class="accordion-title leading-1/5em text-blue-300" id="heading-about-3">
                                    <a class="collapsed py-0/65em px-1/5em bg-white text-16 font-bold" role="button" data-bs-toggle="collapse" href="#collapse-about-3" aria-expanded="false" aria-controls="collapse-about-3">
                                        <span class="accordion-title-txt">{{ __('site.home_acc_3_title') }}</span>
                                        <span class="accordion-expander text-22">
                                            <i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
                                            <i class="lqd-icn-ess icon-ion-ios-arrow-up"></i>
                                        </span>
                                    </a>
                                </h4>
                            </div>
                            <div class="accordion-collapse collapse" id="collapse-about-3" data-bs-parent="#accordion-about-sky" role="tabpanel" aria-labelledby="heading-about-3">
                                <div class="pt-1/5em pl-1/5em">
                                    <p class="m-0 text-black-60">{{ __('site.home_acc_body') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-xl-6 p-0">
                    <div class="w-full relative flex items-center pl-20percent rounded-8 z-1 module-col lg:pl-0 lg:px-20" data-parallax="true" data-parallax-options='{"ease":["linear"],"start":"top bottom","end":"bottom+=0px top"}' data-parallax-from='{"y":"60px"}' data-parallax-to='{"y":"-75px"}'>
                        <div class="lqd-imggrp-single block pos-rel rounded-inherit" data-shadow-style="4">
                            <div class="lqd-imggrp-img-container inline-flex pos-rel items-center justify-center rounded-inherit">
                                <figure class="w-full pos-rel">
                                    <img class="rounded-inherit" width="592" height="674" src="{{ $skyM('about_accordion_visual') }}" alt="">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Cartes type « Diversity and Inclusion » (maquette) --}}
    <section class="lqd-section icon-box-page bg-gray-200 pt-90 pb-100" data-custom-animations="true" data-ca-options='{"addChildTimelines":false,"animationTarget":".col","ease":["power4.out"],"initValues":{"opacity":0},"animations":{"opacity":1}}'>
        <div class="container">
            <div class="row">
                <div class="col col-12 text-center flex flex-wrap p-0">
                    @foreach (range(1, 4) as $_)
                    <div class="col col-12 col-md-6 col-xl-3 p-0">
                        <div class="flex flex-auto p-15 transition-all">
                            <div class="iconbox flex-grow-1 relative flex-col iconbox-default iconbox-contents-show-onhover py-40 px-20 mb-30 items-center bg-white rounded-10 shadow-bottom lg:m-0" data-slideelement-onhover="true" data-slideelement-options='{"visibleElement":".iconbox-icon-wrap, p, h3","hiddenElement":".btn","alignMid":true,"triggerElement":".iconbox"}'>
                                <div class="iconbox-icon-wrap">
                                    <div class="mb-25 iconbox-icon-container inline-flex w-40 text-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" aria-hidden="true">
                                            <path d="M4.15-19.775a8.008,8.008,0,0,0,5.908-2.466A8.072,8.072,0,0,0,12.5-28.125V-42.48L18.115-37.7l1.465-1.66L11.67-46.24,3.76-39.355,5.225-37.7,10.4-42.48v14.355a6.082,6.082,0,0,1-1.782,4.443A6.017,6.017,0,0,1,4.15-21.875H-6.25a5.843,5.843,0,0,0-3.223.977,10.241,10.241,0,0,0-2.661,2.515,12.919,12.919,0,0,0-1.807,3.369,10.428,10.428,0,0,0-.659,3.54v6.25h2.1v-6.25a10.192,10.192,0,0,1,1.807-5.469q1.807-2.832,4.443-2.832Zm-25-25h25v-2.1h-25a4,4,0,0,0-2.93,1.221A4,4,0,0,0-25-42.725v41.7A4,4,0,0,0-23.779,1.9a4,4,0,0,0,2.93,1.221v-2.1A2.013,2.013,0,0,1-22.339.464,2.013,2.013,0,0,1-22.9-1.025v-41.7a2.013,2.013,0,0,1,.562-1.489A2.013,2.013,0,0,1-20.85-44.775Zm6.25,47.9h2.1v-4.15h-2.1Zm.83-32.52L-10.4-32.91l3.32,3.516,1.66-1.66-3.516-3.32L-5.42-37.7l-1.66-1.66L-10.4-35.84l-3.369-3.516-1.66,1.66,3.564,3.32-3.564,3.32ZM15.82-14.355,12.5-10.84,9.18-14.355,7.52-12.7l3.516,3.32L7.52-6.055l1.66,1.66L12.5-7.91l3.32,3.516,1.66-1.66-3.516-3.32L17.48-12.7ZM22.9-42.725H25a4,4,0,0,0-1.221-2.93,4,4,0,0,0-2.93-1.221h-2.1v2.1h2.1a2.013,2.013,0,0,1,1.489.562A2.013,2.013,0,0,1,22.9-42.725Zm0,41.7A2.013,2.013,0,0,1,22.339.464,2.013,2.013,0,0,1,20.85,1.025H-6.25v2.1h27.1A4,4,0,0,0,23.779,1.9,4,4,0,0,0,25-1.025v-29.2H22.9Zm0-33.35H25v-4.15H22.9Z" transform="translate(25 46.875)" fill="#184341"></path>
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="lqd-iconbox-heading text-center text-16 leading-1em mb-0 text-secondary">{{ __('site.home_about_kicker') }}</h3>
                                <div class="contents">
                                    <p class="text-black-60">{{ __('site.page_about_heading') }}</p>
                                    <a href="{{ route('services') }}" class="btn btn-naked btn-icon-right btn-hover-swp mt-em mb-0 items-center text-15 font-bold text-secondary hover:text-primary">
                                        <span class="btn-txt" data-text="{{ __('site.home_about_cta') }}">{{ __('site.home_about_cta') }}</span>
                                        <span class="btn-icon text-16 tracking-0">
                                            <i class="lqd-icn-ess icon-md-arrow-round-forward-2"></i>
                                        </span>
                                        <span class="btn-icon mr-10 text-16 tracking-0">
                                            <i class="lqd-icn-ess icon-md-arrow-round-forward-2"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="lqd-section py-70">
        <div class="container">
            <div class="row justify-center">
                <div class="col col-12 col-lg-10 col-xl-8">
                    <div class="p-40 rounded-6 bg-gray-100 text-black-70 leading-relaxed">
                        <p class="mb-0">{{ __('site.home_about_text') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
