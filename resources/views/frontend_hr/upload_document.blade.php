@extends('frontend_home.leftmenu')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <h4>User Details</h4>
                        </div>
                        <div class="card-body">
                            <p>User Name: {{ $empDetails->empName }}</p>
                            <p>Emp Code: {{ $empDetails->emp_code }} </p>
                            <p>Email: {{ $empDetails->email }}</p>
                            <p>Contact No: {{ $empDetails->contact_no}} </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <h4>Upload Documents</h4>
                        </div>
                        <form action="/Employees/uploaddoc" method="POST" enctype="multipart/form-data"> <!-- Set the action to the route of your storeUser method -->
                            @csrf <!-- CSRF protection -->
                            <div class="card-body">
                                <div class="form-group row">
                                  <div class="col">

                                    <input type="hidden" name="enc_user_id" value="{{ $enc_user_id}}">
                                        <label for="document_type">Document Type</label>
                                        <select name="doc_type_id" class="form-control" id="doc_type_id">
                                            <option value="">Select Document Type</option>
                                            @foreach ($docTypes as $docType)
                                            <option value="{{ $docType->enc_doc_type_id}}">{{ $docType->doc_type }}</option>
                                            @endforeach 

                                        </select>
                                    </div>
                                    <div class="col">
                                      <label for="document">Attach Document</label>
                                      <div class="input-group">
                                          <div class="custom-file">
                                              <input type="file" class="custom-file-input" id="document" name="document" onchange="updateFileName(this)">
                                              <label class="custom-file-label" for="document" id="documentLabel">Choose file</label>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-success">Upload Document</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Uploaded Documents</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr>
                                          <th>Sr. No</th>

                                          <th>Document Type</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($docs as $index => $doc)
                                      <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $doc->doc_name }}</td>
                                        <td>{{ $doc->doc_status }}</td>
                                        
                                        <td>
                                          <div class="d-flex justify-content-between">
                                            <button href="#" onclick="openDocument('/{{ $doc->doc_path}}{{ $doc->doc_name}}', {{ json_encode($doc->enc_tbl_doc_id) }})" class="mr-2">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            
                                            <button type="button" class="btn btn-danger" onclick="deleteDocument({{ json_encode($doc->enc_tbl_doc_id) }})">

                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </div>
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

  function openDocument(documentUrl,documentId) {

    console.log("Document ID:", documentId);
      $('#documentFrame').attr('src', documentUrl);

      // Update the content of the modal with the document ID
    $('#documentModal').find('.document-id').text(documentId);

    // Set the document ID into the href attribute of the Verify Document button
    var verifyUrl = "/Employees/verifydoc/" + documentId;
    $('#verifyDocumentBtn').attr('href', verifyUrl);
      
      $('#documentModal').modal('show');
      console.log("Document ID:", documentId);

  }

  function verifyDocument() {
      // Your verification logic goes here
      Swal.fire({
          icon: 'success',
          title: 'Document Verified!',
          showConfirmButton: false,

          timer: 100000
      });

      // Extract the document ID from the modal
    var documentId = $('#documentId').text();
    
    // Construct the verification URL with the document ID
    var verifyUrl = "/Employees/verifydoc/" + documentId;

     

    //Optionally, you can navigate to the verification URL if needed
     // Redirect to the verification URL after the specified time
     
        window.location.href = verifyUrl;
    
    // Ensure the timeout matches the Swal timer duration
}
     
  


  function updateFileName(input) {
      var fileName = input.files[0].name;
      $('#documentLabel').text(fileName);
  }

  function deleteDocument(documentId) {
      // Add logic to delete the document with the given ID
      // For example, you can make an AJAX request to delete the document

      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {

            var deleteUrl = "/Employees/deletedoc/" +documentId;
            //window.location.href = deleteUrl;

              // Here you can place your logic to delete the document
              Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
              );

              window.location.href = deleteUrl;

          }
      });
  }
</script>

<!-- Include SweetAlert script in your HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal for displaying document -->
<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="documentModalLabel">Document Preview</h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <iframe id="documentFrame" src="" width="100%" height="500px" frameborder="0"></iframe>
              <div class="text-center mt-3">

              <span id="documentId" style="display: none;"></span>
              @if($verifyButton)
              <a id="verifyDocumentBtn" href="#" class="btn btn-primary" onclick="verifyDocument()">
            Verify Document
        </a> 
              @endif          
          </a>
</div>

          </div>
      </div>
  </div>
</div>
