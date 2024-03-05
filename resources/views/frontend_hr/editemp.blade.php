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
                    <h4>Edit Employee Details</h4>
                  </div>
                  <div class="card-body">
                    <form id="wizard_with_validation" method="POST">



                      <h3>Basic Information <br>.</h3>
                      <fieldset>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <label class="form-label">Title</label><br>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <input type="radio" id="mr" name="title" value="Mr">
                                          <label for="mr">Mr</label>
                                          <input type="radio" id="mrs" name="title" value="Mrs">
                                          <label for="mrs">Mrs</label>
                                      </div>
                                      
                                  </div>
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label class="form-label">First Name</label>
                                          <input type="text" class="form-control" name="firstname" placeholder={{ $emp->first_name }} >
                                      </div>
                                      <div class="col-md-4">
                                          <label class="form-label">Middle Name</label>
                                          <input type="text" class="form-control" name="middlename" placeholder={{ $emp->middle_name }}>
                                      </div>
                                      <div class="col-md-4">
                                          <label class="form-label">Last Name</label>
                                          <input type="text" class="form-control" name="lastname" placeholder={{ $emp->last_name }}>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label class="form-label">Email</label>
                                          <input type="text" class="form-control" name="email" placeholder={{ $emp->email }} readonly>
                                      </div>
                                      <div class="col-md-4">
                                          <label class="form-label">Contact No</label>
                                          <input type="text" class="form-control" name="contact" >
                                      </div>
                                      <div class="col-md-4">
                                        <label class="form-label">Gender</label>
                                        <select class="form-control" name="gender" >
                                            <option value="">Male</option>
                                            <option value="">Female</option>
                                            <option value="">Other</option>
                                        </select>
                                    </div>
                                      
                                  </div>
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <label class="form-label">Date of Birth</label>
                                      <input type="date" class="form-control" name="dob">
                                  </div>
                                      <div class="col-md-4">
                                          <label class="form-label">Current Age</label>
                                          <input type="text" class="form-control" name="age" >
                                      </div>
                                      <div class="col-md-4">
                                        <label class="form-label">Country</label>
                                        <select class="form-control" id="countrySelect" name="country" >
                                            <option value="">Select Country</option>
                                        </select>
                                    </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <label class="form-label">State</label>
                                      <select class="form-control" id="stateSelect" name="state" >
                                          <option value="">Select State</option>
                                      </select>
                                  </div>
                                      <div class="col-md-4">
                                          <label class="form-label">City/Village</label>
                                          <input type="text" class="form-control" name="city" >
                                      </div>
                                      <div class="col-md-4">
                                          <label class="form-label">Pincode</label>
                                          <input type="text" class="form-control" name="pincode" >
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label class="form-label">Address</label>
                                          <input type="text" class="form-control" name="address" >
                                      </div>
                                      <div class="col-md-4">
                                          <label class="form-label">Select Department</label>
                                          <select class="form-control" name="department" >
                                              <option value="">Select Department</option>
                                              <!-- Add department options here -->
                                          </select>
                                      </div>
                                      <div class="col-md-4">
                                          <label class="form-label">Select Designation</label>
                                          <select class="form-control" name="designation" >
                                              <option value="">Select Designation</option>
                                              <!-- Add designation options here -->
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label class="form-label">Select Role</label>
                                          <select class="form-control" name="role" >
                                              <option value="">Select Role</option>
                                              <!-- Add role options here -->
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </fieldset>
                      

                      

                      
                      
                      <h3>Previous Employee <br> Details</h3>
                      <fieldset>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <label class="form-label">Company Name</label>
                                          <input type="text" class="form-control" name="companyname">
                                      </div>
                                      <div class="col-md-6">
                                          <label class="form-label">Designation</label>
                                          <input type="text" class="form-control" name="designation">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <label class="form-label">Start Date</label>
                                          <input type="date" class="form-control" name="startdate">
                                      </div>
                                      <div class="col-md-6">
                                          <label class="form-label">End Date</label>
                                          <input type="date" class="form-control" name="enddate">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      
                          <button type="submit" class="btn btn-primary submit-button" formaction="/editemp/storeprevempdetails">Submit</button>
                      
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th>Sr. No</th>
                                      <th>Company Name</th>
                                      <th>Designation</th>
                                      <th>Start Date</th>
                                      <th>End Date</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <!-- Table rows will be dynamically added -->
                              </tbody>
                          </table>
                      </fieldset>                     
                      
                      
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




                      





                        
                      
                      <h3>Official Details <br><br>.</h3>
                      <fieldset>
                        <div class="form-group form-float">
                          <div class="form-line">
                              <div class="row">
                                  <div class="col-md-4">
                                      <label class="form-label">Official Email</label>
                                      <input type="text" class="form-control" name="officialemail">
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Work Location</label>
                                      <input type="text" class="form-control" name="worklocation">
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Select Reporting Manager</label>
                                      <select class="form-control" name="selectreportingmanager">
                                          <option value="manager1">Manager 1</option>
                                          <option value="manager2">Manager 2</option>
                                          <option value="manager3">Manager 3</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      <div class="form-group form-float">
                          <div class="form-line">
                              <div class="row">
                                  <div class="col-md-4">
                                      <label class="form-label">Employment Status</label>
                                      <select class="form-control" name="employmentstatus">
                                          <option value="fulltime">Active</option>
                                          <option value="parttime">InActive</option>
                                          
                                      </select>
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Technology</label>
                                      <input type="text" class="form-control" name="technology">
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Module</label>
                                      <input type="text" class="form-control" name="module">
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      </fieldset>



















                      <h3>Statutory Compliance Details</h3>
                      <fieldset>
                        <div class="form-group form-float">
                          <div class="form-line">
                              <div class="row">
                                  <div class="col-md-4">
                                      <label class="form-label">UAN No</label>
                                      <input type="text" class="form-control" name="uan_no" >
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Old EPF No</label>
                                      <input type="text" class="form-control" name="old_epf_no" >
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Nixcel EPF No</label>
                                      <input type="text" class="form-control" name="nixcel_epf_no" >
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="form-group form-float">
                          <div class="form-line">
                              <div class="row">
                                  <div class="col-md-4">
                                      <label class="form-label">Nixcel ESSI No</label>
                                      <input type="text" class="form-control" name="nixcel_essi_no" >
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Nominee Name</label>
                                      <input type="text" class="form-control" name="nominee_name" >
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Relation With Nominee</label>
                                      <input type="text" class="form-control" name="relation_with_nominee" >
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      </fieldset>














                      <h3>Bank Details<br><br>.</h3>
                      <fieldset>
                        <div class="form-group form-float">
                          <div class="form-line">
                              <div class="row">
                                  <div class="col-md-4">
                                      <label class="form-label">Adhaar No</label>
                                      <input type="text" class="form-control" name="adhaarno" >
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Pancard No</label>
                                      <input type="text" class="form-control" name="pancardno" >
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Bank Name</label>
                                      <input type="text" class="form-control" name="bankname" >
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="form-group form-float">
                          <div class="form-line">
                              <div class="row">
                                  <div class="col-md-4">
                                      <label class="form-label">Branch Name</label>
                                      <input type="text" class="form-control" name="branchname" >
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">City</label>
                                      <input type="text" class="form-control" name="city" >
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">IFSC Code</label>
                                      <input type="text" class="form-control" name="ifsccode" >
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="form-group form-float">
                          <div class="form-line">
                              <div class="row">
                                  <div class="col-md-4">
                                      <label class="form-label">Account No</label>
                                      <input type="text" class="form-control" name="accountno" >
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      </fieldset>


















                      <h3>Salary Details<br><br>.</h3>
                      <fieldset>
                        <div class="form-group form-float">
                          <div class="form-line">
                              <div class="row">
                                  <div class="col-md-4">
                                      <label class="form-label">Actual Gross</label>
                                      <input type="text" class="form-control" name="actual_gross">
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Basic</label>
                                      <input type="text" class="form-control" name="basic">
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">HRA</label>
                                      <input type="text" class="form-control" name="hra">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <label class="form-label">Medical</label>
                                      <input type="text" class="form-control" name="medical">
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Special Allowance</label>
                                      <input type="text" class="form-control" name="special_allowance">
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Statutory Bonus</label>
                                      <input type="text" class="form-control" name="statutory_bonus">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <label class="form-label">Payable Gross</label>
                                      <input type="text" class="form-control" name="payable_gross">
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">PF</label>
                                      <input type="text" class="form-control" name="pf">
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">TDS</label>
                                      <input type="text" class="form-control" name="tds">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <label class="form-label">PT</label>
                                      <input type="text" class="form-control" name="pt">
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">Net Salary</label>
                                      <input type="text" class="form-control" name="net_salary">
                                  </div>
                                  <div class="col-md-4">
                                      <label class="form-label">CTC</label>
                                      <input type="text" class="form-control" name="ctc">
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      </fieldset>




                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        

        

      </div>

      <script>
        // Fetch country data from the REST Countries API
        fetch('https://restcountries.com/v3.1/all')
            .then(response => response.json())
            .then(data => {
                const countrySelect = document.getElementById('countrySelect');
    
                // Iterate over the data and create an option for each country
                data.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.name.common;
                    option.textContent = country.name.common;
                    countrySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching country data:', error));
    </script>


<script>
  const states = [
      { "state_id": 1, "state_name": "Andaman and Nicobar Islands" },
      { "state_id": 2, "state_name": "Andhra Pradesh" },
      { "state_id": 3, "state_name": "Arunachal Pradesh" },
      { "state_id": 4, "state_name": "Assam" },
      { "state_id": 5, "state_name": "Bihar" },
      { "state_id": 6, "state_name": "Chandigarh" },
      { "state_id": 7, "state_name": "Chhattisgarh" },
      { "state_id": 8, "state_name": "Dadra and Nagar Haveli" },
      { "state_id": 37, "state_name": "Daman and Diu" },
      { "state_id": 9, "state_name": "Delhi" },
      { "state_id": 10, "state_name": "Goa" },
      { "state_id": 11, "state_name": "Gujarat" },
      { "state_id": 12, "state_name": "Haryana" },
      { "state_id": 13, "state_name": "Himachal Pradesh" },
      { "state_id": 14, "state_name": "Jammu and Kashmir" },
      { "state_id": 15, "state_name": "Jharkhand" },
      { "state_id": 16, "state_name": "Karnataka" },
      { "state_id": 17, "state_name": "Kerala" },
      { "state_id": 18, "state_name": "Ladakh" },
      { "state_id": 19, "state_name": "Lakshadweep" },
      { "state_id": 20, "state_name": "Madhya Pradesh" },
      { "state_id": 21, "state_name": "Maharashtra" },
      { "state_id": 22, "state_name": "Manipur" },
      { "state_id": 23, "state_name": "Meghalaya" },
      { "state_id": 24, "state_name": "Mizoram" },
      { "state_id": 25, "state_name": "Nagaland" },
      { "state_id": 26, "state_name": "Odisha" },
      { "state_id": 27, "state_name": "Puducherry" },
      { "state_id": 28, "state_name": "Punjab" },
      { "state_id": 29, "state_name": "Rajasthan" },
      { "state_id": 30, "state_name": "Sikkim" },
      { "state_id": 31, "state_name": "Tamil Nadu" },
      { "state_id": 32, "state_name": "Telangana" },
      { "state_id": 33, "state_name": "Tripura" },
      { "state_id": 34, "state_name": "Uttar Pradesh" },
      { "state_id": 35, "state_name": "Uttarakhand" },
      { "state_id": 36, "state_name": "West Bengal" }
  ];

  const stateSelect = document.getElementById('stateSelect');

  states.forEach(state => {
      const option = document.createElement('option');
      option.value = state.state_id;
      option.textContent = state.state_name;
      stateSelect.appendChild(option);
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  // Wait for the document to be fully loaded
  document.addEventListener('DOMContentLoaded', function() {
      // Initialize Flatpickr datepicker
      flatpickr("#dob", {
          dateFormat: 'Y-m-d', // Set the date format as needed
          maxDate: 'today', // Restrict selection to dates before or equal to today
          defaultDate: 'today', // Set default selection to today's date
          onChange: function(selectedDates, dateStr, instance) {
              // You can add additional logic here if needed
          }
      });
  });
</script>

</body>
</html>