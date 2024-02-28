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
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mt-2">Nixcel Software Solutions Roles</h4>
                        </div>
                        <div class="col-12 text-right mt-n4">
                            <div class="buttons">
                                <button id="toggleForm" class="btn btn-primary">Add New Role</button>
                            </div>
                        </div>
                        <!-- Form to add new role -->
                        <div id="addRoleForm" style="display: none;">
                            <form method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="roleName">Enter Role Name</label>
                                        <input type="text" class="form-control" id="roleName" name="roleName" required>
                                    </div>
                                </div>
                                <div class="card-footer text-left">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $key => $role)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $role->role_name }}</td>
                                            <td>
                                                <!-- Edit action link with encrypted ID -->
                                                <a href="/admin/editrole/{{$role->encrypted_id}}" class="btn btn-warning">Edit</a>
                                                 <!-- Delete action form with encrypted ID -->
                                                <a href="/admin/deleterole/{{$role->encrypted_id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this role?')">Delete</a>
                                                
                                                <!-- Assign Module action link -->
                                                <a href="" class="btn btn-info">Assign Module</a>
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

<script>
    // Script to toggle display of add role form
    document.getElementById('toggleForm').addEventListener('click', function() {
        var addRoleForm = document.getElementById('addRoleForm');
        if (addRoleForm.style.display === 'none') {
            addRoleForm.style.display = 'block';
        } else {
            addRoleForm.style.display = 'none';
        }
    });
</script>
