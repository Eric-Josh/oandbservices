@component('mail::message')
{{ __('Hello Admin,') }}

{{ __('A job request has been deleted. Kindly view detials of request below.') }}


@component('mail::panel')
Job Details
@endcomponent
@component('mail::table')
<table> 
<tbody class="thead-dark">
<tr>
<th scope="col">{{ __('Customer\'s Name') }}</th>
<td>{{ __($customerName) }}</td>
</tr>
<tr>
<th scope="col">{{ __('Customer\'s Email') }}</th>
<td>{{ __($customerEmail) }}</td>
</tr>
<tr>
<th scope="col">{{ __('Customer\'s Phone') }}</th>
<td>{{ __($customerPhone) }}</td>
</tr>
<tr>
<th scope="col">{{ __('Job Title') }}</th>
<td>{{ __($jobTitle) }}</td>
</tr>
<tr>
<th scope="col">{{ __('Job Description') }}</th>
<td>{{ __($jobDesc) }}</td>
</tr>
<tr>
<th scope="col">{{ __('Job Location') }}</th>
<td>{{ __($jobLoc) }}</td>
</tr>
<tr>
<th scope="col">{{ __('Amount') }}</th>
<td>{{ __($jobAmount) }}</td>
</tr>
<tr>
<th scope="col">{{ __('Job Start Time') }}</th>
<td>{{ __($jobStartTime) }}</td>
</tr>
</tbody>
</table>
@endcomponent

@component('mail::button', ['url' => route('admin.dashboard')])
{{ __('View Job') }}
@endcomponent


{{ __('Regards ') }}<br>
{{ __('O & B Service Team ') }}
@endcomponent

