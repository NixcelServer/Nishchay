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
                        <form id="registrationForm" action="/admin/storeuser" method="POST" onsubmit="return validateForm();"> <!-- Set the action to the route of your storeUser method -->
                            @csrf <!-- CSRF protection -->
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name') }}" required pattern="^[A-Za-z\s]+$">
                                        <small class="text-danger" id="firstNameError"></small>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="{{ old('middle_name') }}" pattern="^[A-Za-z\s]+$">
                                        <small class="text-danger" id="middleNameError"></small>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ old('last_name') }}" required pattern="^[A-Za-z\s]+$">
                                        <small class="text-danger" id="lastNameError"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required pattern="[a-z0-9._%+-]+@gmail\.com$" >
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                        <small class="text-danger" id="emailError"></small>
                                    </div>
                                    <div class="col">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required>
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="col">
                                        <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm Password" required onkeyup="checkPasswordMatch();">
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

    function validateForm() {
        var firstName = document.getElementsByName("first_name")[0].value;
        var middleName = document.getElementsByName("middle_name")[0].value;
        var lastName = document.getElementsByName("last_name")[0].value;
        var email = document.getElementsByName("email")[0].value;

        var isValid = true;

        if (!/^[A-Za-z\s]+$/.test(firstName)) {
            document.getElementById("firstNameError").innerHTML = "Please enter a valid first name (no numbers)";
            isValid = false;
        } else {
            document.getElementById("firstNameError").innerHTML = "";
        }

        if (middleName !== "" && !/^[A-Za-z\s]+$/.test(middleName)) {
            document.getElementById("middleNameError").innerHTML = "Please enter a valid middle name (no numbers)";
            isValid = false;
        } else {
            document.getElementById("middleNameError").innerHTML = "";
        }

        if (!/^[A-Za-z\s]+$/.test(lastName)) {
            document.getElementById("lastNameError").innerHTML = "Please enter a valid last name (no numbers)";
            isValid = false;
        } else {
            document.getElementById("lastNameError").innerHTML = "";
        }

        if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
           document.getElementById("emailError").innerHTML = "Please enter a valid email address";
           isValid = false;
        } else {
            document.getElementById("emailError").innerHTML = "";
}

        return isValid;
    }
</script>
