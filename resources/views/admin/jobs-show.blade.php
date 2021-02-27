<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a  href="{{ route('admin.job-history') }}"> {{ __('Job ') }} </a> {{ __('- '.$jobs->job_title) }} 
        
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container" style="padding-left: 20px">
                    <div class="row" >
                        <div class="card-body ">
                            <label for="jobtype" class="labels">Type of Job: </label><br> {{ $jobs->jobTypes->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body "> 
                            <label for="jobtype" class="labels">Job Description: </label><br> {{ $jobs->description }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body "> 
                            <label for="jobtype" class="labels">Requested Start TIme: </label><br> {{ $jobs->time_frame }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body "> 
                            <label for="jobtype" class="labels">Budget: </label><br> {{ $jobs->amount }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body "> 
                            <label for="jobtype" class="labels">Phone Number: </label><br> {{ $jobs->phone }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="card-body "> 
                            <label for="jobtype" class="labels">Location: </label><br> {{ $jobs->location }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="jobtype" class="labels" style="padding-left: 20px">Photo</label><br>
                        @if($jobs->photo !='' and $jobs->photo != null)                                
                            @foreach(explode('|', $jobs->photo) as $photo)
                            <div class="card-body "> 
                                <a href="/job-images/{{ $photo }}" data-lightbox="example-set" class="example-image-link">
                                <img src="/job-images/{{ $photo }}" id="avail-img" class="example-image img-thumbnail mx-auto d-block" > 
                                </a>
                            </div>
                                
                            @endforeach
                        @endif
                        
                    </div>
                </div>

            </div>
            </div>
        </div>
    </div>
</x-app-layout>