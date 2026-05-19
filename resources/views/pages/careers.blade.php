@extends('layouts.app')

@push('hub-demo-css')
<link rel="stylesheet" href="{{ asset('hub/assets/css/demo/company/company.css') }}">
<link rel="stylesheet" href="{{ asset('css/sky-careers.css') }}">
@endpush

@section('title', __('site.page_careers_title').' — '.config('app.name'))

@section('hub_body_class', 'sky-careers-page')

@section('before_content')
    @include('partials.hub-inner-titlebar', [
        'title' => __('site.page_careers_title'),
        'subtitle' => __('site.page_careers_subtitle'),
        'crumbs' => [__('site.page_careers_title')],
    ])
@endsection

@section('content')
    @php
        $contractLabels = [
            'cdi' => 'CDI',
            'cdd' => 'CDD',
            'stage' => app()->getLocale() === 'en' ? 'Internship' : 'Stage',
            'mission' => app()->getLocale() === 'en' ? 'Contract / assignment' : 'Mission / prestation',
            'freelance' => 'Freelance',
        ];
    @endphp
    <section class="lqd-section py-70">
        <div class="container">
            @if ($offers->isEmpty())
                <p class="text-center text-black-60 mb-0">{{ __('site.page_careers_empty') }}</p>
            @else
                <div class="row gap-30">
                    @foreach ($offers as $offer)
                        <div class="col col-12 col-md-6 col-lg-4">
                            <article class="rounded-6 border-1 border-black-10 bg-white p-25 h-full flex flex-col shadow-sm">
                                <h2 class="text-20 text-secondary mt-0 mb-15">{{ $offer->getTranslation('title', app()->getLocale()) }}</h2>
                                <div class="text-13 text-black-60 mb-15 flex flex-wrap gap-15">
                                    @if ($offer->contract_type)
                                        <span><strong class="text-black">{{ __('site.page_careers_contract') }}:</strong> {{ $contractLabels[$offer->contract_type] ?? $offer->contract_type }}</span>
                                    @endif
                                    @php($loc = $offer->getTranslation('location', app()->getLocale()))
                                    @if ($loc)
                                        <span><strong class="text-black">{{ __('site.page_careers_location') }}:</strong> {{ $loc }}</span>
                                    @endif
                                    @if ($offer->closes_at)
                                        <span><strong class="text-black">{{ __('site.page_careers_deadline') }}:</strong> {{ $offer->closes_at->translatedFormat('d M Y') }}</span>
                                    @endif
                                </div>
                                <div class="mt-auto pt-15 flex flex-wrap gap-10">
                                    <button
                                        type="button"
                                        class="btn btn-solid btn-sm font-bold text-secondary bg-primary rounded-4 hover:bg-secondary hover:text-white"
                                        data-sky-career-open="detail"
                                        data-sky-career-slug="{{ $offer->slug }}"
                                    >{{ __('site.page_careers_read_more') }}</button>
                                    @if ($offer->isOpenForApplications())
                                        <button
                                            type="button"
                                            class="btn btn-naked btn-sm font-bold text-secondary"
                                            data-sky-career-open="apply"
                                            data-sky-career-slug="{{ $offer->slug }}"
                                        >{{ __('site.career_apply_now') }}</button>
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @if ($offers->isNotEmpty())
        @push('modals')
            <div id="sky-career-modals-store" class="sky-career-modals-store" aria-hidden="true">
                @include('partials.career-offer-modals', ['offers' => $offers, 'contractLabels' => $contractLabels])
            </div>
        @endpush
    @endif

    @include('partials.career-modals-scripts')
@endsection
