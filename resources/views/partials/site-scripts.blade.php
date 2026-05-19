@push('head')
<link rel="stylesheet" href="{{ asset('css/sky-site.css') }}">
@endpush

<script>
    window.skySite = {
        searchUrl: @json(route('search', ['locale' => app()->getLocale()])),
        showToast: @json(session('site_toast') === true),
        locale: @json(app()->getLocale()),
        i18n: {
            searchLoading: @json(__('site.search_loading')),
            searchEmpty: @json(__('site.search_empty')),
            searchError: @json(__('site.search_error')),
            searchTypeService: @json(__('site.search_type_service')),
            searchTypeRealisation: @json(__('site.search_type_realisation')),
            searchTypeJob: @json(__('site.search_type_job')),
            searchTypePage: @json(__('site.search_type_page')),
        },
    };
</script>
<script src="{{ asset('js/sky-site-forms.js') }}" defer></script>
<script src="{{ asset('js/sky-site-search.js') }}" defer></script>
