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
            @foreach($userSearch as $userSearches)
            <tr>
                <td>{{ $userSearches->name }}</td>
                <td>{{ $userSearches->email }}</td>
                <td>
                    @if($userSearches->user_type == 1)
                    {{ 'Admin' }}
                    @elseif($userSearches->user_type == 2)
                    {{ 'Customer' }}
                    @else
                    {{ 'Handyman'  }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>