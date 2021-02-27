
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
                <div class="table-responsive">
                    <table class="table table-hover table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Job Title</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">Request Date</th>
                                <th scope="col">Assigned To</th>
                                <th scope="col">Assign</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                            <tr>
                                <td><a href="{{ route('admin.job-view', $job->id) }}">{{ $job->job_title }}</a></td>
                                <td><a href="{{ route('admin.job-view', $job->id) }}">{{ $job->amount }}</a></td>
                                @if($job->status == "Pending")
                                <td><span class="badge badge-warning">{{ $job->status }}</span></td>
                                @else
                                <td><span class="badge badge-success">{{ $job->status }}</span></td>
                                @endif
                                <td><a href="{{ route('admin.job-view', $job->id) }}">{{ $job->user->name }}</a></td>
                                <td><a href="{{ route('admin.job-view', $job->id) }}">{{ $job->time_frame }}</a></td>
                                <td><a href="{{ route('admin.job-view', $job->id) }}">{{ $job->created_at->format('j F, Y') }}</a></td>
                                <td><a href="{{ route('admin.job-view', $job->id) }}">{{ $job->assigned_to ? $job->assigned->name : 'Not Assigned' }}</a></td>
                                <td>
                                    
                                    <button class="btn btn-outline-warning job-id" data-toggle="modal" data-target="#assignUserView" data-id="{{$job->id}}">
                                        Assign Job
                                    </button>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('admin.job-status', $job->id) }}">
                                        @csrf
                                        @method('put')
                                        <button onclick="return confirm('Are you sure the job is completed?')" class="btn btn-outline-success">Mark Completed</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- The Modal -->
                            <div class="modal fade" id="assignUserView">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <input type="hidden" class="get-job-id" name="jobid">
                                            <h4 class="modal-title">Assign Job To Handyman</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <h2>Filter</h2>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mt-4">
                                                        <x-jet-label for="profession" value="{{ __('Profession') }}" />
                                                        <select  name="profession" id="profession" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  >
                                                            <option selected>Choose a Profession</option>
                                                            @foreach ($jobtypes as $jobType)
                                                            <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mt-4">
                                                        <x-jet-label for="address" value="{{ __('Location') }}" />
                                                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div id="handyman-list"></div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    
                    {{ $jobs->links() }}
                </div>
            </div>

        </div>
    </div>

<script>
$(function(){
    // pass id to modal
    $('.job-id').click(function(){

        var jobId = $(this).data('id');
        $('.get-job-id').attr('value',jobId);

    });

    /*
    - getJobId: row id for a seleted job to assign
    - professionId: filter id for respective handyman associated
    - address: filter for location
    */
    

    $('#profession').change(function(){

        var getProfessionId = $(this).val(),
            getJobId = $('.get-job-id').val(),
            getAddress = $('#address').val();

        $.ajax({
            url: "{{ url('/admin/handyman-search/') }}",
            method: 'get',
            data: {
                professionId: getProfessionId,
                jobId: getJobId,
                address: getAddress
            },
            success: function(result){
                $('#handyman-list').html(result);
            }
        });

    });

    $('#address').keyup(function(){

        var getAddress = $(this).val(),
            getJobId = $('.get-job-id').val(),
            getProfessionId = $('#profession').val();

        $.ajax({
            url: "{{ url('/admin/handyman-search/') }}",
            method: 'get',
            data: {
                professionId: getProfessionId,
                jobId: getJobId,
                address: getAddress, 
            },
            success: function(result){
                $('#handyman-list').html(result);
            }
        });

    })

});
</script>
</x-app-layout>
