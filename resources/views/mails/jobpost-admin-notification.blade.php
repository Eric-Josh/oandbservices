<!DOCTYPE html>
<html>
<head>
    <title>O & B Services</title>
</head>
<body>
    <h4><b>{{ $title }}</b></h4>
    <p>{{ $body }}</p>

    <h4><b>{{ $userDetails }}</b></h4>
    <ul>
        <li>Name: {{ $name }}</li>
        <li>Email: {{ $email }}</li>
        <li>Phone: {{ $phone }}</li>
        <li>Location: {{ $location }}</li>
        <li>Job Title: {{ $jobtitle }}</li>
        <li>Job Description: {{ $desc }}</li>
        <li>Budget: {{ $budget }} Pounds</li>
        <li>Job Start Time: {{ $userTimeFrame }}</li>
    </ul>


    <p>Thank you</p>
</body>
</html>