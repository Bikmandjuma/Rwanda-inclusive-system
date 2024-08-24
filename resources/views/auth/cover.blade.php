<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ config('app.name','laravel') }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ URL::to('/')}}/style/vendors/feather/feather.css">
  <link rel="stylesheet" href="{{ URL::to('/')}}/style/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{ URL::to('/')}}/style/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="{{ URL::to('/')}}/style/vendors/mdi/css/materialdesignicons.min.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ URL::to('/')}}/style/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ URL::to('/')}}/style/images/logo-mini.svg" />
  <style>
    .auth-form-light{
        box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2);4
        border-radius:20px;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        
            @yield('content')
         
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- plugins:js -->
  <script src="{{ URL::to('/')}}/style/vendors/js/vendor.bundle.base.js"></script>
  <!-- inject:js -->
  <script src="{{ URL::to('/')}}/style/js/off-canvas.js"></script>
  <script src="{{ URL::to('/')}}/style/js/hoverable-collapse.js"></script>
  <script src="{{ URL::to('/')}}/style/js/template.js"></script>
  <script src="{{ URL::to('/')}}/style/js/settings.js"></script>
  <script src="{{ URL::to('/')}}/style/js/todolist.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <!-- endinject -->

</body>

</html>
