@extends('frontend_home.leftmenu')

<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
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
                                            {{-- <th>Role</th> --}}
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
                                            <td>{{ $emp->desg_name }}</td>
                
                                            <td class="action-buttons">
                                                @php
                                                $moduleData = Session::get('moduleData');
                                                $containsEditEmployeeModule = false;
                                                $containsDeleteEmployeeModule = false;

                                                if($moduleData){
                                                    foreach($moduleData as $data){
                                                        $moduleName = $data['module']->module_name; 
                                                        if($moduleName == 'Edit Employee'){
                                                            $containsEditEmployeeModule = true;
                                                        }
                                                        if($moduleName == 'Delete Employee'){
                                                            $containsDeleteEmployeeModule = true;
                                                        }
                                                        if ($containsEditEmployeeModule && $containsDeleteEmployeeModule) {
                                                            break;
                                                        }
                                                    }
                                                }
                                                @endphp
                                               
                                                @if($containsEditEmployeeModule)
                                                <!-- Edit action link with encrypted ID -->
                                                <a href="/Employees/editemp/{{ $emp->encrypted_id }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                                    title="Edit User"><i class="fas fa-edit"></i></a>
                                                                                                @endif
                                               <a href="/Employees/uploaddoc" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                               title="Upload Documents"><i class="fas fa-file-upload"></i></a>                                               
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
