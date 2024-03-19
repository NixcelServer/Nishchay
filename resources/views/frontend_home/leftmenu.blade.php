
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <!-- Add the CSRF token meta tag here -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Nixcel - Employee Management System</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='/assets/img/favicon.ico' />
<!-- datatable -->
  <link rel="stylesheet" href="/assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
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
            <a href="/dashboard"> <img alt="image" src="/assets/img/logo.png" class="header-logo" style="width: 43px; height: auto;" /> <span
                class="logo-name" style="color: rgb(52, 52, 151); style="font-family: 'Georgia', sans-serif;">Nixcel</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header" ></li>
            <li class="dropdown active" style="margin-top: 5px;">
              <a href="/dashboard" class="nav-link" style="color: black;"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>

            {{-- left menu for admin --}}
            @php 
              $user = Session::get('user');
              $uniqueParentNames = Session::get('uniqueParentNames');
              @endphp

              @if($user->tbl_role_id == 1)
              <ul class="sidebar-menu">
                <li class="menu-header"></li>
                <li class="dropdown active">
                  <a href="/admin/users" class="nav-link" style="color: black;"><i data-feather="user-check"></i><span>Users</span></a>                  
                </li>

                <li class="menu-header"></li>
                <li class="dropdown active">
                  <a href="/admin/depts"class="nav-link" style="color: black;"><i data-feather="grid"></i><span>Department</span></a>
                </li>

                <li class="menu-header"></li>
                <li class="dropdown active">
                  <a href="/admin/designations"class="nav-link" style="color: black;"><i data-feather="grid"></i><span>Designation</span></a>
                </li>

                <li class="menu-header"></li>
                <li class="dropdown active">
                  <a href="/admin/roles"class="nav-link" style="color: black;"><i data-feather="grid"></i><span>Roles</span></a>
                </li>

                <li class="menu-header"></li>
                <li class="dropdown active">
                  <a href="/admin/auditlogdetails"class="nav-link" style="color: black;"><i data-feather="command"></i><span>Log</span></a>
                </li>

                
              </ul>
              @else
              
                
                
                @foreach($uniqueParentNames as $parentName)
                <li class="menu-header"></li>
                <ul class="sidebar-menu">
                <li class="dropdown active">
                  <a href="/{{ $parentName }}"class="nav-link" style="color: black;"><i data-feather="command"></i><span>{{ $parentName }}</span></a>
                </li>
                </ul>
                @endforeach
              
              
              @endif
          </ul>




        </aside>
        {{-- <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div> --}}
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
  
{{-- --- data table js files --- --}}
<!-- JS Libraies -->
<script src="/assets/bundles/datatables/datatables.min.js"></script>
<script src="/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<!-- Page Specific JS File -->
<script src="/assets/js/page/datatables.js"></script>
</body>


</html>
