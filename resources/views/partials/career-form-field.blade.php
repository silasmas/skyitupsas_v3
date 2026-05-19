{{--
  Champ formulaire candidature avec label, astérisque obligatoire et erreur.
  Variables : $name, $label, $required (bool), $slug
--}}
@php
    $inputId = $id ?? ('career-' . $name . '-' . $slug);
    $hasError = $errors->has($name);
@endphp
<p class="sky-career-form__field{{ $hasError ? ' has-error' : '' }}" data-field="{{ $name }}">
    <label class="sky-career-form__label" for="{{ $inputId }}">
        {{ $label }}
        @if (! empty($required))
            <span class="sky-career-form__required" title="{{ __('site.career_required_hint') }}" aria-hidden="true">*</span>
        @endif
    </label>
    {{ $slot }}
    @error($name)
        <span class="sky-career-form__error" role="alert">{{ $message }}</span>
    @enderror
    <span class="sky-career-form__error sky-career-form__error--client" role="alert" hidden></span>
</p>
