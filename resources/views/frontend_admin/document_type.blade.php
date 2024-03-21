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
                            <h4 class="mt-2">Nixcel Software Solutions Document Types</h4>
                        </div>
                        <div class="col-12 text-right mt-n4">
                            <div class="buttons">
                                <!-- Button to show Add New Document Type Modal -->
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addDocumentTypeModal">Add New Document Type</button>
                            </div>
                        </div>
                        <!-- Table displaying document types -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead class="custom-thead">
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Document Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                         @foreach($docTypes as $key => $documentType)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $documentType->doc_type }}</td>
                                            <td>
                                                <!-- Edit action link with encrypted ID -->
                                                <button class="btn btn-warning btn-sm toggle-edit-form"
                                                    
                                                    data-encrypted-id="{{ $documentType->enc_tbl_doc_type_id }}">Edit</button>
                                                <!-- Delete action form with encrypted ID -->
                                                <button href="/admin/deletedocumenttype/{{ $documentType->enc_tbl_doc_type_id }}" class="btn btn-danger btn-sm delete-document-type" data-encrypted-id="{{ $documentType->enc_tbl_doc_type_id }}">Delete</button>
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
<style>
    .modal-body .form-group {
        margin-bottom: 0; /* Remove bottom margin */
    }
</style>

<!-- Add Document Type Modal -->
<div class="modal fade" id="addDocumentTypeModal" tabindex="-1" role="dialog" aria-labelledby="addDocumentTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  action="/admin/storedocumenttype" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addDocumentTypeModalLabel">Add New Document Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="documentTypeName">Enter Document Type Name</label>
                        <input type="text" class="form-control" id="documentTypeName" name="documentTypeName" required>
                        <span id="documentTypeNameError" class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer justify-content-center"> <!-- Add justify-content-center class -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Document Type Modal -->
{{-- @foreach($documentTypes as $documentType) 
<div class="modal fade" id="editDocumentTypeModal_{{ $documentType->tbl_document_type_id }}" tabindex="-1" role="dialog" aria-labelledby="editDocumentTypeModalLabel_{{ $documentType->tbl_document_type_id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id=editDocumentTypeForm action="/admin/editdocumenttype" method="POST">
                @csrf
                <input type="hidden" name="enc_id" value="{{ $documentType->encrypted_id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDocumentTypeModalLabel_{{ $documentType->tbl_document_type_id }}">Edit Document Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editDocumentTypeName_{{ $documentType->tbl_document_type_id }}">Enter Document Type Name</label>
                        <input type="text" class="form-control documentTypeName" id="editDocumentTypeName_{{ $documentType->tbl_document_type_id }}" name="documentTypeName" value="{{ $documentType->document_type_name }}" required>
                        <span class="text-danger documentTypeNameError"></span>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Script for delete confirmation with SweetAlert
    document.querySelectorAll('.delete-document-type').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            var encryptedId = this.dataset.encryptedId; // Retrieve encrypted_id from data attribute

            // Use SweetAlert to confirm the delete action
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this Document Type?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete Document Type'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete URL
                    window.location.href = "/admin/deletedocumenttype/" + encryptedId;
                }
            });
        });
    });

    // Script to toggle display of edit document type form
    document.querySelectorAll('.toggle-edit-form').forEach(function (button) {
        button.addEventListener('click', function () {
            var documentTypeId = this.dataset.documentTypeId;
            $('#editDocumentTypeModal_' + documentTypeId).modal('show');
        });
    });

</script>

