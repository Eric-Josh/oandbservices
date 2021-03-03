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

                <div class="table-responsive">
                    <table class="table table-hover table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Merchandise</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">Request Date</th>
                                <!-- <th scope="col">Assigned To</th>
                                <th scope="col">Assign</th> -->
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="gm-tb">
                            @foreach($generalMerchandise as $generalMerchandises)
                            <tr data-id="{{$generalMerchandises->id}}">
                                <td><a href="#" class="gm-jobid"  data-id="{{ $generalMerchandises->id }}">{{ $generalMerchandises->merchandise->merchandise }}</a></td>
                                <td><a href="#" class="gm-jobid"  data-id="{{ $generalMerchandises->id }}">{{ $generalMerchandises->amount }}</a></td>
                                @if($generalMerchandises->status == "Pending")
                                <td><span class="badge badge-warning">{{ $generalMerchandises->status }}</span></td>
                                @else
                                <td><span class="badge badge-success" id="gmstatus{{$generalMerchandises->id}}" >{{ $generalMerchandises->status }}</span></td>
                                @endif
                                <td><a href="#" class="gm-jobid"  data-id="{{ $generalMerchandises->id }}">{{ $generalMerchandises->user->name }}</a></td>
                                <td><a href="#" class="gm-jobid"  data-id="{{ $generalMerchandises->id }}">{{ $generalMerchandises->time_frame }}</a></td>
                                <td><a href="#" class="gm-jobid"  data-id="{{ $generalMerchandises->id }}">{{ $generalMerchandises->created_at->format('j F, Y') }}</a></td>
                                <!--<td><a href="{{ route('admin.merchandise-view', $generalMerchandises->id) }}">{{ $generalMerchandises->assigned_to ? $generalMerchandises->assigned->name : 'Not Assigned' }}</a></td>
                                 <td>
                                    <button class="btn btn-outline-warning">Assign Job</button>
                                </td> -->
                                <td>
                                    <form method="POST" action="{{ route('admin.merchandise-status', $generalMerchandises->id) }}">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" id="gmmain-status{{$generalMerchandises->id}}" name="gmstatus">
                                    <button onclick="return confirm('Are you sure ?')" id="gm-btn{{$generalMerchandises->id}}" class="btn btn-outline-success">Mark Completed</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $generalMerchandise->links() }}
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

        </div>
    </div>

<script>
$(function(){
    $('[data-toggle="tooltip"]').tooltip(); 

     // button changes
    var arr=[];

    $('#gm-tb tr').each( function (i, tr) {
        arr.push($(tr).data('id'));
    });
    // console.log(arr);
    for (var i=0; i<arr.length; i++){

        if ( $('#gmstatus'+arr[i]).text() === 'Completed' )
        {
            $('#gm-btn'+arr[i]).text('Mark Pending');
            $('#gm-btn'+arr[i]).removeClass( "btn-outline-success" ).addClass( "btn-outline-warning" );
            $('#gmmain-status'+arr[i]).val('Pending');
        }else{
            $('#gmmain-status'+arr[i]).val('Completed');
        }
    }  

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