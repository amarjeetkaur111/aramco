@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container">

    <div class="row justify-content-between align-items-center mt-5 mb-2">
      <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
        <a href="{{route('profile_list')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
      </div>
    </div>

      <div class="row justify-content-between align-items-center my-2">
        <div class="col-12 d-flex justify-content-start align-items-center">
            <div class="pageheading">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/user-completion.svg')}}" class="img-fluid" /></div><div class="stext">Profile Completion</div>
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
                  <img class="profile-pic-status img-fluid" src="{{ !empty($data->profile_photo) ? $data->profile_photo : asset('assets/web/images/avatar.png')}}" />
                </div>
              </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
              <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-floating mb-5">
                    <input type="text" class="form-control" placeholder="Full Name" readonly value="{{$data->first_name}} {{$data->last_name}}">
                    <label>Full Name</label>
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-floating mb-2">
                    <input type="email" class="form-control"  placeholder="Email address" readonly value="{{$data->email}}">
                    <label>Email address</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-floating mb-5">
                    <input type="text" class="form-control" placeholder="Date Of Birth" readonly   value="{{$data->dob}}">
                    <label>Date Of Birth</label>
                  </div>
                  <div class="form-floating mb-5">
                    <input type="text" class="form-control" placeholder="Sex" readonly   value="{{$data->gender}}">
                    <label>Sex</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-floating mb-5">
                    <!-- <input type="text" class="form-control" placeholder="Country" readonly   value="{{$data->gender}}">-->

                    <select class="form-select form-select2 nationality" data-theme="bootstrap-5" data-container="$('.profile-fullscreen-modal')" data-placeholder=" " data-parsley-required data-parsley-errors-container="#p-e6" name="nationality">
                    @foreach($countries as $country)
                      <option class="text-dark" class="form-control" placeholder="Country" readonly value="{{$country->name}}">
                        {{$country->name}}
                      </option>
                    @endforeach
                    </select>
                    <label>Country</label>

                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-floating mb-5">
                    <input type="text" class="form-control" readonly  value="{{$data->phone}}" placeholder="Phone">
                    <label>Phone</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-floating mb-5">
                    <input type="text" class="form-control" placeholder="Profession" readonly  value="{{$data->job_experience}}">
                    <label>Profession</label>
                  </div>

                  @if($data->status == 'Pending')
                  <div class="col-12 mt-5 d-flex gap-4">
                    <button type="button" value="Approved" data-id="{{$data->id}}" class="btn btn-sm btn-success w-50 submit_btn" style="padding:0.55rem 1rem;">Accept</button>
                    <button type="button" value="Rejected" data-id="{{$data->id}}" class="btn btn-sm btn-danger w-50 submit_btn" style="padding:0.55rem 1rem;">Reject</button>
                  </div>
                  @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal formSuccess-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-centered">
  <div class="modal-content rounded-5">
      <div class="modal-header px-5 py-4 border-success" style="border-width:0.15rem;">
        <h4 class="modal-title fs-4 d-flex align-items-center"><i class="fa-solid fa-circle-check text-success me-2" style="font-size:2rem;"></i> Success</h4>
      </div>
      <div class="modal-body px-5 py-4">
        <p class="fs-5">Service replay submitted successfully</p>
      </div>
      <div class="modal-footer p-3 border-top-0">
        <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Close</button>
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

    $('.nationality').select2({
      width: '100%',
    });

    @if($data->nationality)
      $('.nationality').val('{!!$data->nationality!!}').trigger('change');
    @endif


      $('body').on('click', '.submit_btn', function (e) {
          let status = $(this).val();
          var $id = $(this).attr('data-id');
          var CSRF_TOKEN = '{{ csrf_token() }}';
          $.ajax({
              url: '{{ route('change_status') }}',
              type: 'POST',
              data: {_token: CSRF_TOKEN,
                      status:status,
                      profile_request_id:$id,
                  },
              dataType: 'text',
              success:function(response){
                 var data = JSON.parse(response)
                  console.log(data);
                  console.log(data.success);
                  $.confirm({
                      title: 'Info',
                      content: data.message,
                      buttons: {
                              OK: function () {
                                location.reload();
                              },
                      }
                  });

                  // var $select = $('#ref_no');
                  // $select.find('option').remove();
                  // $select.append(response)
              },error:function(xhr){
                  console.log(xhr)
              }
          })
      });

    </script>
@endpush
