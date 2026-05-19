@extends('layouts.app')

@push('hub-demo-css')
<link rel="stylesheet" href="{{ asset('hub/assets/css/demo/company/company.css') }}">
@endpush

@section('title', __('site.page_team_title').' — '.config('app.name'))

@section('hub_body_class', 'sky-team-page')

@php
    $skyM = static fn (string $key): string => asset('assets/img/'.config('sky.site_media.'.$key));
@endphp

@section('before_content')
    @include('partials.hub-inner-titlebar', [
        'title' => __('site.page_team_title'),
        'subtitle' => __('site.page_team_intro'),
        'crumbs' => [__('site.page_team_title')],
    ])
@endsection

@section('content')
    <section class="lqd-section team py-70">
        <div class="container">
            <div class="row">
                @forelse ($members as $idx => $member)
                    @php
                        $mediaKey = 'news_'.(($idx % 3) + 1);
                        $teamImg = $skyM($mediaKey);
                        if ($member->picture && file_exists(public_path('assets/img/'.$member->picture))) {
                            $teamImg = asset('assets/img/'.$member->picture);
                        }
                    @endphp
                    <div class="col col-12 col-md-6 col-lg-4 flex flex-col items-start text-start p-20 mb-30">
                        <img class="mb-1em w-full rounded-4 object-cover" width="660" height="492" src="{{ $teamImg }}" alt="{{ $member->name }}" loading="lazy">
                        <h3 class="ld-fh-element relative mb-0/5em text-24 font-bold text-secondary m-0">{{ $member->name }}</h3>
                        <div class="ld-fancy-heading p-5 mb-0/6em bg-accent rounded-6">
                            <h6 class="ld-fh-element relative p-5 mb-0/5em text-10 uppercase font-normal leading-1em tracking-1 text-gray-400 m-0">{{ $member->role }}</h6>
                        </div>
                        @if (filled($member->bio))
                            <p class="ld-fh-element relative mb-0 text-15 leading-1/6em text-black-60">{{ $member->bio }}</p>
                        @endif
                    </div>
                @empty
                    <div class="col col-12 text-center text-black-60">
                        <p class="mb-0">{{ __('site.page_team_empty') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
