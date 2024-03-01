@extends('frontend_home.leftmenu')

<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }

    #departmentName {
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
                            <h4 class="mt-2">Nixcel Software Solutions Departments</h4>
                        </div>
                        <div class="col-12 text-right mt-n4">
                            <div class="buttons">
                                <!-- Button to toggle add department form -->
                                <button class="btn btn-primary" id="toggleForm">Add New Department</button>
                            </div>
                        </div>
                        <!-- Form to add new department -->
                        <div id="addDepartmentForm" style="display: none;">
                            <form action="/admin/storedept" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="departmentName">Enter Department Name</label>
                                        <input type="text" class="form-control" id="departmentName" name="departmentName"
                                            required>
                                            @error('departmentName')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                                    </div>
                                </div>
                                <div class="card-footer text-left">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- Hidden form for editing department -->
                        @foreach($depts as $dept)
                        <form action="/admin/editdept" method="POST" id="editDepartmentForm_{{ $dept->tbl_dept_id }}"
                            style="display: none;">
                            @csrf
                            <input type="hidden" name="enc_id" value="{{ $dept->encrypted_id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="departmentName">Enter Department Name</label>
                                    <input type="text" class="form-control" id="departmentName" name="departmentName"
                                        required>
                                </div>
                            </div>
                            <div class="card-footer text-left">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @endforeach
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Department Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($depts as $key => $dept)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dept->dept_name }}</td>
                                            <td>
                                                <!-- Edit action link with encrypted ID -->
                                                <button class="btn btn-warning toggle-edit-form"
                                                    data-dept-id="{{ $dept->tbl_dept_id }}"
                                                    data-encrypted-id="{{ $dept->encrypted_id }}">Edit</button>

                                                <!-- Delete action form with encrypted ID -->
                                                <a href="/admin/deletedept/{{$dept->encrypted_id}}"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
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
    // Script to toggle display of add department form
    document.getElementById('toggleForm').addEventListener('click', function () {
        var addDepartmentForm = document.getElementById('addDepartmentForm');
        if (addDepartmentForm.style.display === 'none') {
            addDepartmentForm.style.display = 'block';
        } else {
            addDepartmentForm.style.display = 'none';
        }
    });

    // Script to toggle display of edit department form
    document.querySelectorAll('.toggle-edit-form').forEach(function (button) {
        button.addEventListener('click', function () {
            var departmentId = this.dataset.deptId; // Retrieve tbl_dept_id from data attribute
            var encryptedId = this.dataset.encryptedId; // Retrieve encrypted_id from data attribute

            // Set the value of the hidden field in the edit form
            var editDepartmentForm = document.getElementById('editDepartmentForm_' + departmentId);
            var encryptedIdField = editDepartmentForm.querySelector('input[name="enc_id"]');
            encryptedIdField.value = encryptedId;

            // Toggle display of the edit form
            if (editDepartmentForm.style.display === 'none') {
                editDepartmentForm.style.display = 'block';
            } else {
                editDepartmentForm.style.display = 'none';
            }
        });
    });

</script>
