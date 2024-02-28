<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Nixcel - HR DashBoard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='/assets/img/favicon.ico' />
</head>

@extends('frontend_home.leftmenu')

<body>
  
<!-- Main Content -->
<div class="main-content">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="card-header">
                <h4>New Employee Registration</h4>
              </div>
              <div class="card-body">
                <form id="wizard_with_validation" method="POST">
                  <h3>Basic Information</h3>
                  <fieldset>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <label class="form-label">Username*</label>
                        <input type="text" class="form-control" name="username" required>
                      </div>
                    </div>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <label class="form-label">Password*</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                      </div>
                    </div>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <label class="form-label">Confirm Password*</label>
                        <input type="password" class="form-control" name="confirm" required>
                      </div>
                    </div>
                  </fieldset>
                  <h3>Previous EMP Details</h3>
                  <fieldset>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <label class="form-label">First Name*</label>
                        <input type="text" name="name" class="form-control" required>
                      </div>
                    </div>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <label class="form-label">Last Name*</label>
                        <input type="text" name="surname" class="form-control" required>
                      </div>
                    </div>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <label class="form-label">Email*</label>
                        <input type="email" name="email" class="form-control" required>
                      </div>
                    </div>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <label class="form-label">Address*</label>
                        <textarea name="address" cols="30" rows="3" class="form-control no-resize"
                          required></textarea>
                      </div>
                    </div>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <label class="form-label">Age*</label>
                        <input min="18" type="number" name="age" class="form-control" required>
                      </div>
                      <div class="help-info">The warning step will show up if age is less than 18</div>
                    </div>
                  </fieldset>
                  <h3>Additional Details</h3>
                  <fieldset>
                    <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                    <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>
</html>