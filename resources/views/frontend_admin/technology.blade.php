@extends('frontend_home.leftmenu')

<style>
    .custom-thead {
        background-color: #c7e1ff;
    }
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }
</style> 

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="max-width: 1000px;">
                        <div class="card-header">
                            <h4 class="mt-2">Nixcel Software Solutions Technologies</h4>
                        </div>
                        <div class="col-12 text-right mt-n4">
                            <div class="buttons">
                                <!-- Button to show Add New Technology Modal -->
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addTechnologyModal">Add New Technology</button>
                            </div>
                        </div>
                        <!-- Table displaying technologies -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead class="custom-thead">
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Technology</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($technologies as $key => $technology)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $technology->tech_name }}</td>
                                            <td>
                                                <!-- Edit action link with encrypted ID -->
                                                <button class="btn btn-warning btn-sm toggle-edit-form"
                                                    data-technology-id="{{ $technology->tbl_technology_id }}"
                                                    data-encrypted-id="{{ $technology->enc_tbl_tech_id }}">Edit</button>
                                                <!-- Delete action form with encrypted ID -->
                                                <button href="/admin/deletetechnology/{{ $technology->enc_tbl_tech_id }}" class="btn btn-danger btn-sm delete-technology " data-encrypted-id="{{ $technology->enc_tbl_tech_id }}">Delete</button>
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

<!-- Add Technology Modal -->
<div class="modal fade" id="addTechnologyModal" tabindex="-1" role="dialog" aria-labelledby="addTechnologyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  action="/admin/storetechnology" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTechnologyModalLabel">Add New Technology</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="technologyName">Enter Technology Name</label>
                        <input type="text" class="form-control" id="technologyName" name="technologyName" required>
                        <span id="technologyNameError" class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Technology Modal -->
 @foreach($technologies as $technology) 
<div class="modal fade" id="editTechnologyModal_{{ $technology->tbl_technology_id }}" tabindex="-1" role="dialog" aria-labelledby="editTechnologyModalLabel_{{ $technology->tbl_technology_id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id=editTechnologyForm action="/admin/edittechnology" method="POST">
                @csrf
                <input type="hidden" name="enc_id" value="{{ $technology->encrypted_id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTechnologyModalLabel_{{ $technology->tbl_technology_id }}">Edit Technology</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editTechnologyName_{{ $technology->tbl_technology_id }}">Enter Technology Name</label>
                        <input type="text" class="form-control technologyName" id="editTechnologyName_{{ $technology->tbl_technology_id }}" name="technologyName" value="{{ $technology->technology_name }}" required>
                        <span class="text-danger technologyNameError"></span>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach 

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Script for delete confirmation with SweetAlert
    document.querySelectorAll('.delete-technology').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            var encryptedId = this.dataset.encryptedId; // Retrieve encrypted_id from data attribute

            // Use SweetAlert to confirm the delete action
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this Technology?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete Technology'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete URL
                    window.location.href = "/admin/deletetechnology/" + encryptedId;
                }
            });
        });
    });

    // Script to toggle display of edit technology form
    document.querySelectorAll('.toggle-edit-form').forEach(function (button) {
        button.addEventListener('click', function () {
            var technologyId = this.dataset.technologyId;
            $('#editTechnologyModal_' + technologyId).modal('show');
        });
    });
</script>