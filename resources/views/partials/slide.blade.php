@php
    $slideImage = static function (string $file, string $seed): string {
        $path = public_path('assets/images/main-slider/'.$file);

        return file_exists($path)
            ? asset('assets/images/main-slider/'.$file)
            : 'https://picsum.photos/seed/'.$seed.'/1920/840';
    };

    $slides = [
        [
            'index' => 'rs-1',
            'img' => $slideImage('1.jpg', 'skyitup1'),
            'kicker' => 'Consulting',
            'title' => "Approche axée sur l'objectivité<br>et les résultats",
            'text' => 'SkyITup offre de véritables solutions de travail en matière de conseil en technologie digitale.',
            'primary' => ['label' => 'Contactez-nous', 'href' => route('contact')],
            'secondary' => ['label' => 'À propos', 'href' => route('about')],
        ],
        [
            'index' => 'rs-2',
            'img' => $slideImage('2.jpg', 'skyitup2'),
            'kicker' => 'Computing',
            'title' => 'Solutions numériques<br>et logiciels',
            'text' => 'Implémentation des solutions logicielles et organisationnelles dédiées aux activités de nos clients.',
            'primary' => ['label' => 'Contactez-nous', 'href' => route('contact')],
            'secondary' => ['label' => 'Services', 'href' => route('services')],
        ],
        [
            'index' => 'rs-3',
            'img' => $slideImage('3.jpg', 'skyitup3'),
            'kicker' => 'Maintenance',
            'title' => 'Services<br>matériels',
            'text' => "Adaptez notre processus d'approvisionnement à vos besoins et économisez du temps et de l'argent.",
            'primary' => ['label' => '', 'href' => route('realisations')],
            'secondary' => ['label' => 'Contact', 'href' => route('contact')],
        ],
    ];
    $sky = config('sky');
@endphp

<section class="main-slider sky-main-slider">
    <div class="rev_slider_wrapper fullwidthbanner-container" id="rev_slider_one_wrapper" data-source="gallery">
        <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
            <ul>
                @foreach ($slides as $slide)
                    <li data-index="{{ $slide['index'] }}" data-transition="zoomout">
                        <img src="{{ $slide['img'] }}" alt="" class="rev-slidebg">

                        {{-- Kicker : plus haut pour ne pas chevaucher le titre --}}
                        <div class="tp-caption"
                            data-paddingbottom="[0,0,0,0]"
                            data-paddingleft="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]"
                            data-paddingtop="[0,0,0,0]"
                            data-responsive_offset="on"
                            data-type="text"
                            data-height="none"
                            data-width="['920','820','640','520']"
                            data-whitespace="normal"
                            data-hoffset="['0','0','0','0']"
                            data-voffset="['-218','-200','-182','-168']"
                            data-x="['center','center','center','center']"
                            data-y="['middle','middle','middle','middle']"
                            data-textalign="['center','center','center','center']"
                            data-frames='[{"delay":800,"speed":1200,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <span class="sub-title text-white sky-slide-kicker">{{ $slide['kicker'] }}</span>
                        </div>

                        <div class="tp-caption"
                            data-paddingbottom="[0,0,0,0]"
                            data-paddingleft="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]"
                            data-paddingtop="[0,0,0,0]"
                            data-responsive_offset="on"
                            data-type="text"
                            data-height="none"
                            data-width="['920','820','640','520']"
                            data-whitespace="normal"
                            data-hoffset="['0','0','0','0']"
                            data-voffset="['-118','-102','-88','-72']"
                            data-x="['center','center','center','center']"
                            data-y="['middle','middle','middle','middle']"
                            data-textalign="['center','center','center','center']"
                            data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <h1 class="sky-slide-title">{!! $slide['title'] !!}</h1>
                        </div>

                        <div class="tp-caption"
                            data-paddingbottom="[0,0,0,0]"
                            data-paddingleft="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]"
                            data-paddingtop="[0,0,0,0]"
                            data-responsive_offset="on"
                            data-type="text"
                            data-height="none"
                            data-width="['720','680','560','480']"
                            data-whitespace="normal"
                            data-hoffset="['0','0','0','0']"
                            data-voffset="['42','52','58','64']"
                            data-x="['center','center','center','center']"
                            data-y="['middle','middle','middle','middle']"
                            data-textalign="['center','center','center','center']"
                            data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="text sky-slide-desc">{{ $slide['text'] }}</div>
                        </div>

                        <div class="tp-caption"
                            data-paddingbottom="[0,0,0,0]"
                            data-paddingleft="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]"
                            data-paddingtop="[0,0,0,0]"
                            data-responsive_offset="on"
                            data-type="text"
                            data-height="none"
                            data-width="['720','680','600','520']"
                            data-whitespace="normal"
                            data-hoffset="['0','0','0','0']"
                            data-voffset="['168','178','192','208']"
                            data-x="['center','center','center','center']"
                            data-y="['middle','middle','middle','middle']"
                            data-textalign="['center','center','center','center']"
                            data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="btn-box sky-slide-btns">
                                <a href="{{ $slide['primary']['href'] }}" class="theme-btn btn-style-one"><span class="btn-title">@if ($slide['index'] === 'rs-3'){{ __('site.nav_realisations') }}@else{{ $slide['primary']['label'] }}@endif</span></a>
                                <a href="{{ $slide['secondary']['href'] }}" class="theme-btn btn-style-one light-bg"><span class="btn-title">{{ $slide['secondary']['label'] }}</span></a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <ul class="social-links">
        <li><a href="{{ $sky['social']['twitter'] }}" rel="noopener noreferrer" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
        <li><a href="{{ $sky['social']['facebook'] }}" rel="noopener noreferrer" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a></li>
        <li><a href="{{ $sky['social']['instagram'] }}" rel="noopener noreferrer" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
    </ul>
</section>
