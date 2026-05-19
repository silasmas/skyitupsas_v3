@php
    $h = static fn (string $path) => asset('hub/assets/'.ltrim($path, '/'));
    $favDir = public_path('assets/img/favicon');
    $favIco = file_exists($favDir.'/favicon.ico') ? asset('assets/img/favicon/favicon.ico') : null;
    $fav16 = file_exists($favDir.'/favicon-16x16.png') ? asset('assets/img/favicon/favicon-16x16.png') : null;
    $fav32 = file_exists($favDir.'/favicon-32x32.png') ? asset('assets/img/favicon/favicon-32x32.png') : null;
    $favApple = file_exists($favDir.'/apple-touch-icon.png') ? asset('assets/img/favicon/apple-touch-icon.png') : null;
    $favManifest = file_exists($favDir.'/site.webmanifest') ? asset('assets/img/favicon/site.webmanifest') : null;
    $fallbackLogo = file_exists(public_path('assets/img/logo.png')) ? asset('assets/img/logo.png') : null;
@endphp

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@php
    $isEn = app()->getLocale() === 'en';
@endphp

@if($isEn)
    <meta name="keywords" content="IT Services, Cloud, Migration, Microsoft 365, Digital, Transformation, Cybersecurity, Consulting, Support, Managed Services, France, Europe, SMB, Business Continuity">
    <meta name="author" content="SkyITup SAS">
    <meta name="description" content="SkyITup, specialist in IT services and cloud, supporting companies on Microsoft 365, cybersecurity, migration, digital transformation, and managed services. Tailored support for your business in France and Europe.">
    <meta property="og:title" content="SkyITup — IT & Cloud Services for Businesses">
    <meta property="og:description" content="SkyITup provides IT consulting, Microsoft 365, cloud migration, cybersecurity and managed services for SMBs and enterprises. Your trusted IT partner.">
@else
    <meta name="keywords" content="Services IT, Cloud, Migration, Microsoft 365, Transformation digitale, Cybersécurité, Conseil, Support, Infogérance, France, Europe, PME, Continuité d'activité">
    <meta name="author" content="SkyITup SAS">
    <meta name="description" content="SkyITup, spécialiste des services informatiques et du cloud, accompagne les entreprises sur Microsoft 365, la cybersécurité, la migration, la transformation digitale et l’infogérance. Un support sur-mesure en France et en Europe.">
    <meta property="og:title" content="SkyITup — Services IT & Cloud pour entreprises">
    <meta property="og:description" content="SkyITup propose conseil informatique, Microsoft 365, migration cloud, cybersécurité et infogérance pour PME et grandes entreprises. Votre partenaire informatique de confiance.">
@endif
<meta property="og:type" content="website">
@php($ogRel = config('sky.site_media.og'))
<meta property="og:image" content="{{ $ogRel && file_exists(public_path('assets/img/'.$ogRel)) ? asset('assets/img/'.$ogRel) : asset('hub/assets/images/common/og-image.jpg') }}">

<link rel="stylesheet" href="{{ $h('vendors/liquid-icon/lqd-essentials/lqd-essentials.min.css') }}">
<link rel="stylesheet" href="{{ $h('css/theme.min.css') }}">
<link rel="stylesheet" href="{{ $h('css/utility.min.css') }}">
<link rel="stylesheet" href="{{ $h('css/demo/company/base.css') }}">
<link rel="stylesheet" href="{{ $h('css/demo/company/company.css') }}">

{{-- Pages internes : company-*.css (via @push) --}}


<link rel="stylesheet" href="{{ $h('css/sky-hub-bridge.css') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">

@if ($favApple)
<link rel="apple-touch-icon" sizes="180x180" href="{{ $favApple }}">
@endif
@if ($fav32)
<link rel="icon" type="image/png" sizes="32x32" href="{{ $fav32 }}">
@endif
@if ($fav16)
<link rel="icon" type="image/png" sizes="16x16" href="{{ $fav16 }}">
@endif
@if ($favIco)
<link rel="shortcut icon" href="{{ $favIco }}" type="image/x-icon">
<link rel="icon" href="{{ $favIco }}" type="image/x-icon">
@elseif ($fallbackLogo)
<link rel="icon" href="{{ $fallbackLogo }}" type="image/png">
@endif
@if ($favManifest)
<link rel="manifest" href="{{ $favManifest }}">
@endif

<meta http-equiv="X-UA-Compatible" content="IE=edge">
