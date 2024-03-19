@extends('frontend_home.leftmenu')


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Nixcel - Employee Management System</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='/assets/img/favicon.ico' />
</head>

<style>
    
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
          <h5 style="color: black;">Pending Tasks</h5>
          <br>


          <table class="table">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Task Description</th>
                    <th>Expected Delivery Date</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                <!-- Table rows will be dynamically added -->
            </tbody>
        </table>
      </div>

      
</body>
</html>

