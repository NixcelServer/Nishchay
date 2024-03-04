@extends('frontend_home.leftmenu')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="max-width: 600px;">
                        <div class="card-header">
                            <h4 class="mt-2">Nixcel Software Solutions Departments</h4>
                        </div>
                        <div class="col-12 text-right mt-n4">
                            <div class="buttons">
                                <!-- Button to show Add Department Modal -->
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addDepartmentModal">Add New Department</button>
                            </div>
                        </div>
                        <!-- Table to display existing departments -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr >
                                            <th>Sr.No</th>
                                            <th>Department Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($depts as $key => $dept)
                                        <tr style="font-size: 15px;">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dept->dept_name }}</td>
                                            <td>
                                                <!-- Edit action link with encrypted ID -->
                                                <button class="btn btn-warning btn-sm toggle-edit-form"
                                                    data-dept-id="{{ $dept->tbl_dept_id }}"
                                                    data-encrypted-id="{{ $dept->encrypted_id }}">Edit</button>
                                                <!-- Delete action form with encrypted ID -->
                                                <button class="btn btn-danger btn-sm toggle-delete-form"
                                                    data-dept-id="{{ $dept->tbl_dept_id }}"
                                                    data-encrypted-id="{{ $dept->encrypted_id }}">Delete</button>
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


<!-- Add Department Modal -->
<!-- Add Department Modal -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addDepartmentForm" action="/admin/storedept" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">Add New Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="departmentName">Enter Department Name</label>
                        <input type="text" class="form-control" id="departmentName" name="departmentName" required>
                        <span id="departmentNameError" class="text-danger"></span>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($depts as $dept)
<div class="modal fade" id="editDepartmentModal_{{ $dept->tbl_dept_id }}" tabindex="-1" role="dialog" aria-labelledby="editDepartmentModalLabel_{{ $dept->tbl_dept_id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editDepartmentForm_{{ $dept->tbl_dept_id }}" action="/admin/editdept" method="POST">
                @csrf
                <input type="hidden" name="enc_id" value="{{ $dept->encrypted_id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDepartmentModalLabel_{{ $dept->tbl_dept_id }}">Edit Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editDepartmentName_{{ $dept->tbl_dept_id }}">Edit Department Name</label>
                        <input type="text" class="form-control departmentName" id="editDepartmentName_{{ $dept->tbl_dept_id }}" name="departmentName" value="{{ $dept->dept_name }}" required>
                        <span class="departmentNameError text-danger"></span>
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
    // Script to handle delete confirmation
    document.querySelectorAll('.toggle-delete-form').forEach(function (button) {
        button.addEventListener('click', function () {
            var departmentId = this.dataset.deptId;
            var encryptedId = this.dataset.encryptedId;
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this Department?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete Department'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/deletedept/" + encryptedId;
                }
            });
        });
    });

    // Script to toggle display of edit department form
    document.querySelectorAll('.toggle-edit-form').forEach(function (button) {
        button.addEventListener('click', function () {
            var departmentId = this.dataset.deptId;
            $('#editDepartmentModal_' + departmentId).modal('show');
        });
    });
</script>
