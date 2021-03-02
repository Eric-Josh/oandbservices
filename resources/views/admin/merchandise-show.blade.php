<div class="table-responsive">
    <table class="table table-hover table-bordered ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Job Title</th> 
                <th>{{ $generalMerchandise->merchandise->merchandise }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Job Description</b></td>
                <td>{{ $generalMerchandise->description }}</td>
            </tr>
            <tr>
                <td><b>Requested Start TIme</b></td>
                <td> {{ $generalMerchandise->time_frame }} </td>
            </tr>
            <tr>
                <td><b>Budget</b></td>
                <td>&#163 {{ $generalMerchandise->amount }}</td>
            </tr>

            <tr>
                <td><b>Location</b></td>
                <td> {{ $generalMerchandise->location }}</td>
            </tr>
            <tr>
                <td><b>Requested By</b></td>
                <td> {{ $generalMerchandise->user->name }}</td>
            </tr>

            <tr>
                <td><b>Phone Number</b></td>
                <td> {{ $generalMerchandise->phone }}</td>
            </tr>
            <tr>
                <td><b>Request Date</b></td>
                <td> {{ $generalMerchandise->created_at->format('j F, Y') }}</td>
            </tr>
            <tr>
                <td><b>Status</b></td>
                @if($generalMerchandise->status == "Pending")
                <td><span class="badge badge-warning">{{ $generalMerchandise->status }}</span></td>
                @else
                <td><span class="badge badge-success">{{ $generalMerchandise->status }}</span></td>
                @endif
            </tr>
        </tbody>
    </table>
</div>