<!-- 
<div class="modal-header">
    <h4 class="modal-title">{{ 'Job' }}</h4>
</div> -->
<div class="table-responsive">
    <table class="table table-hover table-bordered ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Job Title</th> 
                <th>{{ $jobs->job_title }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Type of Job</b></td>
                <td>{{ $jobs->jobTypes->name }}</td>
            </tr>
            <tr>
                <td><b>Job Description</b></td>
                <td>{{ $jobs->description }}</td>
            </tr>
            <tr>
                <td><b>Requested Start TIme</b></td>
                <td> {{ $jobs->time_frame }} </td>
            </tr>
            <tr>
                <td><b>Budget</b></td>
                <td>&#163 {{ $jobs->amount }}</td>
            </tr>
            <tr>
                <td><b>Location</b></td>
                <td> {{ $jobs->location }}</td>
            </tr>
            <tr>
                <td><b>Photo</b></td>
                <td> 
                    @foreach(explode('|', $jobs->photo) as $photo)
                    <a href="/job-images/{{ $photo }}" data-lightbox="example-set" class="example-image-link">
                    <img src="/job-images/{{ $photo }}" id="avail-img" style="width:100px;height:100px" class="example-image img-thumbnail mx-auto d-block" > 
                    </a>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td><b>Requested By</b></td>
                <td> {{ $jobs->user->name }}</td>
            </tr>
            <tr>
                <td><b>Phone Number</b></td>
                <td> {{ $jobs->phone }}</td>
            </tr>
            <tr>
                <td><b>Request Date</b></td>
                <td> {{ $jobs->created_at->format('j F, Y') }}</td>
            </tr>
            <tr>
                <td><b>Status</b></td>
                @if($jobs->status == "Pending")
                <td><span class="badge badge-warning">{{ $jobs->status }}</span></td>
                @else
                <td><span class="badge badge-success">{{ $jobs->status }}</span></td>
                @endif
            </tr>
        </tbody>
    </table>
</div>