@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container">

    <div class="row justify-content-between align-items-center mt-5 mb-2">
      <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
        <a href="{{route('user-profiles')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
      </div>
    </div>

      <div class="row justify-content-between align-items-center my-2">
        <div class="col-12 d-flex justify-content-start align-items-center">
            <div class="pageheading">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/user-profile.svg')}}" class="img-fluid" /></div><div class="stext">User Profiles</div>
            </div>
        </div>
      </div>
    </div>
    <div class="container min-vh-70">

    <div class="row g-4">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              
                <div class="row gutters">
                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    
                  <div class="profile-circle-container">
                    <div class="profile-circle">
                      <img class="profile-pic-status img-fluid" src="{{asset('assets/web/images/avatar.png')}}" />                      
                    </div>                   
                  </div>

                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">


                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2">
                          <input type="text" class="form-control" placeholder="Full Name" readonly value="Khalid">
                          <label>Full Name</label>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2">
                          <input type="email" class="form-control"  placeholder="Email address" readonly value="Khalid@gmail.com">
                          <label>Email address</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2">
                          <input type="text" class="form-control" placeholder="Date Of Birth" readonly   value="06/20/2023">
                          <label>Date Of Birth</label>
                        </div>
                        <div class="form-floating mb-2">
                          <input type="text" class="form-control" placeholder="Sex" readonly   value="Male">
                          <label>Sex</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">                        
                        <div class="form-floating mb-2">
                          <input type="text" class="form-control" placeholder="Country" readonly   value="Saudi">
                          <label>Country</label>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2">
                          <input type="text" class="form-control" readonly  value="9444451236" placeholder="Phone">
                          <label>Phone</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-2">
                          <input type="text" class="form-control" placeholder="Profession" readonly  value="Event Handler">
                          <label>Profession</label>
                        </div>
                        
                        
                    </div>



                  </div>
                </div>

        </div>
        
        
        

      </div>


    </div>
@endsection
@push('custom-scripts')
    <script>
    $(document).ready(function () {
       
       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');
    });


    </script>
@endpush