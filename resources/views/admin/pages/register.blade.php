<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <link rel="stylesheet" href="{{asset('adminassets/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('adminassets/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('adminassets/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('adminassets/css/vertical-layout-light/style.css')}}">
  <link rel="shortcut icon" href="{{asset('adminassets/images/favicon.png')}}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{asset('adminassets/images/logo.svg')}}" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" method="POST" action="{{route('admin.register.submit')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input type="text" name="name" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <input type="file" name="file"  class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                </div>
                <div class="mb-4">

                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a class="text-primary" href="{{route('admin.login')}}">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('adminassets/vendors/js/vendor.bundle.base.js')}}"></script>
 <script src="{{asset('adminassets/vendors/js/vendor.bundle.base.js')}}"></script>
 <script src="{{asset('adminassets/js/off-canvas.js')}}"></script>
 <script src="{{asset('adminassets/js/hoverable-collapse.js')}}"></script>
 <script src="{{asset('adminassets/js/template.js')}}"></script>
 <script src="{{asset('adminassets/js/settings.js')}}"></script>
 <script src="{{asset('adminassets/js/todolist.js')}}"></script>
 <!-- endinject -->
</body>

</html>
