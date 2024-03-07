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
            <form id="task_form"  action="/Tasks/reassigntask" method="POST" >
              @csrf
              <div class="form-group">
                
              <input type="hidden" name="enc_task_id" value="{{ $enc_task_id }}">
                <label for="task_title">Task Title</label>
                <input type="text" class="form-control" id="task_title" name="task_title" value="{{ $task->task_description }}" readonly>

              </div>
              <div class="form-group">
                <label for="assign_date">Task Assigned To</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $task->assigned_name}}" readonly>
              </div>
              <div class="form-group">
                <label for="assign_date">Assigned Date</label>
                <input type="date" class="form-control" id="assign_date" name="assign_date" value="{{ $task->add_date}}" readonly>
              </div>
              <div class="form-group">
                <label for="completed_date">Expected Delivery Date</label>
                <input type="date" class="form-control" id="expected_delivery_date" name="expected_delivery_date" value="{{ $task->task_delivery_date }}" >
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $task->task_status}}">
              </div>
              <div class="form-group">
                
                <label for="remark">Remark</label>
                <input type="text" class="form-control" id="remark" name="remark" value="{{ $task->remark }}" readonly>

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

              <button type="submit" class="btn btn-primary">Reassign</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Add your script files here -->
</body>

</html>
