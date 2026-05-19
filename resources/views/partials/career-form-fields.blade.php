{{--
  Champs du formulaire de candidature (validation inline, PDF uniquement).
  Variables : $offer (JobOffer)
--}}
@php
    $slug = $offer->slug;
@endphp
<div class="sky-career-form__row">
    @component('partials.career-form-field', ['name' => 'first_name', 'label' => __('site.career_first_name'), 'required' => true, 'slug' => $slug])
        <input id="career-first_name-{{ $slug }}" class="sky-career-form__control" type="text" name="first_name" value="{{ old('first_name') }}" required autocomplete="given-name">
    @endcomponent
    @component('partials.career-form-field', ['name' => 'last_name', 'label' => __('site.career_last_name'), 'required' => true, 'slug' => $slug])
        <input id="career-last_name-{{ $slug }}" class="sky-career-form__control" type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name">
    @endcomponent
</div>
@component('partials.career-form-field', ['name' => 'email', 'label' => __('site.career_email'), 'required' => true, 'slug' => $slug])
    <input id="career-email-{{ $slug }}" class="sky-career-form__control" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
@endcomponent
@component('partials.career-form-field', ['name' => 'phone', 'label' => __('site.career_phone'), 'required' => false, 'slug' => $slug])
    <input id="career-phone-{{ $slug }}" class="sky-career-form__control" type="text" name="phone" value="{{ old('phone') }}" autocomplete="tel">
@endcomponent
@component('partials.career-form-field', ['name' => 'linkedin_url', 'label' => __('site.career_linkedin'), 'required' => false, 'slug' => $slug])
    <input id="career-linkedin_url-{{ $slug }}" class="sky-career-form__control" type="url" name="linkedin_url" value="{{ old('linkedin_url') }}" placeholder="https://">
@endcomponent
@component('partials.career-form-field', ['name' => 'cover_letter', 'label' => __('site.career_cover'), 'required' => true, 'slug' => $slug])
    <div class="sky-career-dropzone sky-career-dropzone--file" data-sky-career-file-dropzone data-field-name="cover_letter">
        <input
            id="career-cover_letter-{{ $slug }}"
            class="sky-career-dropzone__input"
            type="file"
            name="cover_letter"
            accept=".pdf,application/pdf"
            required
            tabindex="-1"
        >
        <div class="sky-career-dropzone__overlay">
            <span class="sky-career-dropzone__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </span>
            <span class="sky-career-dropzone__title">{{ __('site.career_drop_cover_title') }}</span>
            <span class="sky-career-dropzone__hint">{{ __('site.career_drop_cover_hint') }}</span>
            <button type="button" class="sky-career-dropzone__browse" data-sky-career-browse>{{ __('site.career_drop_cv_browse') }}</button>
        </div>
        <p class="sky-career-dropzone__filename" data-sky-career-filename hidden></p>
    </div>
@endcomponent
@component('partials.career-form-field', ['name' => 'cv', 'label' => __('site.career_cv'), 'required' => true, 'slug' => $slug])
    <div class="sky-career-dropzone sky-career-dropzone--file" data-sky-career-file-dropzone data-field-name="cv">
        <input
            id="career-cv-{{ $slug }}"
            class="sky-career-dropzone__input"
            type="file"
            name="cv"
            accept=".pdf,application/pdf"
            required
            tabindex="-1"
        >
        <div class="sky-career-dropzone__overlay">
            <span class="sky-career-dropzone__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </span>
            <span class="sky-career-dropzone__title">{{ __('site.career_drop_cv_title') }}</span>
            <span class="sky-career-dropzone__hint">{{ __('site.career_drop_cv_hint') }}</span>
            <button type="button" class="sky-career-dropzone__browse" data-sky-career-browse>{{ __('site.career_drop_cv_browse') }}</button>
        </div>
        <p class="sky-career-dropzone__filename" data-sky-career-filename hidden></p>
    </div>
@endcomponent
<p class="sky-career-form__field sky-career-form__field--consent{{ $errors->has('consent_privacy') ? ' has-error' : '' }}" data-field="consent_privacy">
    <span class="sky-career-form__label sky-career-form__label--consent">
        {{ __('site.career_privacy_label') }}
        <span class="sky-career-form__required" aria-hidden="true">*</span>
    </span>
    <span class="sky-career-form__consent-row">
        <input id="career-privacy-{{ $slug }}" type="checkbox" name="consent_privacy" value="1" {{ old('consent_privacy') ? 'checked' : '' }} required>
        <label for="career-privacy-{{ $slug }}">{{ __('site.career_privacy') }}</label>
    </span>
    @error('consent_privacy')
        <span class="sky-career-form__error" role="alert">{{ $message }}</span>
    @enderror
</p>
<p class="sky-career-form__submit">
    <button type="submit" class="sky-career-form__submit-btn btn btn-solid font-bold text-secondary bg-primary rounded-4 w-full" data-sky-career-submit>
        <span class="sky-career-form__submit-text">{{ __('site.career_submit') }}</span>
        <span class="sky-career-form__submit-loading" hidden>
            <span class="sky-career-form__spinner" aria-hidden="true"></span>
            <span>{{ __('site.career_submitting') }}</span>
        </span>
    </button>
</p>
