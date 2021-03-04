@component('mail::message')
{{ __('Hello '.$handymanName) }}

{{ __('A new job has been assign to you. ') }}


{{ __('Kindly view detials of request below.') }}

{{ __('Customer\'s Name: '.$customerName) }} <br>
{{ __('Customer\'s Phone: '.$customerPhone) }} <br>
{{ __('Job Title: '.$jobTitle) }} <br>
{{ __('Job Description: '.$jobDesc) }} <br>
{{ __('Job Location: '.$jobLocation) }} <br>
{{ __('Amount: '.$jobAmount) }}

@component('mail::button', ['url' => route('handyman.dashboard')])
{{ __('View Job') }}
@endcomponent


{{ __('Regards ') }}<br>
{{ __('O & B Service Team ') }}
@endcomponent

