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
            <h4>View Tasks</h4>
          </div>
          <div class="card-body">
            <form id="task_form" method="POST">
              <div class="form-group">
                <label for="task_title">Task Title</label>
                {{-- <input type="text" class="form-control" id="task_title" name="task_title" required> --}}
              </div>
              <div class="form-group">
                <label for="assign_date">Assign Date</label>
                <input type="date" class="form-control" id="assign_date" name="assign_date">
              </div>
              <div class="form-group">
                <label for="completed_date">Completed Task Date</label>
                <input type="date" class="form-control" id="completed_date" name="completed_date">
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status">
              </div>
              <div class="form-group">
                <label for="solution">Solution</label>
                <textarea class="form-control" id="solution" name="solution" rows="3"></textarea>
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
