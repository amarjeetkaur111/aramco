
<!doctype html>
<html lang="en" data-assets-path="../assets/">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/web/images/favicon.jpg') }}" />    
    <link href="{{asset('assets/web/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/web/css/aramco-base.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/web/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/web/plugins/select2/css/select2-bootstrap-5-theme.css')}}" rel="stylesheet" />
</head>
<body>
<div class="membership block">
  <video class="lazy-video-landscape lazy" data-src="{{asset('assets/web/images/aramco-intro.mp4')}}" loop="" autoplay="" playsinline="" muted="">
    <source type="video/mp4" data-src="{{asset('assets/web/images/aramco-intro.mp4')}}" >
  </video>
  
  <div class="membership__content scrollable">
    <a href="{{route('index')}}">
        <div class="membership-header">
        <button type="button" class="membership-close">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L17.7071 16.2929C18.0976 16.6834 18.0976 17.3166 17.7071 17.7071C17.3166 18.0976 16.6834 18.0976 16.2929 17.7071L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="#00A3E0"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7071 0.292893C18.0976 0.683417 18.0976 1.31658 17.7071 1.70711L1.70711 17.7071C1.31658 18.0976 0.683417 18.0976 0.292893 17.7071C-0.0976311 17.3166 -0.0976311 16.6834 0.292893 16.2929L16.2929 0.292893C16.6834 -0.0976311 17.3166 -0.0976311 17.7071 0.292893Z" fill="#00A3E0"/>
            </svg>
            <span>close</span></button>
            @if(\Illuminate\Support\Facades\Session::has('msg'))
                <div class="alert alert-{{ \Illuminate\Support\Facades\Session::has('class') ? \Illuminate\Support\Facades\Session::get('class') : 'default' }} alert-dismissible" role="alert">
                    {{ \Illuminate\Support\Facades\Session::get('msg') }}
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                </div>
            @endif
        </div>
    </a>
   
    <div class="membership-body flex-grow-1">
      <div id="r1" class='@if($section == "2" || $section == "3") d-none @endif'>
        <h2 class="membership-header__title">Register / Login</h2>
        <a href="{{ url('auth/google') }}">
            <div class="membership_content_container animate-fade show"  id="r1">
                <button type="button" class="btn continue-google">
                <img src="{{asset('assets/web/images/google.svg')}}" class="img-fluid" />
                <span>Continue with Google</span></button>
            </div>
        </a>
     </div>
     
     <div class="membership_whitesmall_container show @if($section == '1' || $section == '3') d-none @endif" id="r4">
        <div class="google_authenticator mb-3">
          <img src="{{asset('assets/web/images/google_authenticator_icon.svg')}}" class="img-fluid" />
        </div>
        <p class="mb-5">Please enter the 6-digit code from authenticator app</p>
        <form class="m-0" method="POST" id='validateForm2' action="{{ route('complete.registration') }}">
        @csrf
          <div class="mb-4">
            <input type="text" id="2fa_code2" name="2fa_code" class="form-control w-100" placeholder="Enter 6-Digit Code">
            <span style="color:red" id="errormessage2"></span>
          </div>
          <button type="submit" class="btn btn-primary w-100">Approve</button>
        </form>
        <div class="w-100 text-center pt-5 show" >
          <a class="text-decoration-underline" href="{{route('qna',['first_timer' => 'recover'])}}">Secret code missing? Recover it</a>
        </div>  
      </div> 

      <div class="membership_whitesmall_container show @if($section == '1' || $section == '2') d-none @endif" id="r3" >
        <div class="google_authenticator mb-4">
        <!-- <img src="{{asset('assets/web/images/google_authenticator_icon.svg')}}" class="img-fluid" /> -->
        {!! $QR_Image  ?? '' !!}
        </div>
        <p class="mb-4">Please scan the QR or copy this secret code and enter it in Google authenticator app</p>
        <p class="w-100 d-flex align-items-center justify-content-center gap-3 text-grey mb-5 fs-5">
          <img src="{{asset('assets/web/images/warning.svg')}}" />
          <span>Do not share this code and care of loosing it</span>
        </p>
        <form class="m-0" method="POST" id='validateForm' action="{{ route('complete.registration') }}" >
        @csrf      
            <p class="text-grey mb-2">Secret Key</p>
            <p class="secret-key mb-5 text-break">{{ $secret ?? ''}}</p>              
            <div class="mb-4">
                <input type="text" id="2fa_code" name="2fa_code" class="form-control w-100" placeholder="Enter 6-Digit Code">
                <span style="color:red" id="errormessage"></span>
            </div>
            <button type="submit" class="btn btn-primary w-100 enterKeyBtn" >Approve</button>
        </form>
      </div>

              
    </div>    
  </div>
</div>

<script src="{{asset('assets/web/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('assets/web/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/web/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/web/js/aramco.js')}}"></script>
<script src="{{asset('assets/web/js/parsley.min.js')}}"></script>

<script>
    function openPopup(url, title, width, height) {
        const left = (window.innerWidth - width) / 2;
        const top = (window.innerHeight - height) / 2;
        const options = `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=${width}, height=${height}, top=${top}, left=${left}`;
        window.open(url, title, options);
    }

    $('#validateForm').on('submit', function () {
        if($('#2fa_code').val() == ""){
            $('#errormessage').html("Please provide code from authentucator");
            return false;
        } else {
            $('#errormessage').html("");
            return true;
        }
    });
    $('#validateForm2').on('submit', function () {
        if($('#2fa_code2').val() == ""){
            $('#errormessage2').html("Please provide code from authentucator");
            return false;
        } else {
            $('#errormessage2').html("");
            return true;
        }
    });

    $("document").ready(function(){
        setTimeout(function(){
            $(".alert").remove();
        }, 2000 );
    });
</script>

</body>
</html>