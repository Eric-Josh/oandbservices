@component('mail::message')
{{ __('Hello '.$customerName.',') }}

{{ __('Thank You for placing a request.') }}

{{ __('We will connect you to a/an '. $merchandiseType .' shortly.') }}

{{ __('Regards ') }}<br>
{{ __('O & B Service Team ') }}
@endcomponent