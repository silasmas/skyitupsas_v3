@php
    $pageHeaderBg = file_exists(public_path('assets/images/background/5.jpg'))
        ? asset('assets/images/background/5.jpg')
        : null;
@endphp

<section class="page-title" @if ($pageHeaderBg) style="background-image: url({{ $pageHeaderBg }})" @endif>
    <div class="auto-container">
        <div class="inner-container" style="position: relative; z-index: 1;">
            <h1 class="title">{{ $title }}</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">{{ __('site.breadcrumb_home') }}</a></li>
                @foreach ($crumbs ?? [] as $crumb)
                    <li>{{ $crumb }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
