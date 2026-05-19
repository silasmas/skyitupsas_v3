@php
    $sky = config('sky');
    $logoMark = public_path('assets/img/logo.png');
    $logoText = public_path('assets/img/logo_text.png');
    $logoMarkUrl = file_exists($logoMark) ? asset('assets/img/logo.png') : null;
    $logoTextUrl = file_exists($logoText) ? asset('assets/img/logo_text.png') : null;
@endphp

<footer class="main-footer">
    <div class="auto-container">
        <div class="upper-box">
            <div class="row">
                <div class="contact-info logo-box col-lg-4 col-md-12 wow fadeInUp text-center">
                    <div class="logo">
                        <a href="{{ route('home') }}" class="sky-logo-link justify-content-center">
                            @if ($logoTextUrl)
                                <img src="{{ $logoTextUrl }}" alt="{{ config('app.name') }}" class="sky-logo-wordmark-only" style="max-height: 56px;">
                            @elseif ($logoMarkUrl)
                                <img src="{{ $logoMarkUrl }}" alt="{{ config('app.name') }}" class="sky-logo-mark-only" style="max-height: 64px;">
                            @else
                                <span class="text-white fw-bold">{{ config('app.name') }}</span>
                            @endif
                        </a>
                    </div>
                </div>
                <div class="contact-info col-lg-4 col-md-12 wow fadeInRight">
                    <div class="inner-box">
                        <h4 class="title">{{ __('site.footer_email') }}</h4>
                        <div class="text"><a href="mailto:{{ $sky['email'] }}">{{ $sky['email'] }}</a></div>
                    </div>
                </div>
                <div class="contact-info col-lg-4 col-md-12 wow fadeInLeft" data-wow-delay="600ms">
                    <div class="inner-box">
                        <h4 class="title">{{ __('site.footer_phone') }}</h4>
                        <div class="text"><a href="tel:{{ $sky['phone_href'] }}">{{ $sky['phone'] }}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="widgets-section">
        <div class="auto-container">
            <div class="row">
                <div class="footer-column col-xl-5 col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-xl-7 col-lg-6 col-md-6">
                            <div class="footer-widget about-widget">
                                <h6 class="widget-title">{{ __('site.footer_about') }}</h6>
                                <div class="text">
                                    @if (app()->getLocale() === 'en')
                                        SKY IT UP supports organizations with digital solutions, consulting, and technical assistance. Replace this text with your institutional content.
                                    @else
                                        SKY IT UP accompagne les organisations avec des solutions numériques, du conseil et de l'assistance technique. Remplacez ce texte par votre contenu institutionnel.
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-6">
                            <div class="footer-widget">
                                <h6 class="widget-title">{{ __('site.footer_links') }}</h6>
                                <ul class="user-links">
                                    <li><a href="{{ route('home') }}">{{ __('site.nav_home') }}</a></li>
                                    <li><a href="{{ route('about') }}">{{ __('site.nav_about') }}</a></li>
                                    <li><a href="{{ route('services') }}">{{ __('site.nav_services') }}</a></li>
                                    <li><a href="{{ route('realisations') }}">{{ __('site.nav_realisations') }}</a></li>
                                    <li><a href="{{ route('contact') }}">{{ __('site.nav_contact') }}</a></li>
                                    <li><a href="{{ url('/admin') }}">{{ __('site.footer_admin') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-column col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="footer-widget contacts-widget">
                        <h6 class="widget-title">{{ __('site.footer_contact') }}</h6>
                        <div class="text">{{ $sky['address'] }}</div>
                        <ul class="social-icon-two">
                            <li><a href="{{ $sky['social']['facebook'] }}" rel="noopener noreferrer" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="{{ $sky['social']['twitter'] }}" rel="noopener noreferrer" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="{{ $sky['social']['instagram'] }}" rel="noopener noreferrer" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="{{ $sky['social']['linkedin'] }}" rel="noopener noreferrer" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="footer-column col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="footer-widget">
                        <h6 class="widget-title">{{ __('site.footer_newsletter') }}</h6>
                        <div class="widget-content">
                            <div class="subscribe-form">
                                <div class="text">{{ __('site.footer_newsletter_hint') }}</div>
                                <form method="post" action="#">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="email" value="" placeholder="{{ __('site.footer_email_placeholder') }}" required>
                                        <button type="button" class="theme-btn"><span class="btn-title"><i class="fa fa-paper-plane"></i></span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-container">
                <div class="copyright-text">
                    <p>© {{ date('Y') }} <a href="{{ route('home') }}">{{ config('app.name') }}</a>. {{ __('site.footer_rights') }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
