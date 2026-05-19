<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $subscriber->locale ?? app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('site.newsletter_mail_subject') }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #1a2e35; max-width: 560px; margin: 0 auto; padding: 24px;">
    <p style="margin: 0 0 16px;">{{ __('site.newsletter_mail_greeting') }}</p>
    <p style="margin: 0 0 16px;">{{ __('site.newsletter_mail_body') }}</p>
    <p style="margin: 0 0 16px;">{{ __('site.newsletter_mail_footer') }}</p>
    <p style="margin: 24px 0 0; font-size: 13px; color: #626974;">{{ config('app.name') }}</p>
</body>
</html>
