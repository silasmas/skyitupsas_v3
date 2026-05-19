{{--
  Formulaire de contact réutilisable (accueil, modale, page contact).
  @param string $source home_section|home_modal|contact_page
  @param string $variant hub-section|hub-modal|contact-page
--}}
@php
    $source = $source ?? \App\Models\ContactMessage::SOURCE_CONTACT_PAGE;
    $variant = $variant ?? 'contact-page';
    $formId = 'sky-contact-' . str_replace('_', '-', $source);
    $action = route('contact.store', ['locale' => app()->getLocale()]);
    $isHubSection = $variant === 'hub-section';
    $isHubModal = $variant === 'hub-modal';
    $isContactPage = $variant === 'contact-page';
@endphp

@if ($errors->any() && session('contact_form_error'))
    <div class="sky-contact-form__alert mb-20 p-15 rounded-4 bg-red-50 border-1 border-red-200 text-14 text-red-800" role="alert">
        <p class="font-semibold mb-5">{{ __('site.contact_form_errors_title') }}</p>
        <ul class="mb-0 pl-20">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    id="{{ $formId }}"
    method="post"
    action="{{ $action }}"
    class="sky-contact-form{{ $isHubSection ? ' lqd-cf-form' : '' }}"
    data-sky-contact-form
    novalidate
