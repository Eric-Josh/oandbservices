<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Job Type') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <form method="POST" action="{{ route('jobtypes.update', $jobTypes->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-header">
                                <div class="form-group">
                                    <label for="jobtype">Job Type</label>
                                    <input type="text" class="form-control" id="jobtype" name="jobtype" value="{{ $jobTypes->name }}">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>     
                                
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>