<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">
                
                <div class="card-columns">
                    <div class="card bg-info">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-xs-4"><span class="material-icons box-icon">sync_alt</span></div>
                            <div class="col-xs-8">
                                <p class="card-text inner-text">TOTAL JOBS</p>
                                <p class="count-text">{{ $totalJobCum }} <p>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="card bg-success ">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-xs-4"><span class="material-icons box-icon">done_all</span></div>
                            <div class="col-xs-8">
                                <p class="card-text inner-text">COMPLETED </p>
                                <p class="count-text"> {{ $statusCompleted }} </p>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="card bg-warning">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-xs-4"><span class="material-icons box-icon">schedule</span></div>
                            <div class="col-xs-8">
                                <p class="card-text inner-text">PENDING </p>
                                <p class="count-text"> {{ $statusPending }} </p>
                            </div>            
                        </div>        
                    </div>
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Recent Jobs</div>
                        </div>
                    </div>   
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#jobs">Jobs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#merchandise">General Merchandise</a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div id="jobs" class="container tab-pane active"><br>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <!-- <th scope="col">S/N</th> -->
                                            <th scope="col">Job Title</th>  
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Request Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentJobs as $recentJob)
                                        <tr>
                                            <td><a href="{{ route('jobs.show', $recentJob->id) }}">{{ $recentJob->job_title }}</a></td>
                                            <td><a href="{{ route('jobs.show', $recentJob->id) }}">{{ $recentJob->amount }}</a></td>
                                            <td><a href="{{ route('jobs.show', $recentJob->id) }}">{{ $recentJob->status }}</a></td>
                                            <td><a href="{{ route('jobs.show', $recentJob->id) }}">{{ $recentJob->created_at->format('j F, Y') }}</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="merchandise" class="container tab-pane fade"><br>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Merchandise</th>  
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Request Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentMerchantJobs as $recentMerchantJob)
                                        <tr>
                                            <td><a href="{{ route('gmerchandise.show', $recentMerchantJob->id) }}">{{ $recentMerchantJob->merchandise->merchandise }}</a></td>
                                            <td><a href="{{ route('gmerchandise.show', $recentMerchantJob->id) }}">{{ $recentMerchantJob->amount }}</a></td>
                                            <td><a href="{{ route('gmerchandise.show', $recentMerchantJob->id) }}">{{ $recentMerchantJob->status }}</a></td>
                                            <td><a href="{{ route('gmerchandise.show', $recentMerchantJob->id) }}">{{ $recentMerchantJob->created_at->format('j F, Y') }}</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> -->
<!-- <div class=" overflow-hidden shadow-xl sm:rounded-lg">
    <x-jet-welcome />
</div> -->