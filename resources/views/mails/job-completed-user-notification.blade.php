@component('mail::message')
{{ __('Hello '.$customerName.',') }}

{{ __('Thank you for trusting us to deliver a good job for you.') }}

{{ __('We hope to see you around in the nearest feature.') }}

{{ __('Kindly leave a feedback using the link below.') }}

@component('mail::button', ['url' => route('reviews.create')])
{{ __('Rate & Review') }}
@endcomponent

{{ __('Regards,') }}<br>
{{ __('O & B Service Team.') }}
@endcomponent