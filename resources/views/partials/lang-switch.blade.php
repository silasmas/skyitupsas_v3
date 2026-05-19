@php
    $name = Route::currentRouteName();
    $route = Route::current();
    $params = ($name && $route) ? $route->parameters() : [];
    $labels = ['fr' => 'FR', 'en' => 'EN'];
@endphp

<div class="sky-lang-switch {{ $class ?? '' }}">
    @foreach (config('app.available_locales', ['fr', 'en']) as $loc)
        @php
            $url = $name ? route($name, array_merge($params, ['locale' => $loc])) : url('/'.$loc);
        @endphp
        <a
            href="{{ $url }}"
            hreflang="{{ $loc }}"
            class="@if (app()->getLocale() === $loc) is-active @endif"
        >{{ $labels[$loc] ?? strtoupper($loc) }}</a>
    @endforeach
</div>
