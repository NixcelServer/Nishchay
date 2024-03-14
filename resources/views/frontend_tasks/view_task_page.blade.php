@extends('frontend_home.leftmenu')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Task Form</title>
  <style>
    .small-dropdown {
        width: 150px; /* Adjust the width value as needed */
    }

    .small-textarea {
    height: 50px; /* Adjust the height value as needed */
}
</style>
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
                <label for="assign_date">Task Assigned To</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $task->assigned_name}}" readonly>
              </div>
              <div class="form-group">
                <label for="assign_date">Assigned Date</label>
                <input type="date" class="form-control" id="assign_date" name="assign_date" value="{{ $task->add_date}}" readonly>
              </div>
              <div class="form-group">
                <label for="completed_date">Expected Delivery Date</label>
                <input type="date" class="form-control" id="completed_date" name="completed_date" value="{{ $task->task_delivery_date }}" readonly>
              </div>
              @if($completedDate)
              <div class="form-group">
                <label for="completed_date">Task Completed On</label>
                <input type="date" class="form-control" id="completed_date" name="completed_date" value="{{ $task->task_completion_date }}" readonly>
              </div>
              @endif
              <div class="form-group">

    <label for="status">Status</label>
    <select class="form-control" id="status" name="status"{{ $createNewTask ? ($task->task_status == 'Completed' ? '' : ' disabled') : '' }}>
        <option value="">Select Status</option> <!-- Default option -->
        <option value="Pending" {{ $task->task_status == 'Pending' ? 'selected' : '' }}>Pending</option>
        <option value="In Progress" {{ $task->task_status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
        <option value="Completed" {{ $task->task_status == 'Completed' ? 'selected' : '' }}>Completed</option>
    </select>
</div>            

              @if ($task->task_status !== 'Completed')
                @if(isset($actionOnTask) && $actionOnTask)
              <div class="form-group">
                <label for="action">Action</label>
                <textarea class="form-control" id="action" name="action" rows="3" required></textarea>
              </div>
                @endif
              @endif  

              @if ($task->task_status !== 'Completed')
                  @if (isset($reassignTask) && $reassignTask)
                      <!-- Reassign Task Button -->
                      <a href="/Tasks/transfermytask/{{ $enc_task_id }}" class="btn btn-warning" id="reassign_task_btn">Reassign Task</a>
                  @endif
              @endif

              @if ($task->task_status == 'Pending')
                  @if (isset($deleteTask) && $deleteTask)
                      <!-- Delete Task Button -->
                      <a href="/Tasks/deletetask/{{ $enc_task_id }}" class="btn btn-danger" id="delete_task_btn">Delete Task</a>
                      @endif
              @endif


              @if($submitButton)
              <button type="submit" class="btn btn-primary">Submit</button>
              @else
              <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
  
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
document.getElementById('delete_task_btn').addEventListener('click', function(event) {
    event.preventDefault();
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this task!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = event.target.getAttribute('href');
        } else {
            swal("Your task is safe!", {
                icon: "info",
            });
        }
    });
});
</script>
  <!-- Add your script files here -->

  <table class="table">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Action</th>
                    <th>Action Taken By</th>
                    <th>Date</th>
                    
                </tr>
            </thead>
            <tbody>
            @foreach ($action_details as $index => $action)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $action->action_name }}</td>
                <td>{{ $action->user_name }}</td>
                <td>{{ $action->action_date }}</td>
            </tr>
           @endforeach
            </tbody>
        </table>
        </div>
</body>

</html>
 