@component('mail::message')
{{ __('Hello '.$customerName) }}

{{ __('Your job post has been assigned to a handyman.') }}

<br>
{{ __('Kindly see details of handyman below.') }}

{{ __('Handyman\'s Name: '.$handymanName) }} <br>
{{ __('Phone Number: '.$handymanPhone) }}

<br>
{{ __('Regards ') }}<br>
{{ __('O & B Service Team ') }}
@endcomponent