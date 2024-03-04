@extends('frontend_home.leftmenu')
 
<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }
 
    /* Custom CSS to adjust width of input field */
    #roleName {
        width: 200px; /* Adjust the width as needed */
    }
 
    .card-footer.text-left button {
        margin-top: -5px; /* Adjust this value as needed */
    }
</style>
 
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="max-width: 650px;">
                        <div class="card-header">
                            <h4 class="mt-2">Nixcel Software Solutions Roles</h4>
                        </div>
                        <div class="col-12 text-right mt-n4">
                            <div class="buttons">
                                <!-- Button to show Add New Role Modal -->
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addRoleModal">Add New Role</button>
                            </div>
                        </div>


                       <!-- Table displaying roles -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr >
                                            <th>Sr.No</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $serialNumber = 0;
                                        @endphp
                                        @foreach($roles as $role)
                                            @if($role->tbl_role_id !== 1)
                                                <tr>
                                                    <td>{{ ++$serialNumber }}</td>
                                                    <td>{{ $role->role_name }}</td>
                                                    <td>
                                                        <!-- Edit action link with encrypted ID -->
                                                        <button class="btn btn-warning toggle-edit-form"
                                                                data-role-id="{{ $role->tbl_role_id }}"
                                                                data-encrypted-id="{{ $role->encrypted_id }}">Edit</button>

                                                        <!-- Delete action form with encrypted ID -->
                                                        <a href="/admin/deleterole/{{$role->encrypted_id}}" class="btn btn-danger delete-role" data-encrypted-id="{{ $role->encrypted_id }}">Delete</a>

                                                        <!-- Assign Module action link -->
                                                        <a href="/admin/assignmodule/{{$role->encrypted_id}}" class="btn btn-info">Assign Module</a>
                                                    </td>
                                                </tr>
                                            @endif
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

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/admin/storerole" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">Add New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="roleName">Enter Role Name</label>
                        <input type="text" class="form-control" id="roleName" name="roleName" style="width: 450px;" required>
                    </div>
                    
                    <!-- Add other fields related to adding a new role if needed -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Role Modal -->
@foreach($roles as $role)
<div class="modal fade" id="editRoleModal_{{ $role->tbl_role_id }}" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel_{{ $role->tbl_role_id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/admin/editrole" method="POST">
                @csrf
                <input type="hidden" name="enc_id" value="{{ $role->encrypted_id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel_{{ $role->tbl_role_id }}">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editRoleName_{{ $role->tbl_role_id }}">Enter Role Name</label>
                        <input type="text" class="form-control" id="editRoleName_{{ $role->tbl_role_id }}" name="roleName" value="{{ $role->role_name }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach







<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        // Script to handle deletion confirmation using SweetAlert
        document.querySelectorAll('.delete-role').forEach(function (button) {
            button.addEventListener('click', function (event) {
                var encryptedId = this.dataset.encryptedId; // Retrieve encrypted_id from data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to delete this role?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete Role'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with deletion if confirmed
                        window.location.href = '/admin/deleterole/' + encryptedId;
                    }
                });

                // Prevent the default action of the link
                event.preventDefault();
            });
        });
    



    // Script to toggle display of edit role form
document.querySelectorAll('.toggle-edit-form').forEach(function (button) {
    button.addEventListener('click', function () {
        var roleId = this.dataset.roleId;
        $('#editRoleModal_' + roleId).modal('show');
    });
});

</script>