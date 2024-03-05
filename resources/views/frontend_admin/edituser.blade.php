@extends('frontend_home.leftmenu')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit User</h4>
                        </div>
                        <form id="registrationForm" action="/admin/edituser" method="POST" > <!-- Set the action to the route of your storeUser method -->
                            @csrf <!-- CSRF protection -->
                            <div class="card-body">
                            <div class="form-group row">
                                    <div class="col">
                                        <label for="first_name">First Name</label>
                                    <input type="hidden" name="enc_id" value="{{ $enc_id }}">
                                        <input type="text" name="first_name" class="form-control" placeholder="First Name"
                                        value="{{ $user->first_name }}">
                                    </div>
                                    <div class="col">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" name="middle_name" class="form-control" placeholder="Middle Name"
                                        value="{{ $user->middle_name }}">
                                    </div>
                                    <div class="col">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name"
                                        value="{{ $user->last_name}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    
                                    <div class="col">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                        value="{{ $user->email}}" readOnly>
                                    </div>
                                   
                                    <div class="col">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required>
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="col">
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm Password" required >
                                        <div id="passwordMatch"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                <div class="col">
                                    <select name="tbl_role_id" class="form-control" style="border: 1px solid #b1a7a7; width: 35%;" required>
                                        <option value="">Select Role</option> <!-- Blank option -->
                                        @foreach($roles as $role)
                                            @if($role->role_name !== 'Admin')
                                                <option value="{{ $role->encrypted_id }}">{{ $role->role_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary" type="submit">Submit</button>
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

<script>
    function checkPasswordMatch() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        if (password !== confirmPassword) {
            document.getElementById("passwordMatch").innerHTML = "Passwords do not match!";
        } else {
            document.getElementById("passwordMatch").innerHTML = "";
        }
    }

</script>