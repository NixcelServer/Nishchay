<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Nixcel -HR DashBoard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='/assets/img/favicon.ico' />
 
    <!-- Include Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 
   
</head>
 
@extends('frontend_home.leftmenu')
<style>
  .submit-button {
      margin-bottom: 50px; /* Adjust the margin as needed */
  }
  .table thead th {
        background-color: #000000; /* Add your desired color code */
        color: #000000; /* Text color for better contrast */
    }
 
  .table {
        background-color: #bcdafd; /* Background color for the table */
    }

    .custom-height {
    height: 80px; /* You can adjust the height value as needed */
}
</style>
<body>
      <!-- Main Content -->
      <div class="main-content">
       <section class="section">
        <div class="section-body">
          <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                <div class="card-header">
                  <h4></h4>
                </div>
                <div class="card-body">
                  <form id="wizard_with_validation" action="/Tasks/assigntask" method="POST">
                      @csrf

                    <h3>Create New Task</h3>
                    
                        <div class="form-group form-float">
                            <div class="form-line">
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <label class="form-label">Task Description</label>
                                        <input type="text" class="form-control custom-height" name="task_description" value="">
                                    </div>
                                    <div class="form-group">
                    <label for="assigned_to">Assign To</label>
                    <select class="form-control" id="assigned_to" name="assigned_to">
                        <option value="">Select Employee</option> <!-- Blank option -->
                        @foreach($empsWithModulesAndNames as $item)
                            <option value="{{ $item['enc_user_id'] }}">{{ $item['user_name'] }}</option>
                        @endforeach
                    </select>
                </div>

                                </div>
                            </div>
                        </div>
                   
                        <div class="form-group form-float">
                            <div class="form-line">
                                <div class="row">
                                  <div class="col-md-6">
                                      <label class="form-label">Expected Delivery Date</label>
                                      <input type="date" class="form-control" name="expected_delivery_date" value="">
                                  </div>
                                  

                                 
                                </div>
                            </div>
                        </div>
                   
                        <button type="submit" class="btn btn-primary submit-button" >Submit</button>
                   

                        <!-- <table class="table">
                            <thead>
                                <tr>
                                    <th>Task ID</th>
                                    <th>Task Desccription</th>
                                    <th>Task Assign To</th>
                                    <th>Expected Delivery Date</th>
                                    <th>Completed Delivery Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table> -->
                                        
                   
                   
                    <!-- Include jQuery and jQuery UI libraries here -->
                       
                    <script>
                      // jQuery Datepicker initialization
                      $(document).ready(function(){
                          $('.datepicker').datepicker({
                              format: 'yyyy-mm-dd',
                              autoclose: true
                          });
                      });
                  </script>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
 
      </div>
 
    

 
</body>
</html>


