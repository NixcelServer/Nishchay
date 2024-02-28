@extends('frontend_home.leftmenu')

<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }

    #departmentName{
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
                            <h4 class="mt-2">Nixcel Software Solutions Departments</h4>
                        </div>
                        <div class="col-12 text-right mt-n4">
                            <div class="buttons">
                                <!-- Button to toggle add department form -->
                                <button class="btn btn-primary" id="toggleForm">Add New Department</button>
                            </div>
                        </div>
                        <!-- Form to add new department -->
                        <div id="addDepartmentForm" style="display: none;">
                            <form method="POST">                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="departmentName">Enter Department Name</label>
                                        <input type="text" class="form-control" id="departmentName" name="departmentName" required>
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
                                            <th>Department Name</th>
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
    // Script to toggle display of add department form
    document.getElementById('toggleForm').addEventListener('click', function() {
        var addDepartmentForm = document.getElementById('addDepartmentForm');
        if (addDepartmentForm.style.display === 'none') {
            addDepartmentForm.style.display = 'block';
        } else {
            addDepartmentForm.style.display = 'none';
        }
    });
</script>
