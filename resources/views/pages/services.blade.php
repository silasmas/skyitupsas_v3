@extends('layouts.app')

@section('hub_body_class', 'sky-services-hub')

@push('hub-demo-css')
<link rel="stylesheet" href="{{ asset('hub/assets/css/demo/company/company-services-2.css') }}">
<link rel="stylesheet" href="{{ asset('css/sky-services.css') }}">
@endpush

@section('title', __('site.page_services_title').' — '.config('app.name'))

@php
    $sky = config('sky');
    $skyImg = static fn (string $key): string => asset('assets/img/'.config('sky.site_media.'.$key));
    $svcTitlebarPath = public_path('hub/assets/images/demo/company/services-2/titlebar.jpg');
    $svcTitlebarUrl = file_exists($svcTitlebarPath) ? asset('hub/assets/images/demo/company/services-2/titlebar.jpg') : $skyImg('about_titlebar');
    $serviceList = $services ?? collect();
@endphp

@section('before_content')
    @include('partials.hub-inner-titlebar', [
        'title' => __('site.page_services_title'),
        'subtitle' => __('site.services_page_titlebar_lead'),
        'crumbs' => [__('site.page_services_title')],
        'backgroundImage' => $svcTitlebarUrl,
    ])
@endsection

@section('content')
<section class="lqd-section services-content">
    <div class="container">
        @if ($serviceList->isEmpty())
            <p class="text-center text-black-60 py-50 mb-0">{{ __('site.services_empty') }}</p>
        @else
            <div class="row">
                <div class="w-30percent relative lg:w-full">
                    <div class="w-full sticky py-50 px-10 module-first lg:static">
                        <div class="w-full relative">
                            <div class="lqd-fancy-menu lqd-custom-menu pos-rel menu-items-has-fill lqd-menu-td-none module-list-bg">
                                <ul class="reset-ul link-15 link-black sky-services-nav__list" role="tablist">
                                    @foreach ($serviceList as $index => $svc)
                                        <li class="mb-5 items-center" role="presentation">
                                            <a
                                                href="#"
                                                class="sky-services-nav-link w-full bg-accent font-bold @if ($index === 0) is-active @endif"
                                                role="tab"
                                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                                                aria-controls="service-panel-{{ $svc->slug }}"
                                                id="service-tab-{{ $svc->slug }}"
                                                data-service-slug="{{ $svc->slug }}"
                                            >
                                                <span class="link-icon inline-flex hide-if-empty right-icon icon-push-to-edge" aria-hidden="true">
                                                    <i class="lqd-icn-ess icon-ion-ios-arrow-forward"></i>
                                                </span>
                                                {{ $svc->getTranslation('title', app()->getLocale()) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="w-full relative mt-45">
                            <div class="w-full relative flex flex-col transition-bg bg-accent py-35 px-20 mb-30">
                                <h3 class="ld-fh-element relative mb-0/5em text-18">{{ __('site.services_quote_form_title') }}</h3>
                                <div class="lqd-contact-form lqd-contact-form-inputs-filled lqd-contact-form-inputs-round lqd-contact-form-button-block mt-10">
                                    <form action="{{ route('contact') }}" method="get" class="lqd-form init">
                                        <p>
                                            <span class="lqd-form-control-wrap">
                                                <input type="text" name="name" class="lqd-cf-form-control px-2em bg-white text-gray-500 text-15" placeholder="{{ __('site.services_quote_name_ph') }}">
                                            </span>
                                            <span class="lqd-form-control-wrap">
                                                <input type="email" name="email" class="lqd-cf-form-control px-2em bg-white text-gray-500 text-15" placeholder="{{ __('site.services_quote_email_ph') }}">
                                            </span>
                                            <span class="lqd-form-control-wrap">
                                                <textarea name="message" cols="10" rows="4" class="lqd-cf-form-control px-2em bg-white text-gray-500 text-15" placeholder="{{ __('site.services_quote_message_ph') }}"></textarea>
                                            </span>
                                            <input type="submit" value="{{ __('site.services_quote_submit') }}" class="lqd-cf-form-control has-spinner bg-secondary text-15 text-white font-bold font-heading">
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="w-full relative">
                            <div class="iconbox d-flex flex-grow-1 relative items-center iconbox-circle border-1 border-black-10 rounded-4 p-20 mb-30">
                                <div class="iconbox-icon-wrap mr-25">
                                    <div class="iconbox-icon-container inline-flex relative z-1 border-radius-circle w-65 h-65 bg-accent rounded-full text-20 text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentColor" aria-hidden="true"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                                    </div>
                                </div>
                                <div class="contents">
                                    <h3 class="lqd-iconbox-heading mt-1em mb-0 text-15 font-medium text-gray-400">{{ __('site.services_call_title') }}</h3>
                                    <p class="m-0"><a href="tel:{{ $sky['phone_href'] }}" class="text-20 text-dark">{{ $sky['phone'] }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-70percent flex flex-col py-50 pr-10 pl-50 module-last lg:w-full lg:order-first lg:pl-15 lg:pr-15">
                    <div class="sky-services-panels-host w-full relative">
                        @foreach ($serviceList as $index => $service)
                            @php
                                $locale = app()->getLocale();
                                $title = $service->getTranslation('title', $locale);
                                $subtitle = $service->getTranslation('subtitle', $locale);
                                $imageUrl = $service->imageUrl();
                                $lead = \Illuminate\Support\Str::limit(strip_tags((string) $service->getTranslation('description', $locale, false)), 220);
                            @endphp
                            <article
                                id="service-panel-{{ $service->slug }}"
                                class="sky-service-panel w-full relative @if ($index === 0) is-active @endif"
                                role="tabpanel"
                                aria-labelledby="service-tab-{{ $service->slug }}"
                                @if ($index !== 0) hidden @endif
                            >
                                <div class="w-full relative">
                                    <div class="lqd-fb pos-rel lqd-fb-style-1 lqd-fb-style-1-3 lqd-fb-content-overlay lqd-fb-zoom-img-onhover border-radius-4 overflow-hidden h-pt-60 mb-65" data-inview="true">
                                        <div class="lqd-fb-inner lqd-overlay">
                                            <div class="lqd-fb-img lqd-overlay overflow-hidden">
                                                <figure class="w-full h-full">
                                                    <img class="w-full h-full objfit-cover objpos-center" src="{{ $imageUrl }}" alt="{{ $title }}" width="1200" height="720" loading="lazy">
                                                </figure>
                                            </div>
                                            <div class="lqd-fb-content lqd-overlay d-flex items-end">
                                                <div class="lqd-fb-bg lqd-overlay bg-transparent" style="background-image: linear-gradient(180deg, #181B3100 0%, #181B31 100%);"></div>
                                                <div class="lqd-fb-hover-overlay lqd-overlay"></div>
                                                <div class="lqd-fb-content-inner d-flex flex-col justify-between relative h-full w-full p-1/5rem">
                                                    @if ($subtitle && trim($subtitle) !== '')
                                                        <div class="lqd-fb-content-top">
                                                            <h6 class="mt-0 mb-0 text-white">{{ $subtitle }}</h6>
                                                        </div>
                                                    @endif
                                                    <div class="lqd-fb-content-bottom">
                                                        <h2 class="lqd-fb__title mt-0 mb-2 font-semibold text-white">{{ $title }}</h2>
                                                        @if ($lead !== '')
                                                            <p class="mt-0 mb-3 text-white-80">{{ $lead }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full relative">
                                    <h3 class="ld-fh-element relative mb-1em text-24">{{ $title }}</h3>
                                </div>
                                @include('partials.service-body', ['service' => $service])
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  var nav = document.querySelector('.sky-services-nav__list');
  if (!nav) {
    return;
  }
  var links = nav.querySelectorAll('.sky-services-nav-link');
  var panels = document.querySelectorAll('.sky-service-panel');

  function showPanel(slug) {
    links.forEach(function (l) {
      var active = l.getAttribute('data-service-slug') === slug;
      l.classList.toggle('is-active', active);
      l.setAttribute('aria-selected', active ? 'true' : 'false');
    });
    panels.forEach(function (panel) {
      var active = panel.id === 'service-panel-' + slug;
      panel.classList.toggle('is-active', active);
      if (active) {
        panel.removeAttribute('hidden');
      } else {
        panel.setAttribute('hidden', 'hidden');
      }
    });
  }

  var first = links[0];
  if (first) {
    showPanel(first.getAttribute('data-service-slug'));
  }

  links.forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      showPanel(link.getAttribute('data-service-slug'));
    });
  });
});
</script>
@endpush