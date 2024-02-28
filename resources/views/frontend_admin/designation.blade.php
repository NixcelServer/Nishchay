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
                            <form method="POST">
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
                                    {{-- <tbody>
                                        @foreach($users as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            
                                            <td>
                                                <!-- Update action link with encrypted ID -->
                                                <a href="{{ route('user.edit', $user->id) }}">Update</a>
                                                <!-- Delete action form with encrypted ID -->
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody> --}}
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
