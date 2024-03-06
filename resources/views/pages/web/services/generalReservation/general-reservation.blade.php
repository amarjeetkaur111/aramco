@extends('layouts.web')
@section('content')

<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<div class="container min-vh-70">

  <div class="row gutters">
  @include('pages.web.services.common-service')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
      <div class="pageheading my-3">
        <div class="sicon"><img src="{{asset('assets/web/images/icons/24/general-service-blue.svg')}}" class="img-fluid" /></div>
        <div class="stext">General Reservation</div>
      </div>
      <div class="col-sm-12">
            @if(\Illuminate\Support\Facades\Session::has('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ \Illuminate\Support\Facades\Session::get('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
      <p class="pagesubheading mb-2">To reserve technology workshop please fill the data form below</p>

      <form class="generalReservationForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" method="post" action="{{ route('services-general-reservation-store') }}">
        @csrf
        <input type="hidden" name="user_google_id" value="{{auth()->user()->google_id}}">
        <div class="row mt-5 mb-4 font-1-5rem">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Title<span class="text-red">*</span></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="title" data-parsley-required data-parsley-errors-container="#sv-e1" placeholder="Enter Title here.."/>
                <div class="errorMsg d-none" id="sv-e1"></div>
                  @if ($errors->has('title'))
                      <span class="text-danger">{{ $errors->first('title') }}</span>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-4 col-form-label">Start Date<span class="text-red">*</span></label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="startDate" name="start_date" onclick="(this.type='date')" data-parsley-required data-parsley-errors-container="#sv-e2"/>
                <div class="errorMsg d-none" id="sv-e2"></div>
                  @if ($errors->has('start_date'))
                      <span class="text-danger">{{ $errors->first('start_date') }}</span>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-4 col-form-label">End Date<span class="text-red">*</span></label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="endDate" name="end_date" onclick="(this.type='date')" data-parsley-required data-parsley-errors-container="#sv-e3"/>
                <div class="errorMsg d-none" id="sv-e3"></div>
                  @if ($errors->has('end_date'))
                      <span class="text-danger">{{ $errors->first('end_date') }}</span>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-4 col-form-label">Start Time<span class="text-red">*</span></label>
              <div class="col-sm-8">
{{--                <input type="time" class="form-control" name="start_time" onclick="(this.type='time')" data-parsley-required data-parsley-errors-container="#sv-e4" />--}}
                  <select class="form-control" name="start_time" data-parsley-required data-parsley-errors-container="#he-e3" id="start_time_id">
                      <option value="" disabled selected>HH:MM</option>
                      @foreach(CommonFunction::getTimeWithSelectionOption() as $index => $time)
                          <option value="{{ $index }}">{{ $time }}</option>
                      @endforeach
                  </select>

                  <div class="errorMsg d-none" id="he-e3"></div>
                  @if ($errors->has('start_time'))
                      <span class="text-danger">{{ $errors->first('start_time') }}</span>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-4 col-form-label">End Time<span class="text-red">*</span></label>
              <div class="col-sm-8">
{{--                <input type="time" class="form-control" name="end_time" data-parsley-required data-parsley-errors-container="#sv-e5" />--}}

                  <select class="form-control" name="end_time" data-parsley-required data-parsley-errors-container="#sv-e5" id="start_time_id">
                          <option value="" disabled selected>HH:MM</option>
                      @foreach(CommonFunction::getTimeWithSelectionOption() as $index => $time)
                          <option value="{{ $index }}">{{ $time }}</option>
                      @endforeach
                  </select>

                <div class="errorMsg d-none" id="sv-e5"></div>
                  @if ($errors->has('end_time'))
                      <span class="text-danger">{{ $errors->first('end_time') }}</span>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Service Description<span class="text-red">*</span></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="description" data-parsley-required data-parsley-errors-container="#sv-e6" placeholder="Enter Service Description.."/>
                <div class="errorMsg d-none" id="sv-e6"></div>
                  @if ($errors->has('description'))
                      <span class="text-danger">{{ $errors->first('description') }}</span>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Justification<span class="text-red">*</span></label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="justification" maxlength="100" data-parsley-required data-parsley-errors-container="#sv-e7" placeholder="Enter..."></textarea>
                <div class="errorMsg d-none" id="sv-e7"></div>
                  @if ($errors->has('justification'))
                      <span class="text-danger">{{ $errors->first('justification') }}</span>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end align-items-end">
            <button type="submit" class="btn btn-primary btn-lg" >Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- <div class="modal formSuccess-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-centered">
  <div class="modal-content rounded-5">
      <div class="modal-header px-5 py-4 border-success" style="border-width:0.15rem;">
        <h4 class="modal-title fs-4 d-flex align-items-center"><i class="fa-solid fa-circle-check text-success me-2" style="font-size:2rem;"></i> Success</h4>
      </div>
      <div class="modal-body px-5 py-4">
        <p>Request submitted successfully</p>
      </div>
      <div class="modal-footer p-3 border-top-0">
        <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->

@endsection
@push('custom-scripts')
<script>
  $('.header').removeClass('header--light');
  $('.header').addClass('header--dark');

  // var scheduleVisitValidate = () => {
  //   $('.generalReservationForm').parsley().validate();

  //   if ($('.generalReservationForm').parsley().isValid()) {
  //     $('.formSuccess-modal').modal('show');
  //   }
  // }

  $(window).on("load resize", function(e) {
    e.preventDefault();
    if ($(window).width() < 992) {
      $(".serviceListLinks").removeClass('show');
      $(".serviceListLinks").addClass('collapse');
    } else {
      $(".serviceListLinks").addClass('show');
      $(".serviceListLinks").addClass('collapse');
    }
  });
</script>
@endpush
