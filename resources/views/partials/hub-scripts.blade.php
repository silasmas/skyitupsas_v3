@php
    $h = static fn (string $path) => asset('hub/assets/'.ltrim($path, '/'));
@endphp

<template id="lqd-temp-sticky-header-sentinel">
    <div class="lqd-sticky-sentinel invisible absolute pointer-events-none"></div>
</template>

<script src="{{ $h('vendors/jquery.min.js') }}"></script>
<script src="{{ $h('vendors/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ $h('vendors/gsap/minified/gsap.min.js') }}"></script>
<script src="{{ $h('vendors/gsap/utils/SplitText.min.js') }}"></script>
<script src="{{ $h('vendors/gsap/minified/ScrollTrigger.min.js') }}"></script>
<script src="{{ $h('vendors/fastdom/fastdom.min.js') }}"></script>
<script src="{{ $h('vendors/flickity/flickity.pkgd.min.js') }}"></script>
<script src="{{ $h('vendors/flickity/flickity-fade.min.js') }}"></script>
<script src="{{ $h('vendors/lity/lity.min.js') }}"></script>
<script src="{{ $h('vendors/fresco/js/fresco.js') }}"></script>
<script src="{{ $h('vendors/fontfaceobserver.js') }}"></script>
<script src="{{ $h('js/liquid-gdpr.min.js') }}"></script>
<script src="{{ $h('js/liquid-ajax-contact-form.min.js') }}"></script>
<script src="{{ $h('js/theme.min.js') }}"></script>
