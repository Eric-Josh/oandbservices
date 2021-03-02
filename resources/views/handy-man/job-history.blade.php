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
                                <th scope="col">Start Time</th>
                                <th scope="col">Date Assigned</th>
                                <th scope="col">Date Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($handyManJob as $handyManJob2s)
                            <tr>
                                <td><a href="#" class="jobber" data-id="{{$handyManJob2s->id}}">{{ $handyManJob2s->job_title }}</a></td>
                                <td><a href="#"  class="jobber" data-id="{{$handyManJob2s->id}}">{{ $handyManJob2s->amount }}</a></td>
                                @if($handyManJob2s->status == "Pending")
                                <td><span class="badge badge-warning">{{ $handyManJob2s->status }}</span></td>
                                @else
                                <td><span class="badge badge-success">{{ $handyManJob2s->status }}</span></td>
                                @endif
                                <td><a href="#"  class="jobber" data-id="{{$handyManJob2s->id}}">{{ $handyManJob2s->time_frame }}</a></td>
                                @php 
                                    $dateAssigned = new DateTime($handyManJob2s->date_request); 
                                    $dateCompleted = new DateTime($handyManJob2s->date_completed);
                                @endphp
                                <td><a href="#"  class="jobber" data-id="{{$handyManJob2s->id}}">{{ $dateAssigned->format('j F, Y') }}</a></td>
                                <td><a href="#"  class="jobber" data-id="{{$handyManJob2s->id}}">{{ $dateCompleted->format('j F, Y') }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $handyManJob->links() }}
                </div>
            </div>
            <!-- The Modal -->
            <div class="modal fade" id="jbModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <!-- <div class="modal-header">
                            <h4 class="modal-title"></h4>
                        </div> -->
                        <!-- Modal body -->
                        <div class="modal-body jb-view"></div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


<script>
$(function(){

    // job view
    $('.jobber').click(function(){
        var jobId = $(this).data('id');
        $.ajax({
            url: "{{ url('/admin/job-view') }}",
            method: 'get',
            data: {
                jobId: jobId,
            },
            success: function(result){
                $('.jb-view').html(result);

                // Display Modal
                $('#jbModal').modal('show');
            }
        });

    });

});
</script>
</x-app-layout>