<div class="table-responsive">
    <table class="table table-hover table-bordered ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ $user->name }}</th> 
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Email</b></td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td><b>Role</b></td>
                <td>
                @if($user->user_type == 1)
                {{ 'Admin' }}
                @elseif($user->user_type == 2)
                {{ 'Customer' }}
                @else
                {{ 'Handyman'  }}
                @endif
                </td>
            </tr>
            @if($user->job_type_id)
            <tr>
                <td><b>Profession</b></td>
                <td>{{ $user->jobtypes->name }}</td>
            </tr>
            @endif
            @if($user->phone1)
            <tr>
                <td><b>Phone number</b></td>
                <td>{{ $user->phone1 }}</td>
            </tr>
            @endif
            @if($user->address)
            <tr>
                <td><b>Address</b></td>
                <td>{{ $user->address }}</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>