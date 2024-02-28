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
                                            <a href="/admin/editdept/{{$designation->encrypted_id}}" class="btn btn-warning">Edit</a>
                                                <!-- Delete action form with encrypted ID -->
                                                <a href="/admin/deletedept/{{$designation->encrypted_id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
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
</script>
