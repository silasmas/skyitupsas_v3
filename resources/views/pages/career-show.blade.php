@extends('layouts.app')

@push('hub-demo-css')
<link rel="stylesheet" href="{{ asset('hub/assets/css/demo/company/company.css') }}">
@endpush

@section('title', ($pageTitle ?? __('site.page_careers_title')).' — '.config('app.name'))

@section('hub_body_class', 'sky-career-show-page')

@section('before_content')
    @include('partials.hub-inner-titlebar', [
        'title' => $job->getTranslation('title', app()->getLocale()),
        'subtitle' => __('site.page_careers_apply_kicker'),
        'crumbs' => [__('site.page_careers_title'), $job->getTranslation('title', app()->getLocale())],
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
    <section class="lqd-section py-50">
        <div class="container">
            <p class="mb-30 flex flex-wrap items-center gap-20">
                <a href="{{ route('careers') }}" class="text-secondary font-semibold hover:text-primary">{{ __('site.page_careers_back') }}</a>
                @if ($acceptingApplications)
                    <a href="#postuler" class="btn btn-solid btn-sm font-bold text-secondary bg-primary rounded-4 hover:bg-secondary hover:text-white" data-localscroll="true">{{ __('site.career_apply_now') }}</a>
                @endif
            </p>
            <div class="row">
                <div class="col col-12 col-lg-7 mb-40 lg:mb-0">
                    <div class="text-13 text-black-60 mb-20 flex flex-wrap gap-20">
                        @if ($job->contract_type)
                            <span><strong class="text-black">{{ __('site.page_careers_contract') }}:</strong> {{ $contractLabels[$job->contract_type] ?? $job->contract_type }}</span>
                        @endif
                        @php($loc = $job->getTranslation('location', app()->getLocale()))
                        @if ($loc)
                            <span><strong class="text-black">{{ __('site.page_careers_location') }}:</strong> {{ $loc }}</span>
                        @endif
                        @if ($job->closes_at)
                            <span><strong class="text-black">{{ __('site.page_careers_deadline') }}:</strong> {{ $job->closes_at->translatedFormat('d M Y, H:i') }}</span>
                        @endif
                    </div>
                    <div class="prose prose-sm max-w-none text-black-70">
                        {!! $job->getTranslation('description', app()->getLocale()) !!}
                    </div>
                    @php($req = $job->getTranslation('requirements', app()->getLocale()))
                    @if ($req)
                        <h3 class="text-18 text-secondary mt-40 mb-15">{{ app()->getLocale() === 'en' ? 'Requirements' : 'Profil recherché' }}</h3>
                        <div class="prose prose-sm max-w-none text-black-70">
                            {!! $req !!}
                        </div>
                    @endif
                </div>
                <div class="col col-12 col-lg-4 offset-lg-1" id="postuler">
                    <div class="p-30 rounded-6 border-1 border-black-10 bg-white shadow-md lg:sticky lg:top-100">
                        <h3 class="text-20 text-secondary mt-0 mb-20">{{ __('site.career_form_title') }}</h3>

                        @if (session('career_success'))
                            <p class="text-green-700 font-semibold mb-0">{{ __('site.career_form_success') }}</p>
                        @elseif (! $acceptingApplications)
                            <p class="text-black-60 mb-0">{{ __('site.career_form_closed') }}</p>
                        @else
                            @if ($errors->any())
                                <div class="mb-20 text-14 text-red-600" role="alert">
                                    <ul class="m-0 pl-20">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="post" action="{{ route('careers.apply', ['locale' => app()->getLocale(), 'jobOffer' => $job->slug]) }}" enctype="multipart/form-data" class="flex flex-col gap-15">
                                @csrf
                                <div>
                                    <label class="block text-12 text-black-50 mb-5" for="career-first-name">{{ __('site.career_first_name') }}</label>
                                    <input id="career-first-name" class="w-full rounded-4 border-1 border-black-10 px-15 py-12 text-14" type="text" name="first_name" value="{{ old('first_name') }}" required autocomplete="given-name">
                                </div>
                                <div>
                                    <label class="block text-12 text-black-50 mb-5" for="career-last-name">{{ __('site.career_last_name') }}</label>
                                    <input id="career-last-name" class="w-full rounded-4 border-1 border-black-10 px-15 py-12 text-14" type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name">
                                </div>
                                <div>
                                    <label class="block text-12 text-black-50 mb-5" for="career-email">{{ __('site.career_email') }}</label>
                                    <input id="career-email" class="w-full rounded-4 border-1 border-black-10 px-15 py-12 text-14" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                                <div>
                                    <label class="block text-12 text-black-50 mb-5" for="career-phone">{{ __('site.career_phone') }}</label>
                                    <input id="career-phone" class="w-full rounded-4 border-1 border-black-10 px-15 py-12 text-14" type="text" name="phone" value="{{ old('phone') }}" autocomplete="tel">
                                </div>
                                <div>
                                    <label class="block text-12 text-black-50 mb-5" for="career-linkedin">{{ __('site.career_linkedin') }}</label>
                                    <input id="career-linkedin" class="w-full rounded-4 border-1 border-black-10 px-15 py-12 text-14" type="url" name="linkedin_url" value="{{ old('linkedin_url') }}" placeholder="https://">
                                </div>
                                <div>
                                    <label class="block text-12 text-black-50 mb-5" for="career-cover">{{ __('site.career_cover') }}</label>
                                    <textarea id="career-cover" class="w-full rounded-4 border-1 border-black-10 px-15 py-12 text-14 min-h-120" name="cover_letter">{{ old('cover_letter') }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-12 text-black-50 mb-5" for="career-cv">{{ __('site.career_cv') }}</label>
                                    <input id="career-cv" class="w-full text-14" type="file" name="cv" accept=".pdf,application/pdf" required>
                                </div>
                                <div class="flex items-start gap-10">
                                    <input id="career-privacy" type="checkbox" name="consent_privacy" value="1" {{ old('consent_privacy') ? 'checked' : '' }} required class="mt-5">
                                    <label for="career-privacy" class="text-13 text-black-60 leading-normal">{{ __('site.career_privacy') }}</label>
                                </div>
                                <button type="submit" class="btn btn-solid font-bold text-secondary bg-primary rounded-4 hover:bg-secondary hover:text-white py-12">{{ __('site.career_submit') }}</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
