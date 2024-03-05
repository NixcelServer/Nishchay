<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <!-- Add the CSRF token meta tag here -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

<style>
  .menu {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  display: inline-block; /* Display list items horizontally */
}

.menu li a {
  display: block; /* Ensure the entire link area is clickable */
  padding: 10px 20px; /* Adjust padding as needed */
  text-decoration: none;
  color: #000; /* Set the text color */
}

.menu li span {
  /* Add any styling for the span if needed */
}

.menu li:first-child a {
  margin-left: 0; /* Remove left margin for the first item */
}

</style>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
              collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="/assets/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              @php
              $user = Session::get('user');
              @endphp
              <div class="dropdown-title">Hello {{ $user->first_name }}</div>
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
            <a href="dashboard"> <img alt="image" src="/assets/img/logo.png" class="header-logo" /> <span
                class="logo-name"></span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
              <a href="dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>

            {{-- left menu for admin --}}
            @php 
              $user = Session::get('user');
              $uniqueParentNames = Session::get('uniqueParentNames');
              @endphp

              @if($user->tbl_role_id == 1)
              <ul class="menu">
                <li>
                  <a href="/admin/users">Users<span class=""></span></a>
                </li>
                <li>
                  <a href="/admin/depts">Departments<span class=""></span></a>
                </li>
                <li>
                  <a href="/admin/designations">Designation<span class=""></span></a>
                </li>
                <li>
                  <a href="/admin/roles">Role<span class=""></span></a>
                </li>
              </ul>
              @else
              <ul class="menu">
                @foreach($uniqueParentNames as $parentName)
                <li>
                  <a href="/hr/employees">{{ $parentName }}<span class=""></span></a>
                </li>
                @endforeach
              </ul>
              @endif




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


  {{-- edit emp hr js files --}}
  <script src="/assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
  <!-- JS Libraies -->
  <script src="/assets/bundles/jquery-steps/jquery.steps.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="/assets/js/page/form-wizard.js"></script>
  
  
</body>


</html>