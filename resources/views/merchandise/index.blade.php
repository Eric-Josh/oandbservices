<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Merchandise') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">
            <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('merchandise.create') }}" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> New Merchandise</a> <br><br>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Merchandise</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($merchandise as $merchandises)
                            <tr>
                            <th scope="row">{{ $merchandises->id }}</th>
                            <td>{{ $merchandises->merchandise }}</td>
                            <td><a href="{{ route('merchandise.edit', $merchandises->id) }}">Edit</a></td>
                            <td>
                                <form method="POST" action="{{ route('merchandise.destroy', $merchandises->id) }}">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Are you very sure?')" class="btn btn-outline-danger">Delete</button>
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>