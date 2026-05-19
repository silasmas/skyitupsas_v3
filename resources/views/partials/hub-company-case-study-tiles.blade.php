@php
    /** @var \Illuminate\Support\Collection<int, \App\Models\Service>|null $homeServices */
    $tiles = isset($homeServices) ? $homeServices->take(4) : collect();
@endphp
@forelse ($tiles as $service)
    <div class="w-25percent flex flex-auto p-10 lg:w-50percent sm:w-full">
        <div class="iconbox flex flex-grow-1 relative flex-col iconbox-default iconbox-contents-show-onhover py-25 mb-30 items-center bg-accent rounded-6 transition-bg hover:bg-secondary hover:text-secondary hover:inner-text-white lg:m-0" data-slideelement-onhover="true" data-slideelement-options="{ &quot;visibleElement&quot;:  &quot;.iconbox-icon-wrap, p, h3&quot;, &quot;hiddenElement&quot;:  &quot;.btn&quot;, &quot;alignMid&quot;:  true, &quot;triggerElement&quot;:  &quot;.iconbox&quot; }">
            <div class="iconbox-icon-wrap">
                <div class="mb-25 iconbox-icon-container inline-flex w-40 text-40">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewbox="0 0 50 50" aria-hidden="true">
                        <path d="M4.15-19.775a8.008,8.008,0,0,0,5.908-2.466A8.072,8.072,0,0,0,12.5-28.125V-42.48L18.115-37.7l1.465-1.66L11.67-46.24,3.76-39.355,5.225-37.7,10.4-42.48v14.355a6.082,6.082,0,0,1-1.782,4.443A6.017,6.017,0,0,1,4.15-21.875H-6.25a5.843,5.843,0,0,0-3.223.977,10.241,10.241,0,0,0-2.661,2.515,12.919,12.919,0,0,0-1.807,3.369,10.428,10.428,0,0,0-.659,3.54v6.25h2.1v-6.25a10.192,10.192,0,0,1,1.807-5.469q1.807-2.832,4.443-2.832Zm-25-25h25v-2.1h-25a4,4,0,0,0-2.93,1.221A4,4,0,0,0-25-42.725v41.7A4,4,0,0,0-23.779,1.9a4,4,0,0,0,2.93,1.221v-2.1A2.013,2.013,0,0,1-22.339.464,2.013,2.013,0,0,1-22.9-1.025v-41.7a2.013,2.013,0,0,1,.562-1.489A2.013,2.013,0,0,1-20.85-44.775Zm6.25,47.9h2.1v-4.15h-2.1Zm.83-32.52L-10.4-32.91l3.32,3.516,1.66-1.66-3.516-3.32L-5.42-37.7l-1.66-1.66L-10.4-35.84l-3.369-3.516-1.66,1.66,3.564,3.32-3.564,3.32ZM15.82-14.355,12.5-10.84,9.18-14.355,7.52-12.7l3.516,3.32L7.52-6.055l1.66,1.66L12.5-7.91l3.32,3.516,1.66-1.66-3.516-3.32L17.48-12.7ZM22.9-42.725H25a4,4,0,0,0-1.221-2.93,4,4,0,0,0-2.93-1.221h-2.1v2.1h2.1a2.013,2.013,0,0,1,1.489.562A2.013,2.013,0,0,1,22.9-42.725Zm0,41.7A2.013,2.013,0,0,1,22.339.464,2.013,2.013,0,0,1,20.85,1.025H-6.25v2.1h27.1A4,4,0,0,0,23.779,1.9,4,4,0,0,0,25-1.025v-29.2H22.9Zm0-33.35H25v-4.15H22.9Z" transform="translate(25 46.875)" fill="#184341"></path>
                    </svg>
                </div>
            </div>
            <h3 class="lqd-iconbox-heading text-center text-16 leading-1em mb-0 inner-text-white px-10">{{ $service->title }}</h3>
            @if ($service->description)
                <p class="text-13 text-center text-white-80 mb-10 px-10 m-0">{{ \Illuminate\Support\Str::limit(strip_tags((string) $service->description), 140) }}</p>
            @endif
            <a href="{{ route('services').'#service-'.$service->slug }}" class="btn btn-naked btn-icon-right btn-hover-swp mt-em mb-0 items-center text-15 font-bold text-white hover:text-primary">
                <span class="btn-txt" data-text="{{ __('site.home_case_learn') }}">{{ __('site.home_case_learn') }}</span>
                <span class="btn-icon text-16 tracking-0">
                    <i class="lqd-icn-ess icon-md-arrow-round-forward-2"></i>
                </span>
                <span class="btn-icon mr-10 text-16 tracking-0">
                    <i class="lqd-icn-ess icon-md-arrow-round-forward-2"></i>
                </span>
            </a>
        </div>
    </div>
@empty
    <div class="w-full text-center text-black-60 py-20">
        <p class="mb-0">{{ __('site.home_case_empty') }}</p>
    </div>
@endforelse
