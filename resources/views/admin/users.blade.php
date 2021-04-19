<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container">
                <div class="card-deck">
                
                    <div class="card bg-info">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-xs-4"><span class="material-icons box-icon">bar_chart</span></div>
                                <div class="col-xs-8">
                                    <p class="card-text inner-text">TOTAL USERS</p>
                                    <p class="count-text">{{ $usersTotal->count() }} <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-secondary ">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-xs-4"><span class="material-icons box-icon">engineering</span></div>
                                <div class="col-xs-8">
                                    <p class="card-text inner-text">ADMIN </p>
                                    <p class="count-text"> {{ $usersTotal->where('role_id', 1)->count() }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-success ">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-xs-4"><span class="material-icons box-icon">people_alt</span></div>
                                <div class="col-xs-8">
                                    <p class="card-text inner-text">CUTOMERS </p>
                                    <p class="count-text"> {{ $usersTotal->where('role_id', 2)->count() }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-warning">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-xs-4"><span class="material-icons box-icon">construction</span></div>
                                <div class="col-xs-8">
                                    <p class="card-text inner-text">HANDYMAN </p>
                                    <p class="count-text"> {{ $usersTotal->where('role_id', 3)->count() }} </p>
                                </div>            
                            </div>        
                        </div>
                    </div>
                </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1">
                        <div class="p-3">
                            <div class="flex items-center">
                                <div class=" text-lg text-gray-600 leading-1 font-semibold">
                                <button class="btn btn-outline-dark" id="filter">Filters <span class="material-icons">filter_list</span></button> 
                                </div>
                            </div>
                        </div>   
                    </div>
                    
                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1" id="filter-section">
                        <div class="p-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <x-jet-label for="email" value="{{ __('Email') }}" />
                                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <!-- <x-jet-label for="role" value="{{ __('Role') }}" />
                                        <select name="user_type" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <option value="0" selected="selected">All</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Customer</option>
                                            <option value="3">Handyman</option>
                                        </select> -->
                                    </div>
                                </div>  
                                <x-jet-button class="mt-4" id='search'>
                                    {{ __('Search') }} 
                                </x-jet-button> 
                            </div>
                        </div>
                    </div>
                        
                    <div id="search-result" >
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered ">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Name</th>  
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td><a href="#{{ $user->id }}" class="user-details">{{ $user->name }}</a></td>
                                        <td><a href="#{{ $user->id }}" class="user-details">{{ $user->email }}</a></td>
                                        
                                        @if ( $user->role_id == 1)
                                        <td><span>{{ __('Admin') }}</span></td>
                                        @elseif ( $user->role_id == 2)
                                        <td><span  >{{ __('Customer') }}</span></td>
                                        @elseif ( $user->role_id == 3)
                                        <td><span  >{{ __('Handyman') }}</span></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="userModal">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <input type="hidden" class="get-job-id" name="jobid">
                                    <h4 class="modal-title"></h4>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">

                                </div>
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
    $('#filter-section').hide();

    $('#filter').click(function(){
        $('#filter-section').toggle();
    });

    // user view
    $('.user-details').click(function(){

        let href = $(this).attr('href');
        xhref = href.split('#');

        $.ajax({
        url: "{{ url('/admin/user/view') }}",
            method: 'get',
            data: {
                href: xhref[1],
            },
            success: function(result){
                $('.modal-body').html(result);

                // Display Modal
                $('#userModal').modal('show');
            }
        });
    });

    $('#search').click(function(){
        let name = $('#name').val(),
            email = $('#email').val(),
            role = $('#role').val();

        if ( name !=='' || email !=='' || role !='')
        $.ajax({
            url: "{{ url('/admin/user/search') }}",
            method: 'get',
            data: {
                name: name,
                email: email,
                role: role
            },
            success: function(result){
                $('#search-result').html(result);
            }
        });
    });
});
</script>
</x-app-layout>