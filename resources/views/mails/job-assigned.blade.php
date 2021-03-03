<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="overflow-hidden shadow-xl sm:rounded-lg">
        <img src="/images/dashboard-nav-72x72.png" alt="{{ config('app.name') }}">
        <h4><b>{{ $title }}</b></h4>
        <p>{{ $body }}</p>

        <h4><b>{{ $userDetails }}</b></h4>
        <ul>
            <li>Client Name: {{ $name }}</li>
            <li>Phone: {{ $phone }}</li>
            <li>Location: {{ $location }}</li>
            <li>Job Title: {{ $jobtitle }}</li>
            <li>Job Description: {{ $desc }}</li>
            <li>Budget: {{ $budget }}Pounds</li>
        </ul>


        <p>Thank you</p>
    </div>
</div>

