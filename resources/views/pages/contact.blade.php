@extends('layouts.app')

@push('hub-demo-css')
<link rel="stylesheet" href="{{ asset('hub/assets/css/demo/company/company-contact.css') }}">
@endpush

@section('title', __('site.page_contact_title').' — '.config('app.name'))

@section('before_content')
    @include('partials.hub-inner-titlebar', [
        'title' => __('site.page_contact_title'),
        'crumbs' => [__('site.page_contact_title')],
    ])
@endsection

@section('content')
    @php
        $cPhone = $contact?->phone ?? config('sky.phone');
        $cPhoneHref = $contact?->phone ? preg_replace('/\s+/', '', $contact->phone) : config('sky.phone_href');
        $cEmail = $contact?->email ?? config('sky.email');
        $cAddress = $contact?->address ?? config('sky.address');
    @endphp
    <section class="lqd-section py-70">
        <div class="container">
            <div class="row items-start">
                <div class="col col-12 col-lg-5 mb-40 lg:mb-0">
                    <h6 class="text-secondary uppercase font-bold tracking-1 mb-10">{{ __('site.footer_contact') }}</h6>
                    <h2 class="mb-20">{{ $contact?->title ?? (app()->getLocale() === 'en' ? 'Let’s talk about your project' : 'Parlons de votre projet') }}</h2>
                    <p class="text-black-60 mb-30">
                        {{ $contact?->description ?? (app()->getLocale() === 'en'
                            ? 'Call or write to us — we respond as soon as possible.'
                            : 'Appelez-nous ou écrivez-nous — nous répondons dans les meilleurs délais.') }}
                    </p>
                    <div class="iconbox items-start mb-25">
                        <div class="iconbox-icon-wrap mr-15"><i class="lqd-icn-ess icon-ion-ios-telephone text-20 text-secondary" aria-hidden="true"></i></div>
                        <div>
                            <div class="text-12 text-black-50 uppercase mb-5">{{ __('site.footer_phone') }}</div>
                            <a href="tel:{{ $cPhoneHref }}" class="text-16 font-semibold text-secondary">{{ $cPhone }}</a>
                        </div>
                    </div>
                    <div class="iconbox items-start mb-25">
                        <div class="iconbox-icon-wrap mr-15 text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></div>
                        <div>
                            <div class="text-12 text-black-50 uppercase mb-5">{{ __('site.footer_email') }}</div>
                            <a href="mailto:{{ $cEmail }}" class="text-16 font-semibold text-secondary break-all">{{ $cEmail }}</a>
                        </div>
                    </div>
                    <div class="iconbox items-start">
                        <div class="iconbox-icon-wrap mr-15 text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 384 512"><path d="M384 192c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192z"/></svg></div>
                        <div>
                            <div class="text-12 text-black-50 uppercase mb-5">{{ app()->getLocale() === 'en' ? 'Address' : 'Adresse' }}</div>
                            <p class="text-16 mb-0 text-black-70">{{ $cAddress }}</p>
                        </div>
                    </div>
                </div>
                <div class="col col-12 offset-lg-1 col-lg-6">
                    <div class="p-35 rounded-6 shadow-md bg-white border-1 border-black-10">
                        <h3 class="mb-10">{{ app()->getLocale() === 'en' ? 'Send a message' : 'Envoyez un message' }}</h3>
                        <p class="text-black-60 text-14 mb-25">{{ __('site.contact_page_form_lead') }}</p>
                        @include('partials.contact-form', [
                            'source' => \App\Models\ContactMessage::SOURCE_CONTACT_PAGE,
                            'variant' => 'contact-page',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
