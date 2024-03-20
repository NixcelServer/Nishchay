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
  <link rel='shortcut icon' type='image/x-icon' href='/assets/img/favicon.ico'/>
</head>

<style>
    
    .table thead th {
          background-color: white; /* Add your desired color code */
          color: white; /* Text color for better contrast */
      }
  
    .table {
          background-color: white; /* Background color for the table */
      }
  </style>

<body>
      <!-- Main Content -->
      <div class="main-content">
          <div class="row ">
            @if(isset($reassignTask))
                        @if ($reassignTask)
                        
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                        
                            <!-- Display button for Manager -->
                            <h5 class="font-15"><a href="/Tasks/showreassignedtask" class="manager-button-link" style="color: black;">Task Approval<br><br><br> {{ $reassigntaskCount }}</a></h5>
                        
                            <!-- Display button for non-Manager roles -->
                           
                        
                            <h2 class="mb-3 font-18"></h2>
                          {{-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> --}}
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="/assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif    
            @endif

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                        <h5 class="font-15"><a href="/Tasks" class="pending-tasks-link" style="color: black;">Pending Tasks <br><br><br>{{ $pendingtaskCount }}</a></h5>                            {{-- <h2 class="mb-3 font-18">1,287</h2>
                          <p class="mb-0"><span class="col-orange">09%</span> Decrease</p> --}}
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="/assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                            <h5 class="font-15"><a href="/Tasks/myinprogresstasks" class="in-progress-tasks-link" style="color: black;">In Progress Task <br><br>{{ $inprogresstaskCount }}</a></h5>

                          
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="/assets/img/banner/3.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                            <h5 class="font-15"><a href="/Tasks/mycompletedtasks" class="completed-tasks-link" style="color: black;">Completed Tasks <br><br> {{ $completedtaskCount }} </a></h5>
                            
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="/assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            
            @if(isset($createNewTask))
            @if($createNewTask)
            <div class="col-12 text-left mt-n1">
              <div class="buttons">
                  <!-- Button with href link to show Add Task Modal -->
                  <a href="/Tasks/createtask" class="btn btn-primary">Create New Task</a>
              </div>
          </div>
          @endif
          @endif
            
          </div>
        </br>
          @if(isset($title))
              <h4>{{ $title }} </h4>
          @else
              <h4>Pending Tasks  </h4>
          @endif
              
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                <thead>
                  <tr>
                    <th>Sr. No</th>
                    <th>Description</th>
                    <th>{{ $columnName }}</th>
                    <th>Date</th>
                    <th>View</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
                  <!-- Table rows will be dynamically added -->
                  @foreach($tasks as $index => $task)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $task->task_description }}</td>
                    <td>{{ $task->assigned_name }}</td>
                    <td>{{ $task->add_date }}</td>
                    @if (isset($reassign) && $reassign == "apply")
                    <td><a href="/Tasks/viewreassigntask/{{ $task->enc_task_id }}">Reassign</a></td>
                    @else
                    <td><a href="/Tasks/viewmytask/{{ $task->enc_task_id }}"> <i class="fas fa-eye"></i> View</a></td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
                             
                
            </div>
        </div>
      </div>

      
</body>
</html>

