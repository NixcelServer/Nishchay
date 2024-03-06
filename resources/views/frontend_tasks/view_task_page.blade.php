@extends('frontend_home.leftmenu')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Task Form</title>
  <!-- Add your CSS files here -->
</head>

<body>
  <div class="main-content">
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="card-header">
            <h4>View Task</h4>
          </div>
          <div class="card-body">
            <form id="task_form"  action="/Tasks/updatemytaskstatus" method="POST" >
              @csrf
              <div class="form-group">
                
              <input type="hidden" name="enc_task_id" value="{{ $enc_task_id }}">
                <label for="task_title">Task Title</label>
                <input type="text" class="form-control" id="task_title" name="task_title" value="{{ $task->task_description }}" readonly>

              </div>
              <div class="form-group">
                <label for="assign_date">Assigned Date</label>
                <input type="date" class="form-control" id="assign_date" name="assign_date" value="{{ $task->add_date}}" readonly>
              </div>
              <div class="form-group">
                <label for="completed_date">Completion Date</label>
                <input type="date" class="form-control" id="completed_date" name="completed_date" value="{{ $task->task_delivery_date }}" readonly>
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $task->task_status}}">
              </div>
              <div class="form-group">
                <label for="solution">Solution</label>
                <textarea class="form-control" id="solution" name="solution" rows="3">{{ $task->task_solution}}</textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Add your script files here -->
</body>

</html>
