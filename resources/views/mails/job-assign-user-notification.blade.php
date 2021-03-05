@component('mail::message')
{{ __('Hello '.$customerName.',') }}

{{ __('Your job post has been assigned to a handyman.') }}


{{ __('Kindly see details of handyman below.') }}

@component('mail::panel')
Handyman Details
@endcomponent
@component('mail::table')
<table>
<tbody class="thead-dark">
<tr>
<th scope="col">{{ __('Handyman\'s Name') }}</th>
<td>{{ __($handymanName) }}</td>
</tr>
<tr>
<th scope="col">{{ __('Handyman\'s Phone') }}</th>
<td>{{ __($handymanPhone) }}</td>
</tr>
</tbody>
</table>
@endcomponent

{{ __('Regards ') }}<br>
{{ __('O & B Service Team ') }}
@endcomponent