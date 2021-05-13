<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">

                <!-- cardboard report -->
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
                                    <p class="card-text inner-text">CUSTOMERS </p>
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
                                <button type="button" class="btn btn-outline-danger " style="display:none; margin-left: 20px;" id="del-btn" > 
                                    Delete  <span class="material-icons"></span>
                                </button>
                            </div>
                        </div>   
                    </div>
                    
                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1" id="filter-section">
                        <div class="p-3">
                            
                            <form method="GET" action="{{ route('admin.user-search') }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        <input id="name" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                                            focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="name" value="{{ request()->query('name') }}" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <x-jet-label for="email" value="{{ __('Email') }}" />
                                        <input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                                            focus:ring-opacity-50 rounded-md shadow-sm" type="email" name="email" value="{{ request()->query('email') }}" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <x-jet-label for="role" value="{{ __('Role') }}" />
                                        <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                        <option selected>All</option>
                                        <option value="1" {{ request()->query('role') ==  1 ? 'selected' : ''}} >Admin</option>
                                        <option value="2" {{ request()->query('role') ==  2 ? 'selected' : ''}}>Customer</option>
                                        <option value="3" {{ request()->query('role') ==  3 ? 'selected' : ''}}>Handyman</option>
                                        </select>
                                    </div>
                                </div>  
                                <x-jet-button class="mt-4">
                                    {{ __('Search') }} 
                                </x-jet-button> 
                            </div>
                            </form>
                            
                        </div>
                    </div>
                        
                    <div id="search-result" >
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered ">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="10"><input type="checkbox"  id="checkall"></th>
                                        <th scope="col">Name</th>  
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Verified Status</th>
                                    </tr>
                                </thead>
                                <tbody id="ms-tb">
                                    @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="bulk-check" value="{{$user->id}}">
                                        </td>
                                        <td><a href="#{{ $user->id }}" class="user-details">{{ $user->name }}</a></td>
                                        <td><a href="#{{ $user->id }}" class="user-details">{{ $user->email }}</a></td>
                                        
                                        @if ( $user->role_id == 1)
                                        <td><span>{{ __('Admin') }}</span></td>
                                        @elseif ( $user->role_id == 2)
                                        <td><span  >{{ __('Customer') }}</span></td>
                                        @elseif ( $user->role_id == 3)
                                        <td><span  >{{ __('Handyman') }}</span></td>
                                        @endif

                                        @if(is_null($user->email_verified_at))
                                        <td>{{ __('Not Verified') }}</td>
                                        @else
                                        <td>{{ __('Verified') }}</td>
                                        @endif

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->appends([
                                        'name'=> request()->query('name'),
                                        'email'=>request()->query('email')
                                    ])
                                    ->links() }}
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

    // bulk delete
    $('#checkall').click(function(){

    if ($(this).prop('checked') == true){
        $('.bulk-check').prop('checked',true);
        $('#del-btn').show();
    }else{
        $('.bulk-check').prop('checked',false);
        $('#del-btn').hide();
    }
    });

    $('#ms-tb :checkbox').change(function(){

        if($('#ms-tb :checkbox:not(:checked)').length == 0){ 
            // all are checked
            $('#checkall').prop('checked', true);
            $('#del-btn').show();
        } else if($('#ms-tb :checkbox:checked').length >  0){
            // all are unchecked
            $('#checkall').prop('checked', false);
            $('#del-btn').show();
        }else{
            $('#del-btn').hide();
        }
    });

    $('#del-btn').click(function(){
        if(confirm("Are you sure?")){
            var delId = [];

            $('.bulk-check:checked').each(function(i){
                delId.push($(this).val());
                element = this;
            });

            if(delId.length>0){
                $.ajax({
                    url: '/admin/user/bulkdelete',
                    method: 'get',
                    data: {id:delId},
                    success:function(){
                        for(var i=0; i<delId.length; i++)
                        {
                            $('tr#'+delId[i]+'').css('background-color', '#ccc');
                            $('tr#'+delId[i]+'').fadeOut('slow');
                            $('#checkall').prop('checked', false);
                            $('#del-btn').hide();
                        }
                        location.reload();
                    }
                });
            }
        }
    });

    if ( $('#name').val() || $('#email').val() || $('#role').val() !='All' ) {
        $('#filter-section').show();
    }else{
        $('#filter-section').hide();
    }  

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