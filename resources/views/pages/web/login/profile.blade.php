@php
if($hidden_status == 'new')
{
  $img_edit = 'd-none';
  $fn_edit = 'readonly';
  $ln_edit = '';
  $email_edit = '';
  $dob_edit = '';
  $gender_edit = '';
  $country_edit = '';
  $phone_edit = '';
  $je_edit = '';
  $sm_edit = 'd-none';
}
elseif($hidden_status == 'approved')
{
  $img_edit = '';
  $fn_edit = 'readonly';
  $ln_edit = 'readonly';
  $email_edit = '';
  $dob_edit = 'style=pointer-events:none';
  $gender_edit = 'style=pointer-events:none';
  $country_edit = '';
  $phone_edit = '';
  $je_edit = '';
  $sm_edit = '';
}
elseif($hidden_status == 'rejected')
{
  $img_edit = 'd-none';
  $fn_edit = '';
  $ln_edit = '';
  $email_edit = '';
  $dob_edit = '';
  $gender_edit = '';
  $country_edit = '';
  $phone_edit = '';
  $je_edit = '';
  $sm_edit = 'd-none';
}
else
{
  $img_edit = 'd-none';
  $fn_edit = 'readonly';
  $ln_edit = 'readonly';
  $email_edit = 'readonly';
  $dob_edit = 'style=pointer-events:none';
  $gender_edit = 'style=pointer-events:none';
  $country_edit = 'style=pointer-events:none';
  $phone_edit = 'readonly';
  $je_edit = 'readonly';
  $sm_edit = 'd-none';
}


@endphp

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
<!-- Spinner -->
<div class="overlay" id="spinner" style="display:none;">
    <div class="overlay__inner">
        <div class="overlay__content"><span class="spinner"></span></div>
    </div>
