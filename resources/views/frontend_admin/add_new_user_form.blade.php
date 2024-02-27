@extends('frontend_home.leftmenu')


<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-10 col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New User Registration</h4>
                        </div>
                        <br />
                        <form action="/admin/storeuser" method="POST"> <!-- Set the action to the route of your storeUser method -->
                            @csrf <!-- CSRF protection -->
                            <div class="card-body" style="padding-top: 10px; padding-bottom: 10px;">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" class="form-control" style="border: 1px solid #b1a7a7;">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Mid Name</label>
                                            <input type="text" name="middle_name" class="form-control" style="border: 1px solid #b1a7a7;">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" class="form-control" style="border: 1px solid #b1a7a7;">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" style="border: 1px solid #b1a7a7;">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                  <div class="col-5">
                                      <div class="form-group">
                                          <label>Password</label>
                                          <input type="password" name="password" class="form-control" style="border: 1px solid #b1a7a7;">
                                      </div>
                                      <div class="form-group">
                                          <label>Confirm Password</label>
                                          <input type="password" class="form-control" style="border: 1px solid #b1a7a7;">
                                      </div>
                                  </div>
                              </div>

                                <div class="form-row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Select Role</label>
                                            <select name="tbl_role_id" class="form-control" style="border: 1px solid #b1a7a7;">
                                                <option value="1">Admin</option>
                                                <option value="2">HR</option>
                                                <option value="3">Developer</option>
                                                <option value="4">Manager</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                               


                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Submit</button> <!-- Add submit button -->
                                <button class="btn btn-secondary" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
