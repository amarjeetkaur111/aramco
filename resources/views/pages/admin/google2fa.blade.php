<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
      <title>Saudi Aramco</title>
      <meta name="description" content="" />
      <!-- Favicon -->
      <link rel="icon" type="image/x-icon" href="../assets/img/aramco2.jpg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css')}}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" /> 
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/js/helpers.js')}}" />

    <link rel="stylesheet" href="{{ asset('assets/js/config.js')}}" />
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card card-default">
                    <h4 class="card-heading text-center mt-4">Set up Google Authenticator</h4>

                    <div class="card-body" style="text-align: center;">
                        <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use the code <strong>{{ $secret }}</strong></p>
                        <div>
                            {!! $QR_Image !!}
                        </div>
                        <p>You must set up your Google Authenticator app before continuing. You will be unable to login otherwise</p>
                        <div>
                            <a href="" class="btn btn-primary">Complete Registration</a>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('complete.registration') }}">
            @csrf
            <div class="form-group">
                <label for="2fa_code">Enter the code from the Google Authenticator app:</label>
                <input type="text" id="2fa_code" name="2fa_code" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Verify</button>
        </form>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>