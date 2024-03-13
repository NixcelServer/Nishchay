@extends('frontend_home.leftmenu')


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Nixcel - DashBoard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='/assets/img/favicon.ico'/>
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
          <div class="row ">
           <h3>Audit Log Details</h3>

            
              
          


          <table class="table">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Activity Name</th>
                    <th>Activity By</th>
                    <th>Activity Date</th>
                    <th>Activity Time</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($auditlogs as $index => $log)
              <tr>
                <td>{{ $index+1 }}</td>
                
                <td>{{ $log->activity_name}}</td>
                <td>{{ $log->username}}</td>
                <td>{{ $log->activity_date}}</td>
                <td>{{ $log->activity_time}}</td>
            </tr>  
            @endforeach
            </tbody>
        </table>
      </div>

      
</body>
</html>

