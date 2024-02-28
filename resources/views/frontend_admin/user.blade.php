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
                                            @if($user->tbl_role_id == 1)
                                                Admin
                                            @elseif($user->tbl_role_id == 2)
                                                Hr
                                            @elseif($user->tbl_role_id == 3)
                                                Developer
                                            @elseif($user->tbl_role_id == 4)
                                                Manager
                                            @else
                                                Unknown Role
                                            @endif
                                            </td>
                                            <td>
                                                <!-- Edit action link with encrypted ID -->
                                                <a href="/admin/edituser/{{$user->encrypted_id}}" class="btn btn-warning">Edit</a>
                                                <!-- Delete action form with encrypted ID -->
                                                <a href="/admin/delete/{{$user->encrypted_id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                               
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
