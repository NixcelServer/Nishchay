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
                                        <input type="text" name="first_name" class="form-control" placeholder="First Name">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="col">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="col">
                                        <input type="password" class="form-control" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <select name="tbl_role_id" class="form-control" style="border: 1px solid #b1a7a7; width: 15%;">
                                            <option value="1">Admin</option>
                                            <option value="2">HR</option>
                                            <option value="3">Developer</option>
                                            <option value="4">Manager</option>
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