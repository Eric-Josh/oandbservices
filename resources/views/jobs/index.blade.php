<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- <a href="{{ route('jobs.create') }}" type="button" class="btn btn-success"><i class="fa fa-plus"></i> Post New Job</a> <br><br> -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <!-- <th scope="col">S/N</th> -->
                                <th scope="col">Job Title</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">Request Date</th>
                                <th scope="col">Edit Job</th>
                                <!-- <th scope="col">Delete</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- @php $i = 1; @endphp -->
                            @foreach($jobs as $job)
                            <tr>
                                <!-- <th scope="row">{{ $i }}</th> -->
                                <td><a href="{{ route('jobs.show', $job->id) }}">{{ $job->job_title }}</a></td>
                                <td><a href="{{ route('jobs.show', $job->id) }}">{{ $job->amount }}</a></td>
                                @if($job->status == "Pending")
                                <td><span class="badge badge-warning">{{ $job->status }}</span></td>
                                @else
                                <td><span class="badge badge-success">{{ $job->status }}</span></td>
                                @endif
                                <td><a href="{{ route('jobs.show', $job->id) }}">{{ $job->time_frame }}</a></td>
                                <td><a href="{{ route('jobs.show', $job->id) }}">{{ $job->created_at->format('j F, Y') }}</a></td>
                                <td><a href="{{ route('jobs.edit', $job->id) }}">Edit</a></td>
                                <!-- <td>
                                    <form method="POST" action="{{ route('jobs.destroy', $job->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Are you very sure?')" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </td> -->
                            </tr>
                            <!-- @php $i++; @endphp   -->
                            @endforeach
                        </tbody>
                    </table>
                    {{ $jobs->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>