@extends('frontend_home.leftmenu')
 
<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }
 
    #designationName{
        width: 400px; /* Adjust the width as needed */
    }
</style>
 
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="max-width: 1000px;">
                        <div class="card-header">
                            <h4 class="mt-2">Nixcel Software Solutions Queries</h4>
                        </div>
                        <div class="col-12 text-right mt-n4">
                            <div class="buttons">
                                <!-- Button to show Add New Designation Modal -->
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addDesignationModal">Add New Query</button>
                            </div>
                        </div>
                        <!-- Table displaying designations -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Query Description</th>
                                            <th>Query Raised to</th>
                                            <th>Answers</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tbody>
                                        {{-- @foreach($designations as $key => $designation)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $designation->designation_name }}</td>
                                            <td>
                                                <!-- Edit action link with encrypted ID -->
                                                <button class="btn btn-warning btn-sm toggle-edit-form"
                                                    data-designation-id="{{ $designation->tbl_designation_id }}"
                                                    data-encrypted-id="{{ $designation->encrypted_id }}">Edit</button>
                                                <!-- Delete action form with encrypted ID -->
                                                <a href="/admin/deletedesignation/{{ $designation->encrypted_id }}" class="btn btn-danger btn-sm delete-designation" data-encrypted-id="{{ $designation->encrypted_id }}">Delete</a>
                                            </td>

                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                    </tbody>
                                </table>
                                <div class="card-footer text-right">
                                    <nav class="d-inline-block">
                                      <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                          <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                              class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                          <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                          <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                      </ul>
                                    </nav>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
    .modal-body .form-group {
        margin-bottom: 0; /* Remove bottom margin */
    }
</style>
<!-- Add Designation Modal -->
<div class="modal fade" id="addDesignationModal" tabindex="-1" role="dialog" aria-labelledby="addDesignationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  action="/admin/storedesignation" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addDesignationModalLabel">Add New Query</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="designationName">Enter Query</label>

                        <input type="text" class="form-control" id="designationName" name="designationName" required>
                        <span id="designationNameError" class="text-danger"></span>

                    </div>
                </div>
                <div class="modal-footer justify-content-center"> <!-- Add justify-content-center class -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Script for delete confirmation with SweetAlert
    document.querySelectorAll('.delete-designation').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            var encryptedId = this.dataset.encryptedId; // Retrieve encrypted_id from data attribute

            // Use SweetAlert to confirm the delete action
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this Designation?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete Designation'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete URL
                    window.location.href = "/admin/deletedesignation/" + encryptedId;
                }
            });
        });
    });


</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

