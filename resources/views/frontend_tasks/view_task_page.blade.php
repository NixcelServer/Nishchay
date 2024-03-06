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
            <h4>View Tasks</h4>
          </div>
          <div class="card-body">
            <form id="task_form" method="POST">
              <div class="form-group">
                <label for="task_title">Task Title</label>
                {{-- <input type="text" class="form-control" id="task_title" name="task_title" required> --}}
              </div>
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="assign_date">Assign Date</label>
                        <input type="date" class="form-control" id="assign_date" name="assign_date">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="completed_date">Completed Task Date</label>
                        <input type="date" class="form-control" id="completed_date" name="completed_date">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control small-dropdown" id="status" name="status">
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
              <label for="solution">Solution</label>
              <textarea class="form-control small-textarea" id="solution" name="solution" rows="1"></textarea>
          </div>
              <!-- Reassign Task Button -->
              <a href="/Tasks/reassigned_tasks" class="btn btn-warning" id="reassign_task_btn">Reassign Task</a>
              <!-- Submit Button -->
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
