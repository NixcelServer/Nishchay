@if(Session::has('user'))
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Nixcel - Employee Management System</title>
  <!-- Preload Critical CSS -->
  <link rel="preload" href="/assets/css/app.min.css" as="style">
  <link rel="preload" href="/assets/css/style.css" as="style">
  <link rel="preload" href="/assets/css/components.css" as="style">
  <link rel="preload" href="/assets/css/custom.css" as="style">
   <!-- Preload Critical JS -->
   <link rel="preload" href="/assets/js/app.min.js" as="script">
   <link rel="preload" href="/assets/js/scripts.js" as="script">
   <link rel="preload" href="/assets/js/custom.js" as="script">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='/assets/img/favicon.ico' />
</head>

@extends('frontend_home.leftmenu')

<body>
  
      <!-- Main Content -->
      <div class="main-content">
          <div class="row ">
                  @if(isset($usersCount))
                  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                      <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                          <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                              <div class="card-content">
                                <h5 class="font-15">Users</h5>
                                <h2 class="mb-3 font-18">{{ $usersCount }}</h2>
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
            @if(isset($deptsCount))
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">

                          <h5 class="font-15"> Departments</h5>
                          <h2 class="mb-3 font-18">{{ $deptsCount }}</h2>
                          

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
            @endif
            @if(isset($desgCount))
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">

                          <h5 class="font-15">Designations</h5>
                          <h2 class="mb-3 font-18">{{ $desgCount }}</h2>
                      

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
            @endif
            @if(isset($roleCount))
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">

                          <h5 class="font-15">Roles</h5>
                          <h2 class="mb-3 font-18">{{ $roleCount }}</h2>

                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="/assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
      @endif
      @if(isset($empCount))
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">

                          <h5 class="font-15">Employees</h5>
                          <h2 class="mb-3 font-18">{{ $empCount }}</h2>

                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="/assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         
      
      @endif
      @if(isset($taskCount))
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Tasks</h5>
                          <h2 class="mb-3 font-18">{{ $taskCount }}</h2>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="/assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         
      @endif
      </div>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          <a>Copy Rights @ <span style="color: black;">Nixcel Software Solution 2024</span></a>

        </div>
        <div class="footer-right">
          <a href="https://www.bing.com/ck/a?!&&p=d0ceae804a048b5dJmltdHM9MTcxMDcyMDAwMCZpZ3VpZD0xMmQ4ZDY0OC05ZWJkLTZlZDAtMzc5Zi1jMjc1OWYwZjZmYzImaW5zaWQ9NTIxOA&ptn=3&ver=2&hsh=3&fclid=12d8d648-9ebd-6ed0-379f-c2759f0f6fc2&psq=standard+company+website+privacy+policy+.+term+%26+conditions+government+of+india&u=a1aHR0cHM6Ly9kYXJwZy5nb3YuaW4vc2l0ZXMvZGVmYXVsdC9maWxlcy9naWd3LW1hbnVhbF9SZXZpc2VkMjAxOC5wZGY&ntb=1"><span style="color: black;">Privacy Policy . Term & Conditions</span></a>
        </div>
      </footer>
</body>
</html>
@else
<script>window.location = "/";</script>
@endif