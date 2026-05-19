@php
    $locale = $application->locale ?? app()->getLocale();
    $offerTitle = $offer->getTranslation('title', $locale);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $locale) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('site.career_mail_subject', ['title' => $offerTitle]) }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #1a2e35; max-width: 560px; margin: 0 auto; padding: 24px;">
    <p style="margin: 0 0 16px;">{{ __('site.career_mail_greeting', ['name' => $application->first_name]) }}</p>
    <p style="margin: 0 0 16px;">{{ __('site.career_mail_body', ['title' => $offerTitle]) }}</p>
    <p style="margin: 0 0 16px;">{{ __('site.career_mail_footer') }}</p>
    <p style="margin: 24px 0 0; font-size: 13px; color: #626974;">{{ config('app.name') }}</p>
</body>
</html>
