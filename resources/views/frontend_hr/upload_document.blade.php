@extends('frontend_home.leftmenu')

<div class="main-content">
    <section class="section">
        <div class="section-body">
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
                                    <input type="hidden" name="enc_user_id" value="{{ $enc_user_id }}">
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
                                                <input type="file" class="custom-file-input" id="document" name="document">
                                                <label class="custom-file-label" for="document">Choose file</label>
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
                          <th>Document Name</th>
                          {{-- <th>Document Type</th> --}}
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($docs as $index => $doc)
                        <tr>
                            
                          <td>{{ $index + 1 }}</td>
                          <td>{{ $doc->doc_name }}</td>
                        {{-- <td>{{ $doc->doc_path }}</td> --}}  
                          <td>
      

                           {{-- <a href="#">
                                <i class="fas fa-eye"></i> View
                            </a>  --}} 
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