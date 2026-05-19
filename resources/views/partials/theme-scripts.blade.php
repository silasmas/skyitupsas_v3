@php
    $a = static fn (string $path) => asset('assets/'.ltrim($path, '/'));
    $rev = static fn (string $path) => asset('assetsold/plugins/revolution/'.ltrim($path, '/'));
@endphp
<script>window.__revPluginJs = @json(rtrim($rev('js'), '/').'/');</script>
<script src="{{ $a('js/jquery.js') }}"></script>
<script src="{{ $a('js/popper.min.js') }}"></script>
<script src="{{ $rev('js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ $rev('js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ $rev('js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ $rev('js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ $rev('js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ $rev('js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ $rev('js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ $rev('js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ $rev('js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ $rev('js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ $rev('js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ $a('js/main-slider-script.js') }}"></script>
<script src="{{ $a('js/bootstrap.min.js') }}"></script>
<script src="{{ $a('js/jquery.fancybox.js') }}"></script>
<script src="{{ $a('js/jquery-ui.js') }}"></script>
<script src="{{ $a('js/wow.js') }}"></script>
<script src="{{ $a('js/appear.js') }}"></script>
<script src="{{ $a('js/select2.min.js') }}"></script>
<script src="{{ $a('js/swiper.min.js') }}"></script>
<script src="{{ $a('js/owl.js') }}"></script>
<script src="{{ $a('js/script.js') }}"></script>
