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
          background-color: white; /* Add your desired color code */
          color: #000000; /* Text color for better contrast */
      }
  
    .table {
          background-color: white; /* Background color for the table */
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
        <div class="card-footer text-right">
          <nav class="d-inline-block">
            <ul class="pagination mb-0">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
              </li>
              <li class="page-item active"><a class="page-link" href="#">1 <span
                    class="sr-only">(current)</span></a></li>
              <li class="page-item">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>

      
</body>
</html>

