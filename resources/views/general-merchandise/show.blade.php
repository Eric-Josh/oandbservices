<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a  href="{{ route('gmerchandise') }}" data-toggle="tooltip" data-placement="bottom" title="View History">{{ __('Merchandise ') }} </a>{{ __(' - ') }} 
            <a  href="{{ route('gmerchandise.edit', $generalMerchandise->id) }}" data-toggle="tooltip" data-placement="bottom" title="Edit Job">{{ __($generalMerchandise->merchandise->merchandise) }} </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container" style="padding-left: 20px">
                    
                    <div class="row">
                        <div class="card-body "> 
                            <label for="generalMerchandise" class="labels">Job Description: </label><br> {{ $generalMerchandise->description }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body "> 
                            <label for="generalMerchandise" class="labels">Requested Start TIme: </label><br> {{ $generalMerchandise->time_frame }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body "> 
                            <label for="generalMerchandise" class="labels">Budget: </label><br> {{ $generalMerchandise->amount }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body "> 
                            <label for="generalMerchandise" class="labels">Phone Number: </label><br> {{ $generalMerchandise->phone }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="card-body "> 
                            <label for="generalMerchandise" class="labels">Location: </label><br> {{ $generalMerchandise->location }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="card-body "> 
                            <form  action="{{ route('gmerchandise.edit', $generalMerchandise->id) }}">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Job" >Edit</button>
                            </form>
                        </div>
                    </div>
                </div>

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
