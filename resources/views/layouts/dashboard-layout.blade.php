<!--
=========================================================
 Material Dashboard - v2.1.1
=========================================================

 Product Page: https://www.creative-tim.com/product/material-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/material-dashboard/blob/master/LICENSE.md)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<!doctype html>
<html lang="en">

<head>
  <title>SACK 3.0</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="{{ asset('dashboard-assets/css/material-dashboard.css?v=2.1.1') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/material-kit.css?v=2.0.5') }}" rel="stylesheet" />
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon_wtw.ico') }}" rel="stylesheet" />

</head>

<style type="text/css">
  /*.link{
    border: solid 1px lightgray;
    font-style: italic;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    padding: 0px 5px;
  }*/
  .link{
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-family: "Segoe UI";
    color: darkslategrey;
  }
  .link:hover{
    text-decoration: underline;
  }
  .not-applicable{
    border-left: solid 7px darkorange;
  }
  .item-ok{
    border-left: solid 7px #4caf50;
  }
  .item-with-comment{
      border-left: solid 7px #00bcd4;
  }
  /* width */
  ::-webkit-scrollbar {
    width: 10px;
  }

  /* Track */
  ::-webkit-scrollbar-track {
    background: #f1f1f1; 
    border-radius: 5px;
  }
  
  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 5px;
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #555;
  }
</style>

<body>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo" style="text-align: center;">
        {{-- <img src="{{ asset('dashboard-assets/img/faces/marc.jpg') }}" class="rounded-circle img-fluid img-sm" style="width: 100px"> --}}
        <a href="/dashboard" class="simple-text logo-normal">
          SACK
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{ Route::is(['dashboard.index', 'project-checklist']) ? 'active':'' }}">
            <a class="nav-link" href="/dashboard">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item {{ Route::is(['manage-project','edit-project']) ? 'active':'' }}">
            <a class="nav-link" href="/manage">
              <i class="material-icons">list</i>
              <p>Manage Projects</p>
            </a>
          </li>

          {{-- Show only to admin user --}}
          @if (Str::contains(auth()->user()->role, 'role_Admin'))
          <li class="nav-item {{ Route::is(['checklist-manager','survey-type-edit', 'survey-type-create',
          'checklist-type-edit', 'checklist-type-create', 'checklist-category-edit', 'checklist-category-create',
          'checklist-edit','checklist-create', 'jira-template-edit','jira-template-create']) ? 'active':'' }}">
            <a class="nav-link" href="/checklist-manager">
              <i class="material-icons">group_work</i>
              <p>Checklist Manager</p>
            </a>
          </li>
          @endif

          @if (Str::contains(auth()->user()->role, 'role_Admin'))
          <li class="nav-item {{ Route::is(['manage-users']) ? 'active':'' }}">
            <a href="/manage-users" class="nav-link">
              <i class="material-icons">account_circle</i>
              <p>Manage Users</p>
            </a>
          </li>
          @endif
          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent text-secondary">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            @yield('breadcrumbs')
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                <div class="ripple-container"></div></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email<div class="ripple-container"></div></a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                <div class="ripple-container"></div>{{ Auth::user()->name }}</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">Profile<div class="ripple-container"></div></a>
                  <a class="dropdown-item" href="#">Settings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
              <!-- your navbar here -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            @yield('content')
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
          <!-- your footer here -->
        </div>
      </footer>
    </div>
  </div>
</body>

<!--   Core JS Files   -->
  <script src="{{ asset('dashboard-assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('dashboard-assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('dashboard-assets/js/core/bootstrap-material-design.min.js') }}"></script>
  <script src="{{ asset('dashboard-assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!-- Plugin for the momentJs  -->
  <script src="{{ asset('dashboard-assets/js/plugins/moment.min.js') }}"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="{{ asset('dashboard-assets/js/plugins/sweetalert2.js') }}"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{ asset('dashboard-assets/js/plugins/jquery.validate.min.js') }}"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{ asset('dashboard-assets/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{ asset('dashboard-assets/js/plugins/bootstrap-selectpicker.js') }}"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{ asset('dashboard-assets/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{ asset('dashboard-assets/js/plugins/jquery.dataTables.min.js') }}"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{ asset('dashboard-assets/js/plugins/bootstrap-tagsinput.js') }}"></script>
  {{-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput --}}
  <script src="{{ asset('dashboard-assets/js/plugins/jasny-bootstrap.min.js') }}"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{ asset('dashboard-assets/js/plugins/fullcalendar.min.js') }}"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{ asset('dashboard-assets/js/plugins/jquery-jvectormap.js') }}"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ asset('dashboard-assets/js/plugins/nouislider.min.js') }}"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js') }}"></script>
  <!-- Library for adding dinamically elements -->
  <script src="{{ asset('dashboard-assets/js/plugins/arrive.min.js') }}"></script>
  <!--  Google Maps Plugin    -->
  <script src="{{ asset('https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE') }}"></script>
  <!-- Chartist JS -->
  <script src="{{ asset('dashboard-assets/js/plugins/chartist.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('dashboard-assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('dashboard-assets/js/material-dashboard.js?v=2.1.1') }}" type="text/javascript"></script>
  {{-- Custom Script --}}
  <script type="text/javascript" src="{{ asset('js/custom-script.js') }}"></script>

  <script>
    $(function(){
      // javascript for activating the Perfect Scrollbar
      $('.sidebar .sidebar-wrapper, .main-panel, .ps-child').perfectScrollbar();

    });
  </script>
</html>
