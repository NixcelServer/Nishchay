@extends('frontend_home.leftmenu')

<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }
</style>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mt-2">Nixcel Software Solutions Users</h4>
                        </div>
                        <div class="col-12 text-right mt-n4">
                            <div class="buttons">
                                <a href="/admin/createuser" class="btn btn-primary">Add New User</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if(isset($roles[$user->tbl_role_id]))
                                                    {{ $roles[$user->tbl_role_id] }}
                                                @else
                                                    Unknown Role
                                                @endif
                                            </td> 
                                            <td>
                                                <!-- Edit action link with encrypted ID -->
                                                <a href="/admin/edituser/{{$user->encrypted_id}}" class="btn btn-warning btn-sm">Edit</a>
                                                <!-- Delete action form with encrypted ID and SweetAlert confirmation -->
                                                <a href="/admin/delete/{{$user->encrypted_id}}" class="btn btn-danger btn-sm delete-user" data-encrypted-id="{{$user->encrypted_id}}">Delete</a>
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
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Script to handle SweetAlert confirmation for user deletion
    document.querySelectorAll('.delete-user').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default action of the link
            
            var encryptedId = this.dataset.encryptedId; // Retrieve encrypted_id from data attribute

            // Display SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this User?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete User'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete URL if user confirms
                    window.location.href = "/admin/delete/" + encryptedId;
                }
            });
        });
    });
</script>
