@extends('frontend_home.leftmenu')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New User Registration</h4>
                        </div>
                        <form action="/admin/storeuser" method="POST"> <!-- Set the action to the route of your storeUser method -->
                            @csrf <!-- CSRF protection -->
                            <div class="card-body">
                                <div class="form-group row">
                                <div class="col">
                                 <input type="text" name="first_name" class="form-control" placeholder="Enter your first name" required>
                                    </div>

                                    <div class="col">
                                        <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="col">
    <input type="password" name="password" class="form-control" placeholder="Password" required>
    @error('password')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
                                    <div class="col">
                                        <input type="password" class="form-control" placeholder="Confirm Password" required>
                                    </div>
                          
                                </div>

                                <div class="form-group row">
                                <div class="col">
    <select name="tbl_role_id" class="form-control" style="border: 1px solid #b1a7a7; width: 15%;" required>
        <option value="">Select Role</option> <!-- Blank option -->
        @foreach($roles as $role)
            @if($role->role_name !== 'Admin')
                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
            @endif
        @endforeach
    </select>
</div>


                                    <div class="col-auto">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                        <button class="btn btn-secondary" type="reset">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
