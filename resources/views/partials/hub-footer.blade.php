@php
    $sky = config('sky');
@endphp

<footer id="site-footer" class="main-footer link-white-50 link-14 bg-center bg-inherit bg-green-700 bg-no-repeat" data-sticky-footer="true" data-sticky-footer-options='{"shadow":"2"}'>
    <section class="lqd-section module-top pt-60">
        <div class="container">
            <div class="row">
                <div class="col col-12 col-xl-4">
                    <div class="mr-50 mb-30 flex flex-col">
                        <div class="mb-35">
                            <a href="{{ route('home') }}">
                                @if (file_exists(public_path('assets/img/logo_text.png')))
                                    <img src="{{ asset('assets/img/logo_text.png') }}" alt="{{ config('app.name') }}" class="sky-footer-logo" loading="lazy">
                                @elseif (file_exists(public_path('assets/img/logo.png')))
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="{{ config('app.name') }}" class="sky-footer-logo" loading="lazy">
                                @else
                                    <span class="text-white text-20 font-bold">{{ config('app.name') }}</span>
                                @endif
                            </a>
                        </div>
                        <div class="ld-fancy-heading relative">
                            <p class="mb-3em text-white opacity-50 inline-block relative">
                                {{ app()->getLocale() === 'en'
                                    ? 'Digital consulting, solutions and support for your organization.'
                                    : 'Conseil, solutions numériques et support pour votre organisation.' }}
                            </p>
                        </div>
                        <div class="module-icon -mr-10 -ml-10">
                            <ul class="reset-ul icon-list-items inline-items flex items-center mb-0">
                                <li class="mx-10 icon-list-item inline-item inline-flex">
                                    <a href="{{ $sky['social']['facebook'] }}" rel="noopener noreferrer" target="_blank" aria-label="Facebook">
                                        <span class="icon-list-icon flex">
                                            <svg class="text-24 w-25 h-25" viewBox="0 0 512 512" fill="#849493" aria-hidden="true">
                                                <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                                <li class="mx-10 icon-list-item inline-item inline-flex">
                                    <a href="{{ $sky['social']['twitter'] }}" rel="noopener noreferrer" target="_blank" aria-label="X / Twitter">
                                        <span class="icon-list-icon flex">
                                            <svg class="text-24 w-25 h-25" viewBox="0 0 512 512" fill="#849493" aria-hidden="true">
                                                <path d="M389.2 48h70.6L305.6 224.2 487 464h-162.9L277.8 336.8 169.8 464H40l168.2-182.8L42 48h166.7l99.8 114.8L389.2 48z" />
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                                <li class="mx-10 icon-list-item inline-item inline-flex">
                                    <a href="{{ $sky['social']['instagram'] }}" rel="noopener noreferrer" target="_blank" aria-label="Instagram">
                                        <span class="icon-list-icon flex">
                                            <svg class="text-24 w-25 h-25" viewBox="0 0 448 512" fill="#849493" aria-hidden="true">
                                                <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                                <li class="mx-10 icon-list-item inline-item inline-flex">
                                    <a href="{{ $sky['social']['linkedin'] }}" rel="noopener noreferrer" target="_blank" aria-label="LinkedIn">
                                        <span class="icon-list-icon flex">
                                            <svg class="text-24 w-25 h-25" viewBox="0 0 448 512" fill="#849493" aria-hidden="true">
                                                <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z" />
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-6 col-xl-4">
                    <div class="ml-60 mb-30 flex flex-col items-start sm:ml-0 module-contact">
                        <div class="ld-fancy-heading relative">
                            <h3 class="ld-fh-element mb-2em text-white text-16 inline-block relative">{{ __('site.footer_contact') }}</h3>
                        </div>
                        <div class="mb-30 pb-10 iconbox relative items-center">
                            <div class="contents flex flex-col">
                                <h3 class="lqd-iconbox-heading opacity-50 text-white text-13 font-normal leading-1em mb-0">Email</h3>
                                <p><a class="text-16 text-white hover:text-primary" href="mailto:{{ $sky['email'] }}">{{ $sky['email'] }}</a></p>
                            </div>
                        </div>
                        <div class="mb-30 pb-10 iconbox relative items-center">
                            <div class="contents flex flex-col">
                                <h3 class="lqd-iconbox-heading opacity-50 text-white text-13 font-normal leading-1em mb-0">{{ __('site.footer_phone') }}</h3>
                                <p><a class="text-16 text-white hover:text-primary" href="tel:{{ $sky['phone_href'] }}">{{ $sky['phone'] }}</a></p>
                            </div>
                        </div>
                        <div class="mb-30 pb-10 iconbox relative items-center">
                            <div class="contents flex flex-col">
                                <h3 class="lqd-iconbox-heading opacity-50 text-white text-13 font-normal leading-1em mb-0">{{ app()->getLocale() === 'en' ? 'Address' : 'Adresse' }}</h3>
                                <p class="text-16 text-white">{{ $sky['address'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-6 col-xl-4 p-0">
                    <div class="module-list">
                        <div class="container-fluid">
                            <div class="row items-start">
                                <div class="col col-12 mb-30">
                                    <div class="ld-fancy-heading relative">
                                        <h3 class="ld-fh-element mb-1em text-white text-16 inline-block relative">{{ __('site.footer_newsletter') }}</h3>
                                    </div>
                                    <p class="text-white opacity-50 text-14 mb-10">{{ __('site.footer_newsletter_hint') }}</p>
                                    <form method="post" action="{{ route('newsletter.subscribe', ['locale' => app()->getLocale()]) }}" class="sky-newsletter-form" data-sky-newsletter-form>
                                        @csrf
                                        <div class="sky-newsletter-form__row">
                                            <input
                                                type="email"
                                                name="email"
                                                class="sky-newsletter-form__input"
                                                value="{{ old('email') }}"
                                                placeholder="{{ __('site.footer_email_placeholder') }}"
                                                required
                                                autocomplete="email"
                                            >
                                            <button type="submit" class="sky-newsletter-form__btn" data-sky-newsletter-submit>
                                                <span data-sky-newsletter-submit-text>{{ __('site.newsletter_submit') }}</span>
                                                <span data-sky-newsletter-submit-loading hidden>{{ __('site.newsletter_submitting') }}</span>
                                            </button>
                                        </div>
                                        @error('email')
                                            <span class="sky-newsletter-form__error" role="alert">{{ $message }}</span>
                                        @enderror
                                    </form>
                                </div>
                                <div class="col col-12 mb-30">
                                    <div class="ld-fancy-heading relative">
                                        <h3 class="ld-fh-element mb-2em text-white text-16 inline-block relative">{{ __('site.footer_links') }}</h3>
                                    </div>
                                    <div class="lqd-fancy-menu lqd-custom-menu relative lqd-menu-td-none">
                                        <ul class="reset-ul">
                                            <li class="mb-10"><a href="{{ route('home') }}">{{ __('site.nav_home') }}</a></li>
                                            <li class="mb-10"><a href="{{ route('about') }}">{{ __('site.nav_about') }}</a></li>
                                            <li class="mb-10"><a href="{{ route('services') }}">{{ __('site.nav_services') }}</a></li>
                                            <li class="mb-10"><a href="{{ route('careers') }}">{{ __('site.nav_careers') }}</a></li>
                                            <li class="mb-10"><a href="{{ route('realisations') }}">{{ __('site.nav_realisations') }}</a></li>
                                            <li class="mb-10"><a href="{{ route('contact') }}">{{ __('site.nav_contact') }}</a></li>
                                            <li><a href="{{ url('/admin') }}">{{ __('site.footer_admin') }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lqd-section module-bottom py-30 border-top text-white-10 transition-all">
        <div class="container">
            <div class="row justify-between">
                <div class="col col-12 col-md-6">
                    <div class="ld-fancy-heading relative">
                        <p class="ld-fh-element text-13 text-white-50 inline-block relative mb-0/5em">© {{ date('Y') }} {{ config('app.name') }}. {{ __('site.footer_rights') }}</p>
                    </div>
                </div>
                <div class="col col-12 col-md-6 text-end sm:text-start">
                    <a class="text-white-50 hover:text-white text-13" href="{{ route('contact') }}">{{ __('site.nav_contact') }}</a>
                </div>
            </div>
        </div>
    </section>
</footer>