>
    @csrf
    <input type="hidden" name="source" value="{{ $source }}">

    @if ($isHubSection)
        <div class="row">
            <div class="col col-12 py-0">
                <span class="mb-0 lqd-form-control-wrap relative{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input class="text-black px-2em text-14 font-normal bg-yellow-100" type="text" name="name" id="{{ $formId }}-name" value="{{ old('name') }}" required placeholder="{{ __('site.home_contact_name_ph') }}" autocomplete="name" aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}">
                    <i class="lqd-icn-ess icon-lqd-user"></i>
                </span>
                @error('name')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="col col-12 py-0">
                <span class="mb-0 lqd-form-control-wrap relative{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input class="text-black px-2em text-14 font-normal bg-yellow-100" type="email" name="email" id="{{ $formId }}-email" value="{{ old('email') }}" required placeholder="{{ __('site.home_contact_email_ph') }}" autocomplete="email" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
                    <i class="lqd-icn-ess icon-lqd-envelope"></i>
                </span>
                @error('email')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="col col-12 py-0">
                <span class="mb-0 lqd-form-control-wrap relative{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <input class="text-black px-2em text-14 font-normal bg-yellow-100" type="tel" name="phone" id="{{ $formId }}-phone" value="{{ old('phone') }}" placeholder="{{ __('site.contact_form_phone_ph') }}" autocomplete="tel">
                    <i class="lqd-icn-ess icon-ion-ios-telephone"></i>
                </span>
                @error('phone')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="col col-12 py-0">
                <span class="mb-0 lqd-form-control-wrap relative{{ $errors->has('message') ? ' has-error' : '' }}">
                    <textarea class="text-black px-2em text-14 font-normal bg-yellow-100 w-full min-h-100" name="message" id="{{ $formId }}-message" rows="3" required placeholder="{{ __('site.contact_form_message_ph') }}" aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}">{{ old('message') }}</textarea>
                </span>
                @error('message')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="col col-12 py-0">
                <span class="lqd-form-control-wrap{{ $errors->has('consent_privacy') ? ' has-error' : '' }}" data-name="consent_privacy">
                    <span class="lqd-cf-form-control lqd-cf-acceptance">
                        <span class="lqd-cf-list-item">
                            <label>
                                <input type="checkbox" name="consent_privacy" value="1" id="{{ $formId }}-privacy" {{ old('consent_privacy') ? 'checked' : '' }} required aria-invalid="{{ $errors->has('consent_privacy') ? 'true' : 'false' }}">
                                <span class="lqd-cf-list-item-label">{{ __('site.contact_form_privacy') }}</span>
                            </label>
                        </span>
                    </span>
                </span>
                @error('consent_privacy')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="col col-12 py-0">
                <button type="submit" class="mb-0 font-bold text-secondary bg-primary has-spinner text-16 hover:bg-secondary hover:text-white w-full border-none cursor-pointer py-15 rounded-4" data-sky-contact-submit>
                    <span data-sky-contact-submit-text>{{ __('site.home_contact_submit') }}</span>
                    <span data-sky-contact-submit-loading hidden>{{ __('site.contact_form_submitting') }}</span>
                </button>
            </div>
        </div>
    @elseif ($isHubModal)
        <p>
            <span class="lqd-form-control-wrap text{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" name="name" id="{{ $formId }}-name" value="{{ old('name') }}" class="lqd-cf-form-control px-2em text-13 bg-gray-100 text-slate-300" required placeholder="{{ __('site.home_contact_name_ph') }}" autocomplete="name">
            </span>
            @error('name')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            <span class="lqd-form-control-wrap{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" id="{{ $formId }}-email" value="{{ old('email') }}" class="lqd-cf-form-control px-2em text-13 bg-gray-100 text-slate-300" required placeholder="{{ __('site.home_contact_email_ph') }}" autocomplete="email">
            </span>
            @error('email')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            <span class="lqd-form-control-wrap{{ $errors->has('phone') ? ' has-error' : '' }}">
                <input type="tel" name="phone" id="{{ $formId }}-phone" value="{{ old('phone') }}" class="lqd-cf-form-control px-2em text-13 bg-gray-100 text-slate-300" placeholder="{{ __('site.contact_form_phone_ph') }}" autocomplete="tel">
            </span>
            @error('phone')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            <span class="lqd-form-control-wrap textarea{{ $errors->has('message') ? ' has-error' : '' }}">
                <textarea name="message" id="{{ $formId }}-message" cols="10" rows="4" class="lqd-cf-form-control px-2em text-13 bg-gray-100 text-slate-300" required placeholder="{{ __('site.contact_form_message_ph') }}">{{ old('message') }}</textarea>
            </span>
            @error('message')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            <span class="lqd-form-control-wrap{{ $errors->has('consent_privacy') ? ' has-error' : '' }}">
                <label class="text-13 flex items-start gap-10 mt-10">
                    <input type="checkbox" name="consent_privacy" value="1" id="{{ $formId }}-privacy" {{ old('consent_privacy') ? 'checked' : '' }} required>
                    <span>{{ __('site.contact_form_privacy') }}</span>
                </label>
            </span>
            @error('consent_privacy')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            <button type="submit" class="lqd-cf-form-control px-2em text-14 bg-primary text-white border-none cursor-pointer" data-sky-contact-submit>
                <span data-sky-contact-submit-text>{{ __('site.contact_form_submit') }}</span>
                <span data-sky-contact-submit-loading hidden>{{ __('site.contact_form_submitting') }}</span>
            </button>
        </p>
    @else
        <div class="flex flex-col gap-15">
            <span class="lqd-form-control-wrap relative{{ $errors->has('name') ? ' has-error' : '' }}">
                <input class="w-full rounded-4 border-1 border-black-10 px-15 py-12 text-14" type="text" name="name" id="{{ $formId }}-name" value="{{ old('name') }}" required placeholder="{{ __('site.home_contact_name_ph') }}" autocomplete="name">
            </span>
            @error('name')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            <span class="lqd-form-control-wrap relative{{ $errors->has('email') ? ' has-error' : '' }}">
                <input class="w-full rounded-4 border-1 border-black-10 px-15 py-12 text-14" type="email" name="email" id="{{ $formId }}-email" value="{{ old('email') }}" required placeholder="{{ __('site.home_contact_email_ph') }}" autocomplete="email">
            </span>
            @error('email')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            <span class="lqd-form-control-wrap relative{{ $errors->has('phone') ? ' has-error' : '' }}">
                <input class="w-full rounded-4 border-1 border-black-10 px-15 py-12 text-14" type="tel" name="phone" id="{{ $formId }}-phone" value="{{ old('phone') }}" placeholder="{{ __('site.contact_form_phone_ph') }}" autocomplete="tel">
            </span>
            @error('phone')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            <span class="lqd-form-control-wrap relative{{ $errors->has('message') ? ' has-error' : '' }}">
                <textarea class="w-full rounded-4 border-1 border-black-10 px-15 py-12 text-14 min-h-150" name="message" id="{{ $formId }}-message" rows="5" required placeholder="{{ __('site.contact_form_message_ph') }}">{{ old('message') }}</textarea>
            </span>
            @error('message')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            <label class="text-14 flex items-start gap-10{{ $errors->has('consent_privacy') ? ' has-error' : '' }}">
                <input type="checkbox" name="consent_privacy" value="1" id="{{ $formId }}-privacy" {{ old('consent_privacy') ? 'checked' : '' }} required>
                <span>{{ __('site.contact_form_privacy') }}</span>
            </label>
            @error('consent_privacy')<span class="sky-contact-form__error" role="alert">{{ $message }}</span>@enderror
            <button type="submit" class="btn btn-solid font-bold text-secondary bg-primary rounded-4 hover:bg-secondary hover:text-white py-12" data-sky-contact-submit>
                <span data-sky-contact-submit-text>{{ __('site.contact_form_submit') }}</span>
                <span data-sky-contact-submit-loading hidden>{{ __('site.contact_form_submitting') }}</span>
            </button>
        </div>
    @endif
</form>
