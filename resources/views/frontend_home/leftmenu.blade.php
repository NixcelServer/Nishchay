<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Nixcel - LeftMenu Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='/assets/img/favicon.ico' />
</head>
<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li>
              <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a>
            </li>
            <li>
              <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="/assets/img/user.png" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello Admin</div>
              <div class="dropdown-divider"></div>
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item has-icon text-danger">
                  <i class="fas fa-sign-out-alt"></i>
                  Logout
                </button>
              </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="dashboard"> <img alt="image" src="/assets/img/logo.png" class="header-logo" /> <span class="logo-name"></span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
              <a href="dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link dropdown-toggle"><i data-feather="users"></i><span>Users</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="/admin/users">All Users</a></li>
                <!-- Add more user-related links here -->
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link dropdown-toggle"><i data-feather="users"></i><span>Departments</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="/admin/depts">All Departments</a></li>
                <!-- Add more department-related links here -->
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link dropdown-toggle"><i data-feather="users"></i><span>Designation</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="/admin/designation">All Designations</a></li>
                <!-- Add more designation-related links here -->
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link dropdown-toggle"><i data-feather="users"></i><span>Role</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="/admin/role">All Roles</a></li>
                <!-- Add more role-related links here -->
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link dropdown-toggle"><i data-feather="users"></i><span>Employees</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="/employee">All Employees</a></li>
                <!-- Add more employee-related links here -->
              </ul>
            </li>
          </ul>
        </aside>
      </div>
      <!-- General JS Scripts -->
      <script src="/assets/js/app.min.js"></script>
      <!-- JS Libraies -->
      <script src="/assets/bundles/apexcharts/apexcharts.min.js"></script>
      <!-- Page Specific JS File -->
      <script src="/assets/js/page/index.js"></script>
      <!-- Template JS File -->
      <script src="/assets/js/scripts.js"></script>
      <!-- Custom JS File -->
      <script src="/assets/js/custom.js"></script>
      <script>
        $(document).ready(function() {
          // Toggles the sidebar when collapse button is clicked
          $('.collapse-btn').on('click', function() {
            $('.main-sidebar').toggleClass('open');
          });
          // Toggles the submenu visibility
          $('.dropdown-toggle').on('click', function() {
            $(this).next('.dropdown-menu').slideToggle(300);
            $(this).parent().siblings().find('.dropdown-menu').slideUp(300);
          });
        });
      </script>
    </div>
  </div>
</body>
</html>
