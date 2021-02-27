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
                        <tbody>
                            @foreach($generalMerchandise as $generalMerchandises)
                            <tr>
                                <td><a href="{{ route('admin.merchandise-view', $generalMerchandises->id) }}"  data-toggle="tooltip" data-placement="bottom" 
                                        title="View Job">{{ $generalMerchandises->merchandise->merchandise }}</a></td>
                                <td><a href="{{ route('admin.merchandise-view', $generalMerchandises->id) }}">{{ $generalMerchandises->amount }}</a></td>
                                @if($generalMerchandises->status == "Pending")
                                <td><span class="badge badge-warning">{{ $generalMerchandises->status }}</span></td>
                                @else
                                <td><span class="badge badge-success">{{ $generalMerchandises->status }}</span></td>
                                @endif
                                <td><a href="{{ route('admin.merchandise-view', $generalMerchandises->id) }}">{{ $generalMerchandises->user->name }}</a></td>
                                <td><a href="{{ route('admin.merchandise-view', $generalMerchandises->id) }}">{{ $generalMerchandises->time_frame }}</a></td>
                                <td><a href="{{ route('admin.merchandise-view', $generalMerchandises->id) }}">{{ $generalMerchandises->created_at->format('j F, Y') }}</a></td>
                                <!--<td><a href="{{ route('admin.merchandise-view', $generalMerchandises->id) }}">{{ $generalMerchandises->assigned_to ? $generalMerchandises->assigned->name : 'Not Assigned' }}</a></td>
                                 <td>
                                    <button class="btn btn-outline-warning">Assign Job</button>
                                </td> -->
                                <td>
                                    <form method="POST" action="{{ route('admin.merchandise-status', $generalMerchandises->id) }}">
                                    @csrf
                                    @method('put')
                                    <button onclick="return confirm('Are you sure the job is completed?')" class="btn btn-outline-success">Mark Completed</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $generalMerchandise->links() }}
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</x-app-layout>