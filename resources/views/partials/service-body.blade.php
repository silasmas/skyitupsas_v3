@php
    $locale = app()->getLocale();
    $content = $service->getTranslation('content', $locale, false);
@endphp

@if (is_array($content) && count($content) > 0)
    <div class="sky-service-body__blocks prose prose-sm max-w-none text-black-70">
        @foreach ($content as $blockKey => $block)
            @if (is_string($block) && trim(strip_tags($block)) !== '')
                <p class="mb-20">{!! $block !!}</p>
            @elseif (is_array($block))
                @if (isset($block['text']) && is_string($block['text']))
                    <p class="mb-15 font-semibold">{!! $block['text'] !!}</p>
                @endif
                @if (isset($block['inner_title1']))
                    <h4 class="text-18 text-secondary mt-25 mb-10">{{ $block['inner_title1'] }}</h4>
                    @if (! empty($block['content1']))
                        <p class="mb-20">{!! $block['content1'] !!}</p>
                    @endif
                    @if (! empty($block['inner_title2']))
                        <h4 class="text-18 text-secondary mt-25 mb-10">{{ $block['inner_title2'] }}</h4>
                        @if (! empty($block['content2']))
                            <p class="mb-20">{!! $block['content2'] !!}</p>
                        @endif
                    @endif
                    @if (! empty($block['inner_title3']))
                        <h4 class="text-18 text-secondary mt-25 mb-10">{{ $block['inner_title3'] }}</h4>
                        @if (! empty($block['content3']))
                            <p class="mb-20">{!! $block['content3'] !!}</p>
                        @endif
                    @endif
                @else
                    <ul class="pl-20 mb-25 list-disc">
                        @foreach ($block as $itemKey => $item)
                            @if (is_string($item) && trim(strip_tags($item)) !== '')
                                <li class="mb-10">{!! $item !!}</li>
                            @elseif (is_array($item))
                                @if (! empty($item['text']))
                                    <li class="mb-10">
                                        <strong>{!! $item['text'] !!}</strong>
                                        @if (collect($item)->keys()->filter(fn ($k) => str_starts_with((string) $k, 'inner_item'))->isNotEmpty())
                                            <ul class="pl-20 mt-10 list-disc">
                                                @foreach ($item as $subKey => $subVal)
                                                    @if (str_starts_with((string) $subKey, 'inner_item') && is_string($subVal))
                                                        <li class="mb-5">{!! $subVal !!}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                @endif
            @endif
        @endforeach
    </div>
@else
    @php($desc = $service->getTranslation('description', $locale, false))
    @if ($desc)
        <div class="sky-service-body__lead prose prose-sm max-w-none text-black-70">
            {!! $desc !!}
        </div>
    @endif
@endif
