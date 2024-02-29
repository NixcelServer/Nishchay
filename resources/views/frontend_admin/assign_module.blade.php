@extends('frontend_home.leftmenu')

<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }

    #roleName, #selectModule {
        width: 200px; /* Adjust the width as needed */
    }
</style>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mt-2">Nixcel Software Solutions Modules</h4>
                        </div>

                        <!-- Form to add Role Name, Select Module, and Assign button -->
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="roleName">Role Name</label>
                                    <input type="text" class="form-control" id="roleName" name="roleName">
                                </div>
                                <div class="form-group">
                                    <label for="selectModule">Select Module</label>
                                    <select class="form-control" id="selectModule" name="selectModule">
                                        <!-- Populate options dynamically based on modules -->
                                        {{-- @foreach ($modules as $module)
                                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Assign</button>
                            </form>
                        </div>

                        <!-- Table displaying modules -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Role</th>
                                            <th>Modules</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @foreach ($designations as $key => $designation)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $designation->designation_name }}</td>
                                                <td>
                                                    <!-- Edit action link with encrypted ID -->
                                                    <button class="btn btn-warning toggle-edit-form"
                                                        data-designation-id="{{ $designation->id }}"
                                                        data-encrypted-id="{{ $designation->encrypted_id }}">Edit</button>
                                                    <!-- Delete action form with encrypted ID -->
                                                    <a href="/admin/deletedesignation/{{ $designation->encrypted_id }}"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
