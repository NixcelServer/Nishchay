@extends('frontend_home.leftmenu')
 
<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }
 
    #roleName, #selectModule {
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
                            <h4 class="mt-2">Nixcel Software Solutions Modules</h4>
                        </div>
 
                        <!-- Form to add Role Name, Select Module, and Assign button -->
                        <div class="card-body">
                        
                            <form action="/admin/assignmodule" method="POST">
                                @csrf
                                <div class="form-group">
                                    <h4><label for="roleName">Role : {{ $role->role_name }} </label></h4>
                                   <!-- <input type="text" class="form-control" id="roleName" name="roleName"> -->
                                   <input type="hidden" id="enc_id" name="enc_id" value="{{ $enc_id }}">
 
                                </div>
                                <div class="form-group">
                                     <label for="selectModule">Select Module</label>
                                     <select class="form-control" id="selectModule" name="selectModule">
                                     <option value="">Select Module</option>

                                     @foreach($mod as $module)
                                     <option value="{{ $module->encrypted_id }}">{{ $module->module_name }}</option>
                                     @endforeach
                                     </select>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Assign</button>
                                @if(session('error'))
                                <p class="text-danger">{{ session('error') }}</p>
                                    </div>
                                @endif
                                @if(session('success'))
                                    <p class="text-success">{{ session('success') }}</p>
                                @endif
                            </form>
                        </div>
 
                        <!-- Table displaying modules -->
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No</th>
                                                    <th>Role</th>
                                                    <th>Modules</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach ($moduleData as $key => $moduleItem)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $role->role_name }}</td>
                                                    <td>{{ $moduleItem['module']->module_name }}</td>
                                                    <!-- Display other module information as needed -->
                                                    <td>
                                                    <form action="/admin/deletemodule" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="moduleId" value="{{ $moduleItem['module']->id }}">
                                                        <input type="hidden" name="roleModuleId" value="{{ $moduleItem['enc_role_module_id'] }}"> <!-- Pass encrypted role module ID -->
 
                                                        <button type="submit" class="btn btn-danger">Delete</button>
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