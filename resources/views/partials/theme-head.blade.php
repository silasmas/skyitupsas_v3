@php
    $a = static fn (string $path) => asset('assets/'.ltrim($path, '/'));
    $rev = static fn (string $path) => asset('assetsold/plugins/revolution/'.ltrim($path, '/'));
@endphp
<link href="{{ $a('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ $rev('css/settings.css') }}" rel="stylesheet" type="text/css">
<link href="{{ $rev('css/layers.css') }}" rel="stylesheet" type="text/css">
<link href="{{ $rev('css/navigation.css') }}" rel="stylesheet" type="text/css">
<link href="{{ $a('css/style.css') }}" rel="stylesheet">
<link href="{{ $a('css/style-3.css') }}" rel="stylesheet">
<link href="{{ $a('css/sky-brand.css') }}" rel="stylesheet">
<link href="{{ $a('css/linear.css') }}" rel="stylesheet">
<link href="{{ $a('css/fontawesome.css') }}" rel="stylesheet">
<link href="{{ $a('css/flaticon.css') }}" rel="stylesheet">
<link href="{{ $a('css/animate.css') }}" rel="stylesheet">
<link href="{{ $a('css/jquery.fancybox.min.css') }}" rel="stylesheet">
<link href="{{ $a('css/swiper.min.css') }}" rel="stylesheet">
<link href="{{ $a('css/select2.min.css') }}" rel="stylesheet">
@php
    $faviconIco = public_path('assets/img/favicon/favicon.ico');
    $faviconPng = public_path('assets/img/favicon.png');
    $faviconUrl = file_exists($faviconIco)
        ? $a('img/favicon/favicon.ico')
        : (file_exists($faviconPng) ? $a('img/favicon.png') : (file_exists(public_path('assets/img/logo.png')) ? $a('img/logo.png') : $a('images/logo.png')));
@endphp
<link rel="shortcut icon" href="{{ $faviconUrl }}" type="image/x-icon">
<link rel="icon" href="{{ $faviconUrl }}" type="image/x-icon">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
