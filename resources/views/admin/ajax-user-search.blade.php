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
                <td><a href="#{{ $userSearches->id }}" class="user-details">{{ $userSearches->name }}</a></td>
                <td><a href="#{{ $userSearches->id }}" class="user-details">{{ $userSearches->email }}</a></td>
                <td><a href="#{{ $userSearches->id }}" class="user-details">
                    @if($userSearches->user_type == 1)
                    {{ 'Admin' }}
                    @elseif($userSearches->user_type == 2)
                    {{ 'Customer' }}
                    @else
                    {{ 'Handyman'  }}
                    @endif
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $userSearch->links() }}
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

<script>
$(function(){

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
});
</script>