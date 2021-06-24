

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('login/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('login/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/toastr.css')}}">
    <title>SAW</title>
  </head>
  <style>
      body {
          font-weight: 400;
          font-family: 'Poppins', sans-serif;
          background-color: #f8fafb;
      }
      h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
          font-family: 'Poppins', sans-serif;
      }
  </style>
  <body>



  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="{{ asset('login/images/undraw_file_sync_ot38.svg') }}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Hai, Silahkan <strong>Login</strong></h3>
              <p class="mb-4">Sistem Pendukung Keputusan metode SAW</p>
            </div>
            <form method="POST" action="{{ route('login_validation') }}">
              <div class="form-group first">
                <label for="username">Nama User</label>
                <input type="text" class="form-control" id="username"   name="username" value="{{request()->input('username')}}" required>

              </div>
              <div class="form-group last mb-4">
                <label for="password">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" required>

              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Ingatkan saya</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <!-- <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>  -->
              </div>

              <input type="submit" value="Log In" class="btn text-white btn-block btn-primary">

              <!-- <span class="d-block text-left my-4 text-muted"> or sign in with</span>

              <div class="social-login">
                <a href="#" class="facebook">
                  <span class="icon-facebook mr-3"></span>
                </a>
                <a href="#" class="twitter">
                  <span class="icon-twitter mr-3"></span>
                </a>
                <a href="#" class="google">
                  <span class="icon-google mr-3"></span>
                </a>
              </div> -->
            </form>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>


    <script src="{{ asset('login/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('login/js/popper.min.js') }}"></script>
    <script src="{{ asset('login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login/js/main.js') }}"></script>
    <script src="{{ asset('node_modules/vendors/toastr/toastr.min.js')}}"></script>
  </body>
  <script >


      var baseUrl = {!! json_encode(url('/')) !!}

          @if(Session::has('message'))
      var type = "{{ Session::get('alert-type', 'info') }}";
      switch (type) {
          case 'info':
              toastr.info("{{ Session::get('message') }}","Info");
              break;

          case 'warning':
              toastr.warning("{{ Session::get('message') }}","Info");
              break;

          case 'success':
              toastr.success("{{ Session::get('message') }}","Info");
              break;

          case 'error':
              toastr.error("{{ Session::get('message') }}","Info");
              break;
      }
      @endif

  </script>
</html>
