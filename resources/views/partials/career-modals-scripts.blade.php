@push('head')
<link rel="stylesheet" href="{{ asset('css/sky-careers.css') }}">
@endpush

@push('modals')
@include('partials.career-modal-overlay')
@include('partials.career-toast')
@endpush

@push('scripts')
<script>
window.skyCareerModals = {
    openOffer: @json(request()->query('offer')),
    openApply: @json(request()->query('apply') ?? session('career_applied_slug')),
    showToast: @json(session('career_toast', false)),
};
</script>
<script src="{{ asset('js/sky-careers-modals.js') }}" defer></script>
<script src="{{ asset('js/sky-careers-form.js') }}" defer></script>
@endpush