</div>
<!-- <div class="modal fade profile-fullscreen-modal">
  <div class="modal-dialog modal-fullscreen ">
    <div class="modal-content bg-dark"> -->
      <div class="profileVideoBg block">
        <video class="lazy-video-landscape lazy bg-video-profile" data-src="{{asset('assets/web/images/aramco-intro.mp4')}}" loop="" autoplay="" playsinline="" muted="">
          <source type="video/mp4" data-src="{{asset('assets/web/images/aramco-intro.mp4')}}" >
        </video>

        <div class="container position-relative d-flex flex-column vh-100 " style="z-index: 9;overflow-y:auto">
          <div class="modal-header border-0">
            <h2 class="search__modal-logo text-center flex-grow-1 text-white">D&IT Lab Excellence</h2>
            <a href="{{ route('index') }}" class="btn search__modal-close-button">
                <svg xmlns="http://www.w3.org/2000/svg" focusable="false" width="31" height="31" viewBox="0 0 31 31">
                    <g fill="none" fill-rule="evenodd">
                        <g fill="#00A3E0">
                            <path d="M9.545 0H11.454V21H9.545z" transform="rotate(-45 19.036 6.964)"></path>
                            <path d="M9.545 0L11.455 0 11.455 21 9.545 21z" transform="rotate(-45 19.036 6.964) rotate(90 10.5 10.5)"></path>
                        </g>
                    </g>
                </svg>
                <span>Close</span>
              </a>
          </div>
          @if(\Illuminate\Support\Facades\Session::has('msg'))
                <div class="alert alert-{{ \Illuminate\Support\Facades\Session::has('class') ? \Illuminate\Support\Facades\Session::get('class') : 'default' }} alert-dismissible" role="alert">
                    {{ \Illuminate\Support\Facades\Session::get('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
          <div class="modal-body text-white scrollable">
              <h2 class="profile__title">Profile</h2>
              <form class="profileForm" id="myForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" enctype="multipart/form-data" method="post" action="{{route('user-postprofile')}}">
                @csrf
                <input type="hidden" value="{{session('auth_google_id')}}" name="google_id">
                <input type="hidden" value="{{$hidden_status}}" name="hidden_status">
                <div class="row gutters">
                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                  <div class="profile-circle-container">
                    <div class="profile-circle">
                      <img class="profile-pic img-fluid" src="{{ !empty($data->profile_photo) ? $data->profile_photo : asset('assets/web/images/avatar.png') }}" />
                      <div class="p-image upload-button  {{$img_edit}}">
                          <svg class="" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7631 0.718862C12.0146 0.614665 12.2842 0.561035 12.5565 0.561035C12.8288 0.561035 13.0984 0.614665 13.35 0.718862C13.6015 0.823059 13.8301 0.975783 14.0226 1.16831L14.8322 1.9779L14.3436 2.46657L14.8326 1.97823C15.0252 2.17111 15.1779 2.40007 15.2819 2.65202C15.386 2.90397 15.4393 3.17396 15.4388 3.44654C15.4384 3.71912 15.3842 3.98894 15.2794 4.24056C15.1747 4.49178 15.0216 4.71994 14.8288 4.91201C14.8285 4.91231 14.8282 4.91261 14.8279 4.91291L5.67208 14.0684C5.44456 14.296 5.16713 14.4675 4.86178 14.5692C4.8617 14.5693 4.86187 14.5692 4.86178 14.5692L1.68503 15.6286C1.68452 15.6287 1.684 15.6289 1.68348 15.6291C1.50081 15.6904 1.30466 15.6996 1.11706 15.6556C0.928911 15.6116 0.75683 15.5158 0.620237 15.3791C0.483645 15.2424 0.387983 15.0702 0.344046 14.8821C0.300265 14.6946 0.309578 14.4986 0.370918 14.3161C0.371138 14.3154 0.371358 14.3148 0.37158 14.3141L1.43017 11.1388C1.43021 11.1387 1.43026 11.1385 1.4303 11.1384C1.53228 10.8316 1.70467 10.5529 1.93369 10.3247C1.93387 10.3245 1.93406 10.3243 1.93424 10.3241L11.0904 1.16831C11.0904 1.16832 11.0904 1.16831 11.0904 1.16831C11.2829 0.975789 11.5115 0.823057 11.7631 0.718862ZM13.8545 2.95491L13.0452 2.14564C12.9811 2.08146 12.9049 2.03054 12.821 1.99581C12.7372 1.96107 12.6473 1.9432 12.5565 1.9432C12.4658 1.9432 12.3759 1.96107 12.292 1.99581C12.2082 2.03054 12.132 2.08145 12.0678 2.14562L2.91061 11.3025L2.90961 11.3035C2.8333 11.3795 2.77587 11.4723 2.74192 11.5745L1.89999 14.0999L4.42452 13.2581C4.52613 13.2242 4.61872 13.1671 4.69443 13.0913L13.8518 3.93435L13.853 3.93313C13.9174 3.86905 13.9685 3.79289 14.0035 3.70901C14.0384 3.62514 14.0565 3.5352 14.0566 3.44434C14.0568 3.35348 14.039 3.26349 14.0043 3.1795C13.9696 3.09552 13.9187 3.0192 13.8545 2.95491Z" fill="#323232"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0677 6.69674L9.30322 3.93241L10.2806 2.95508L13.045 5.7194L12.0677 6.69674Z" fill="#323232"/>
                          </svg>
                      </div>
                    </div>
                    <input class="profile-file-upload" name="profile_photo" type="file" accept="image/png, image/jpeg"/>
                  </div>
                </div>
                  <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2">
                          <input type="text" name="first_name" class="form-control text-white bg-transparent" placeholder="First Name" data-parsley-required data-parsley-errors-container="#p-e1" value="{{$data->first_name}}" {{$fn_edit}}>
                          <label class="text-white">First Name</label>
                          <div class="errorMsg d-none" id="p-e1"></div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2">
                          <input type="text" name="last_name" class="form-control text-white bg-transparent" placeholder="Last Name" data-parsley-required data-parsley-errors-container="#p-e1" value="{{$data->last_name}}" {{$ln_edit}}>
                          <label class="text-white">Last Name</label>
                          <div class="errorMsg d-none" id="p-e2"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2">
                          <input type="email" name="email" class="form-control text-white bg-transparent"  placeholder="Email address" data-parsley-type="email" data-parsley-required data-parsley-errors-container="#p-e2" value="{{$data->email}}" {{$email_edit}} readonly>
                          <label class="text-white">Email address</label>
                          <div class="errorMsg d-none" id="p-e2"></div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2">
                          <input type="text" name="dob" class="form-control text-white bg-transparent" placeholder="Date Of Birth" onclick="(this.type='date')" data-parsley-required data-parsley-errors-container="#p-e3" value="{{$data->dob}}" {{$dob_edit}} placeholder="{{date('d M, Y',strtotime($data->dob))}}">
                          <label class="text-white">Date Of Birth</label>
                          <div class="errorMsg d-none" id="p-e3"></div>
                        </div>
                      </div>
                    </div>
                        <!-- <div class="form-floating mb-2">
                          <select class="form-select text-white bg-transparent"  placeholder="Sex"  data-parsley-required data-parsley-errors-container="#p-e4">
                            <option class="text-dark p-2" value="1">Male</option>
                            <option class="text-dark p-2" value="2">Female</option>
                          </select>
                          <span class="errorMsg" id="p-e4"></span>
                          <label class="text-white">Sex</label>
                          <div class="errorMsg d-none" id="p-e4"></div>
                        </div> -->
                      <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2 select-transparent select-text-white" {{$gender_edit}}>
                          <select class="form-select form-select2-nosearch" data-theme="bootstrap-5" data-container="$( '.profile-fullscreen-modal')" data-placeholder=" "    data-parsley-required data-parsley-errors-container="#p-e5" name="gender" >
                            <option> </option>
                            <option class="text-dark p-2" value="Male" @if($data->gender == 'Male') selected @endif>Male</option>
                            <option class="text-dark p-2" value="Female" @if($data->gender == 'Female') selected @endif>Female</option>
                          </select>
                          <label class="text-white">Sex</label>
                          <div class="errorMsg d-none" id="p-e5"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2 select-transparent select-text-white">
                          <select class="form-select form-select2" data-theme="bootstrap-5" data-container="$('.profile-fullscreen-modal')" data-placeholder=" " data-parsley-required data-parsley-errors-container="#p-e6" name="nationality" {{$country_edit}}>
                            @foreach($countries as $country)
                              <option class="text-dark" value="{{$country->name}}">
                                {{$country->name}}
                              </option>
                            @endforeach
                          </select>
                          <label class="text-white">Country</label>
                          <div class="errorMsg d-none" id="p-e6"></div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2">
                          <input type="text" class="form-control text-white bg-transparent"  placeholder="Phone" data-parsley-required data-parsley-errors-container="#p-e7" name="phone" value="{{$data->phone}}" {{$phone_edit}}>
                          <label class="text-white">Phone</label>
                          <div class="errorMsg d-none" id="p-e7"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2">
                          <input type="number" class="form-control text-white bg-transparent" placeholder="Job Experience" name="job_experience" value="{{$data->job_experience}}" {{$je_edit}}>
                          <label class="text-white">Job Experience</label>
                        </div>
                        <div class="mt-5 mb-2 text-blue {{$sm_edit}}">Social Media Platforms</div>
                          <ul class="list-inline mt-2 {{$sm_edit}}">
                            <li class="list-inline-item">
                              <div class="d-flex justify-content-center align-items-center me-4">
                              <div class="profile_social_icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M9.429 8.969H13.143V10.819C13.678 9.755 15.05 8.799 17.111 8.799C21.062 8.799 22 10.917 22 14.803V22H18V15.688C18 13.475 17.465 12.227 16.103 12.227C14.214 12.227 13.429 13.572 13.429 15.687V22H9.429V8.969ZM2.57 21.83H6.57V8.799H2.57V21.83ZM7.143 4.55C7.14315 4.88528 7.07666 5.21724 6.94739 5.52659C6.81812 5.83594 6.62865 6.11651 6.39 6.352C5.9064 6.83262 5.25181 7.10165 4.57 7.1C3.88939 7.09954 3.23631 6.8312 2.752 6.353C2.51421 6.11671 2.32539 5.83582 2.19634 5.52643C2.0673 5.21704 2.00058 4.88522 2 4.55C2 3.873 2.27 3.225 2.753 2.747C3.23689 2.26816 3.89024 1.9997 4.571 2C5.253 2 5.907 2.269 6.39 2.747C6.872 3.225 7.143 3.873 7.143 4.55Z" fill="#00A3E0"/>
                                </svg>
                              </div>
                                  @php
                                  $isLinkedInConnected = json_decode(Auth::user()->linkedin_account);
                                  $isTwitterConnected = json_decode(Auth::user()->twitter_account);
                                  @endphp

                                  @if(!empty($isLinkedInConnected) && $isLinkedInConnected->isConnected)
                                      <span class="text-grey fs-5">connected</span>
                                  @else
                                      <a type="button" class="btn btn-sm btn-primary" style="padding: 2px 15px; border-radius: 50px;" href="{{ url('auth/linkedin') }}">connect</a>
                                  @endif
                              </div>
                            </li>
                            <li class="list-inline-item">
                              <div class="d-flex justify-content-center align-items-center">
                                <div class="profile_social_icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.205 2.25H21.513L14.286 10.51L22.788 21.75H16.13L10.916 14.933L4.94997 21.75H1.63997L9.36997 12.915L1.21497 2.25H8.03997L12.753 8.481L18.203 2.25H18.205ZM17.044 19.77H18.877L7.04497 4.126H5.07797L17.044 19.77Z" fill="#00A3E0" />
                                    </svg>
                                </div>

                                  @if(!empty($isTwitterConnected) && $isTwitterConnected->isConnected)
                                      <span class="text-grey fs-5">connected</span>
                                  @else
                                      <a type="button" class="btn btn-sm btn-primary" style="padding: 2px 15px; border-radius: 50px;" href="{{ url('auth/twitter') }}">connect</a>
                                  @endif
                              </div>
                            </li>
                          </ul>
                      </div>
                      <div class="col-12 mt-5">
                        <button type="submit" id="submitBtn" class="btn btn-sm btn-primary" @if($hidden_status == 'pending') disabled @endif>Save Changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
          </div>
          <div class="modal-footer p-0 border-0  d-block">
            <footer class="footer bg-transparent">
              <div class="footer__container container py-sm-5 py-1">
                <div class="footer__navigation">
                  <h3>Behind D&IT Excellence Lab</h3>
                  <ul>
                      <li><a href="#" title="About">About</a></li>
                      <li><a href="#" title="Terms">Terms</a></li>
                      <li><a href="#" title="Privacy">Privacy</a></li>
                      <li><a href="#" title="Cookies">Cookies</a></li>
                      <li><a href="#" title="Help">Help</a></li>
                  </ul>
                </div>
                <div class="footer__social">
                  <h3>Connect us on</h3>
                  <ul>
                    <li>
                      <a href="https://www.linkedin.com/company/aramco/" class="footer__social__linkedin" title="LinkedIn" target="_blank" rel="noreferrer">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M9.429 8.969H13.143V10.819C13.678 9.755 15.05 8.799 17.111 8.799C21.062 8.799 22 10.917 22 14.803V22H18V15.688C18 13.475 17.465 12.227 16.103 12.227C14.214 12.227 13.429 13.572 13.429 15.687V22H9.429V8.969ZM2.57 21.83H6.57V8.799H2.57V21.83ZM7.143 4.55C7.14315 4.88528 7.07666 5.21724 6.94739 5.52659C6.81812 5.83594 6.62865 6.11651 6.39 6.352C5.9064 6.83262 5.25181 7.10165 4.57 7.1C3.88939 7.09954 3.23631 6.8312 2.752 6.353C2.51421 6.11671 2.32539 5.83582 2.19634 5.52643C2.0673 5.21704 2.00058 4.88522 2 4.55C2 3.873 2.27 3.225 2.753 2.747C3.23689 2.26816 3.89024 1.9997 4.571 2C5.253 2 5.907 2.269 6.39 2.747C6.872 3.225 7.143 3.873 7.143 4.55Z" fill="#00A3E0"/>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="https://www.twitter.com/aramco" class="footer__social__twitter" title="Twitter" target="_blank" rel="noreferrer">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M18.205 2.25H21.513L14.286 10.51L22.788 21.75H16.13L10.916 14.933L4.94997 21.75H1.63997L9.36997 12.915L1.21497 2.25H8.03997L12.753 8.481L18.203 2.25H18.205ZM17.044 19.77H18.877L7.04497 4.126H5.07797L17.044 19.77Z" fill="#00A3E0" />
                          </svg>
                      </a>
                    </li>
                    <li>
                      <a href="https://www.facebook.com/aramco" class="footer__social__fb" title="Facebook" target="_blank" rel="noreferrer">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M15.12 5.32003H17V2.14003C16.0897 2.04538 15.1751 1.99865 14.26 2.00003C11.54 2.00003 9.67999 3.66003 9.67999 6.70003V9.32003H6.60999V12.88H9.67999V22H13.36V12.88H16.42L16.88 9.32003H13.36V7.05003C13.36 6.00003 13.64 5.32003 15.12 5.32003Z" fill="#00A3E0"/>
                        </svg>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </footer>
          </div>
        </div>
      </div>
    <!-- </div>
  </div>
</div> -->

<script src="{{asset('assets/web/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('assets/web/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/web/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/web/js/aramco.js')}}"></script>
<script src="{{asset('assets/web/js/parsley.min.js')}}"></script>
<script>

  $('.form-select2-nosearch').select2({
    width: '100%',
    minimumResultsForSearch: Infinity
  });

    $('.form-select2').select2({
      width: '100%',
    });

    @if($data->nationality)
      $('.form-select2').val('{!!$data->nationality!!}').trigger('change');
    @endif



    $('#myForm').submit(function (e) {
        // Show the loader when the form is submitted
        $('#submitBtn').prop('disabled', true);
        $("#spinner").show();
        $('#submitBtn').text('Saving.....');
    });
</script>
</body>
</html>
