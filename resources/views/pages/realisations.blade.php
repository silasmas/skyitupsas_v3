@extends('layouts.app')

@push('hub-demo-css')
<link rel="stylesheet" href="{{ asset('hub/assets/css/demo/company/company.css') }}">
@endpush

@section('title', __('site.page_realisations_title').' — '.config('app.name'))

@section('before_content')
    @include('partials.hub-inner-titlebar', [
        'title' => __('site.page_realisations_title'),
        'crumbs' => [__('site.page_realisations_title')],
    ])
@endsection

@section('content')
    <section class="lqd-section py-80">
        <div class="container">
            <div class="row justify-center mb-40">
                <div class="col col-12 col-lg-10 text-center">
                    <p class="text-18 text-black-60 leading-relaxed mb-0">{{ __('site.page_realisations_intro') }}</p>
                </div>
            </div>
            <div class="row">
                @forelse ($realisations ?? [] as $realisation)
                    <div class="col col-12 col-md-6 col-lg-4 mb-30">
                        <article class="flex flex-col h-full rounded-6 overflow-hidden border-1 border-black-10 bg-white shadow-sm">
                            @if ($realisation->featured_image && file_exists(public_path('assets/img/'.$realisation->featured_image)))
                                <a href="{{ route('contact') }}" class="block">
                                    <img src="{{ asset('assets/img/'.$realisation->featured_image) }}" alt="" class="w-full h-auto object-cover" width="640" height="400" loading="lazy">
                                </a>
                            @else
                                <div class="bg-gray-100 aspect-ratio-16-9" style="aspect-ratio: 16/10;"></div>
                            @endif
                            <div class="p-25 flex flex-col flex-grow-1">
                                <h3 class="text-18 font-bold text-secondary mb-10 m-0">{{ $realisation->title }}</h3>
                                @if ($realisation->client)
                                    <p class="text-12 text-black-50 uppercase mb-10 m-0">{{ $realisation->client }}</p>
                                @endif
                                <p class="text-14 text-black-60 mb-20 flex-grow-1">{{ \Illuminate\Support\Str::limit(strip_tags((string) $realisation->description), 200) }}</p>
                                <a href="{{ route('contact') }}" class="btn btn-naked text-secondary font-bold p-0 justify-start">{{ __('site.nav_contact') }} →</a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col col-12 text-center">
                        <p class="text-black-60">{{ __('site.realisations_empty') }}</p>
                        <a href="{{ route('contact') }}" class="btn btn-solid btn-md font-bold text-secondary bg-primary rounded-4 hover:bg-secondary hover:text-white mt-20">{{ __('site.nav_contact') }}</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
