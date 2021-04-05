<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('General Merchandise - History') }}
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
                <a href="{{ route('gmerchandise.create') }}" type="button" class="btn btn-success"><i class="fa fa-plus"></i> Post New Job</a> <br><br>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Merchandise</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">Request Date</th>
                                <th scope="col">Edit Job</th> 
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- @php $i = 1; @endphp -->
                            @foreach($generalMerchandise as $generalMerchandises)
                            <tr>
                                <!-- <th scope="row">{{ $i }}</th> -->
                                <td><a href="#" class="gm-jobid"  data-id="{{ $generalMerchandises->id }}" data-toggle="tooltip" data-placement="bottom" title="View Job">{{ $generalMerchandises->merchandise->merchandise }}</a></td>
                                <td><a href="#" class="gm-jobid"  data-id="{{ $generalMerchandises->id }}">{{ $generalMerchandises->amount }}</a></td>
                                @if($generalMerchandises->status == "Pending")
                                <td><span class="badge badge-warning">{{ $generalMerchandises->status }}</span></td>
                                @else
                                <td><span class="badge badge-success">{{ $generalMerchandises->status }}</span></td>
                                @endif
                                <td><a href="#" class="gm-jobid"  data-id="{{ $generalMerchandises->id }}">{{ $generalMerchandises->time_frame }}</a></td>
                                <td><a href="#" class="gm-jobid"  data-id="{{ $generalMerchandises->id }}">{{ $generalMerchandises->created_at->format('j F, Y') }}</a></td>
                                <td><a href="{{route('gmerchandise.edit', $generalMerchandises->id)}}" class="gm-jobid"  data-toggle="tooltip" data-placement="bottom" title="Edit Job">Edit</a></td> 
                                <td>
                                    <form method="POST" action="{{ route('gmerchandise.destroy', $generalMerchandises->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Are you very sure?')" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- @php $i++; @endphp   -->
                            @endforeach
                        </tbody>
                    </table>
                    {{ $generalMerchandise->links() }}
                </div>
            </div>
            <!-- The Modal -->
            <div class="modal fade" id="gmModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body"></div>

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
        $('[data-toggle="tooltip"]').tooltip();   

        // pass id to modal
        $('.gm-jobid').click(function(){

            var gmJobId = $(this).data('id');

            $.ajax({
            url: "{{ url('/admin/merchandise-view') }}",
                method: 'get',
                data: {
                    gmJobId: gmJobId,
                },
                success: function(result){
                    $('.modal-body').html(result);

                    // Display Modal
                    $('#gmModal').modal('show');
                }
            });
        });
        
    });
</script>
</x-app-layout>