@extends('frontend_home.leftmenu')

<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }
</style>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mt-2">Nixcel Software Solutions Users</h4>
                        </div>
                        <div class="col-12 text-right mt-n1">
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Employee Code</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact No</th>
                                            <th>Status</th>
                                            <th>Designation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($emps as $key => $emp)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $emp->emp_code }}</td>
                                            <td>{{ $emp->first_name }} {{ $emp->middle_name }} {{ $emp->last_name }}</td>
                                            <td>{{ $emp->email }}</td>
                                            <td>{{ $emp->contact_no }}</td>
                                            <td>{{ $emp->status }}</td>

                                            
                                            <td>
                                                @if($emp->role_id == 2)
                                                    HR
                                                @elseif($emp->role_id == 3)
                                                    Developer
                                                @elseif($emp->role_id == 4)
                                                    Manager    
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Edit action link with encrypted ID -->
                                                <a href="/hr/editemp/{{ $emp->encrypted_id }}" class="btn btn-warning btn-sm">Edit</a>
                                                <!-- Delete action form with encrypted ID -->
                                                <form action="" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                                </form>
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
