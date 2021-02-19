<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Merchandise') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <form method="POST" action="{{ route('merchandise.update', $merchandise->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-header">
                                <div class="form-group">
                                    <label for="merchandise">Merchandise</label>
                                    <input type="text" class="form-control" id="merchandise" name="merchandise" value="{{ $merchandise->merchandise }}">
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