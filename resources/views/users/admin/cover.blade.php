<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Rwanda inclusive system</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{URL::to('/')}}/style/vendors/feather/feather.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/style/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/style/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{URL::to('/')}}/style/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/style/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/style/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{URL::to('/')}}/style/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{URL::to('/')}}/style/images/logo-mini.svg" />
  <link rel="stylesheet" href="{{URL::to('/')}}/style/vendors/mdi/css/materialdesignicons.min.css">
  <style>
    .icons i{
      margin-top:5px;
    }

    webkit::-scrollbar{
     overflow: hidden; 
    }
  </style>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="#"><img src="{{URL::to('/')}}/style/images/logo.png" class="mr-2" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>&nbsp;&nbsp;&nbsp;
        <ul class="navbar-nav mr-lg-2">
          <li><h3 class="mt-2">Admin panel</h3></li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i>{{ Auth::guard('admin')->user()->firstname}}</i>
            </a>
          </li>

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{URL::to('/')}}/style/images/admin/{{auth()->guard('admin')->user()->image}}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{ route('get_info') }}">
                <i class="ti-user text-primary"></i>
                My info
              </a>
              <a class="dropdown-item" href="{{ route('get_profile') }}">
                <i class="mdi mdi-file-image text-primary"></i>
                Profile
              </a>
              <a class="dropdown-item" href="{{ route('get_password') }}">
                <i class="ti-key text-primary"></i>
                Password
              </a>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalLogout">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
         
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>

    <!--start of Logout modal -->
          <div class="modal" id="ModalLogout" tabindex="-1" role="dialog" aria-hidden="true"  style="margin-top:45px;">
            <div class="modal-dialog modal-sm text-center">
              <div class="modal-content">
                <div class="modal-body">
                  <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><!--span aria-hidden="true">×</span--></button>
                  <h4>Logout system&nbsp;<i class="mdi mdi-lock" id="logout_sys_icon"></i></h4>
                </div>
                <div class="modal-body" style="margin-top:-20px;">
                  <p><!--i class="fa fa-question-circle" id="logout_msg_icon"></i--> Are you sure , you want to log-off ? <br /></p>
                  <div class="actionsBtns">
                      <input type="hidden" name="${_csrf.parameterName}" value="${_csrf.token}"/>
                      <a href="{{ route('logout') }}" class="btn btn-primary" id="log_btn_a"><i class="fas fa-check" id="logout_icon_btn"></i> Yes</a>&nbsp;&nbsp;&nbsp;
                      <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Not now</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
    <!--end of logout modal-->

    <!--end of logout modal-->
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#content" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-format-list-bulleted" style='font-size:20px;'></i>&nbsp;
              <span class="menu-title">Manage Content</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="content">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('create-content') }}">Add content</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('view-content') }}">View content</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#exam" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-file-document-box" style='font-size:20px;'></i>&nbsp;
              <span class="menu-title">Manage courses</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="exam">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('create-course') }}">course</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#student" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-account-multiple" style='font-size:20px;'></i>&nbsp;
              <span class="menu-title">Manage Student</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="student">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="">Students</a></li>
                <li class="nav-item"> <a class="nav-link" href="">View report</a></li>
              </ul>
            </div>
          </li>
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer text-center">
          <div class="text-center">
            <span class="text-muted text-center">Copyright &copy; 2024 All rights reserved.</span>
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script>
    var current_year=document.getElementById("current_year");
    current_year.date(new getYear);
  </script>
  <!-- plugins:js -->
  <script src="{{URL::to('/')}}/style/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{URL::to('/')}}/style/vendors/chart.js/Chart.min.js"></script>
  <script src="{{URL::to('/')}}/style/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="{{URL::to('/')}}/style/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="{{URL::to('/')}}/style/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{URL::to('/')}}/style/js/off-canvas.js"></script>
  <script src="{{URL::to('/')}}/style/js/hoverable-collapse.js"></script>
  <script src="{{URL::to('/')}}/style/js/template.js"></script>
  <script src="{{URL::to('/')}}/style/js/settings.js"></script>
  <script src="{{URL::to('/')}}/style/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{URL::to('/')}}/style/js/dashboard.js"></script>
  <script src="{{URL::to('/')}}/style/js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

