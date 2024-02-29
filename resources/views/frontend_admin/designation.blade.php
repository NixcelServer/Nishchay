[16:55] Abhijeet Bhosale
@extends('frontend_home.leftmenu')
 
<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }
 
    #designationName{
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
                            <h4 class="mt-2">Nixcel Software Solutions Designation</h4>
                        </div>
                        <div class="col-12 text-right mt-n4">
                            <div class="buttons">
                                <button id="toggleForm" class="btn btn-primary">Add New Designation</button>
                            </div>
                        </div>
                        <!-- Form to add new designation -->
                        <div id="addDesignationForm" style="display: none;">
                            <form action="/admin/storedesignation" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="designationName">Enter Designation Name</label>
                                        <input type="text" class="form-control" id="designationName" name="designationName" required>
                                    </div>
                                </div>
                                <div class="card-footer text-left">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- Edit form for designation -->
                        @foreach($designations as $designation)
                        <form action="/admin/editdesignation" method="POST" id="editDesignationForm_{{ $designation->tbl_designation_id }}"
                            style="display: none;">
                            @csrf
                            <input type="hidden" name="enc_id" value="{{ $designation->encrypted_id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="designationName">Enter Designation Name</label>
                                    <input type="text" class="form-control" id="designationName" name="designationName"
                                        required value="{{ $designation->designation_name }}">
                                </div>
                            </div>
                            <div class="card-footer text-left">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @endforeach
                        <!-- Table displaying designations -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Designation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($designations as $key => $designation)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $designation->designation_name }}</td>
                                            <td>
                                                <!-- Edit action link with encrypted ID -->
                                                <button class="btn btn-warning toggle-edit-form"
                                                    data-designation-id="{{ $designation->tbl_designation_id }}"
                                                    data-encrypted-id="{{ $designation->encrypted_id }}">Edit</button>
                                                <!-- Delete action form with encrypted ID -->
                                                <a href="/admin/deletedesignation/{{$designation->encrypted_id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
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
    // Script to toggle display of add designation form
    document.getElementById('toggleForm').addEventListener('click', function() {
        var addDesignationForm = document.getElementById('addDesignationForm');
        if (addDesignationForm.style.display === 'none') {
            addDesignationForm.style.display = 'block';
        } else {
            addDesignationForm.style.display = 'none';
        }
    });
 
    // Script to toggle display of edit designation form
    document.querySelectorAll('.toggle-edit-form').forEach(function (button) {
        button.addEventListener('click', function () {
            var designationId = this.dataset.designationId; // Retrieve id from data attribute
            var encryptedId = this.dataset.encryptedId; // Retrieve encrypted_id from data attribute
 
            // Set the value of the hidden field in the edit form
            var editDesignationForm = document.getElementById('editDesignationForm_' + designationId);
            var encryptedIdField = editDesignationForm.querySelector('input[name="enc_id"]');
            encryptedIdField.value = encryptedId;
 
            // Toggle display of the edit form
            if (editDesignationForm.style.display === 'none') {
                editDesignationForm.style.display = 'block';
            } else {
                editDesignationForm.style.display = 'none';
            }
        });
    });
</script>
 