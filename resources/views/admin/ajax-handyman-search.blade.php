<div class="table-responsive">
    <table class="table table-hover table-bordered ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Handyman Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Profession</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($handymanSearch as $handymanSearches)
            <tr>
                <td>{{ $handymanSearches->name }}</td>
                <td>{{ $handymanSearches->email }}</td>
                <td>{{ $handymanSearches->address }}</td>
                <td>{{ $handymanSearches->phone1 }}</td>
                <td>{{ $handymanSearches->jobtypes->name }}</td>
                <td>
                <form method="POST" action="{{ route('admin.assign-job', $jobId) }}">
                    @csrf
                    @method('put')
                    <input type="hidden" name="assign" value="{{ $handymanSearches->id }}">
                    <button onclick="return confirm('Are you sure?')" class="btn btn-outline-success">Assign</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>