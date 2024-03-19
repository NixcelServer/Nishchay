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
                        <form action="" method="POST"> <!-- Set the action to the route of your storeUser method -->
                            @csrf <!-- CSRF protection -->
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="document_type">Document Type</label>
                                        <select name="document_type" class="form-control" id="document_type">
                                            <option value="passport">Passport</option>
                                            <option value="driver_license">Driver's License</option>
                                            <option value="id_card">ID Card</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="document">Attach Document</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="document" name="document">
                                                <label class="custom-file-label" for="document">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="attachBtn">Attach</button>
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
                          <th>Employee Name</th>
                          <th>Document Type</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Abhijeet Kiran Bhosale</td>
                          <td>PAN Card</td>
                          <td>
                            <a href="#">
                                <i class="fas fa-eye"></i> View
                            </a>
                            </td>
                        </tr>
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