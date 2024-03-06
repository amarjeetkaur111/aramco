@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-3 ">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
          <a href="{{route('services-admin-cancel-schedule-visit-list')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
        </div>
      </div>
      @php
      $showMode = 'disabled';
      @endphp

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading mb-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/event-schedule-blue.svg')}}" class="img-fluid" /></div><div class="stext">Cancel Schedule Visit</div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border-bottom pt-3 pb-4 mb-3">
          <div class="user-list">
            <span class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/user-profile-white.svg')}}" class="img-fluid" /></span>
            <div class="w-100">
              <div class="user-details fs-4" style="color: #323232;">{{ ucfirst($getVisitSchedule->user->first_name) }}</div>
              <div class="user-details" style="color: #5F6369;">{{ $getVisitSchedule->user->email }}</div>
            </div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            @if(Session::has('msg'))
                <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                    {{ Session::get('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

              <div class="infoDesc mt-0 {{ CommonFunction::statusWiseServiceColor($getVisitSchedule->status_of_request) }}"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning-yellow.svg')}}" class="img-fluid" /></span>Status : {{ $getVisitSchedule->status_of_request ?? "" }}</div>

          <form class="schedule-visit-form" id="myForm" action="{{ route('services-admin-cancel-schedule-visit-post') }}" method="POST"  >
            @csrf
              <input type="hidden" name="id" value="{{ $getVisitSchedule->id }}">
              <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">
            <div class="row mt-0 mb-4 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                    <label class="col-sm-4 col-form-label">Visit Title <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                      <input type="text" {{$showMode}} name="visit_title" class="form-control" value="{{ $getVisitSchedule->visit_title ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e1"/>
                      <div class="errorMsg d-none" id="sv-e1"></div>
                      @if ($errors->has('visit_title'))
                          <span class="text-danger">{{ $errors->first('visit_title') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Date of Visit <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="date" {{$showMode}} name="start_date" value="{{ date('Y-m-d', strtotime($getVisitSchedule->start_date)) }}" class="form-control" onclick="(this.type='date')" data-parsley-required data-parsley-errors-container="#sv-e3"/>
                    <div class="errorMsg d-none" id="sv-e3"></div>
                      @if ($errors->has('start_date'))
                          <span class="text-danger">{{ $errors->first('start_date') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Start Time <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="time" {{$showMode}} name="start_time" class="form-control" onclick="(this.type='time')" value="{{ date('H:i', strtotime($getVisitSchedule->start_date)) }}" data-parsley-required data-parsley-errors-container="#sv-e4"/>
                    <div class="errorMsg d-none" id="sv-e4"></div>
                      @if ($errors->has('start_time'))
                          <span class="text-danger">{{ $errors->first('start_time') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">End Time <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="time" {{$showMode}} name="end_time" class="form-control" onclick="(this.type='time')" value="{{ date('H:i', strtotime($getVisitSchedule->end_date)) }}" data-parsley-required data-parsley-errors-container="#sv-e5"/>
                    <div class="errorMsg d-none" id="sv-e5"></div>
                      @if ($errors->has('end_time'))
                          <span class="text-danger">{{ $errors->first('end_time') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-2 col-form-label">Number of Visitors <span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <input type="number" {{$showMode}} name="num_of_visitors" class="form-control" min="0" value="{{ $getVisitSchedule->num_of_visitors ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e6"/>
                    <div class="errorMsg d-none" id="sv-e6"></div>
                      @if ($errors->has('num_of_visitors'))
                          <span class="text-danger">{{ $errors->first('num_of_visitors') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-2 col-form-label">Visitors Coordinator Contact <span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" {{$showMode}} name="visitor_coordinator_contact" class="form-control" value="{{ $getVisitSchedule->visitor_coordinator_contact ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e7"/>
                    <div class="errorMsg d-none" id="sv-e7"></div>
                      @if ($errors->has('visitor_coordinator_contact'))
                          <span class="text-danger">{{ $errors->first('visitor_coordinator_contact') }}</span>
                      @endif
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-2 col-form-label">Justification<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control textarea-toggle" rows="3" {{$showMode}} name="justification" data-parsley-required data-parsley-errors-container="#sv-e8">{{ $getVisitSchedule->justification ?? "" }}</textarea>
                      <div class="errorMsg d-none" id="sv-e8"></div>
                      @if ($errors->has('justification'))
                          <span class="text-danger">{{ $errors->first('justification') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-2 col-form-label">Additional Information<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control textarea-toggle" {{$showMode}} rows="3" name="additional_info" data-parsley-required data-parsley-errors-container="#sv-e9">{{ $getVisitSchedule->additional_info ?? "" }}</textarea>
                      <div class="errorMsg d-none" id="sv-e9"></div>
                      @if ($errors->has('additional_info'))
                          <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                      @endif
                  </div>
                </div>
              </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-end gap-3 mt-3">
                        <label class="col-sm-2 hidden-xs col-form-label"> </label>
                        <button type="submit" name="cancellation_request" value="Approved" class="btn btn-success rounded-4 py-1" >Accept</button>
                        <button type="submit" name="cancellation_request" class="btn btn-danger rounded-4 py-1" value="Rejected">Reject</button>
                    </div>

            </div>

          <div class="check-feedback-form">
            <div class="row font-1-5rem">
              <div class="col-sm-10 col-12 offset-sm-2 border-top mt-3 mb-4 pt-3">
                <div class="form-floating mb-2 position-relative">
                  <textarea class="form-control comments" rows="3" name="feedback" maxlength="100" placeholder="Enter Feedback.." data-parsley-minlength="20" data-parsley-errors-container="#fb-e1"></textarea>
                  <label>Enter Feedback..</label>
                  <div class="d-flex justify-content-start align-items-start taCountContainer">
                    <div class="errorMsg d-none" id="fb-e1"></div>
                    <span class="ms-auto fs-5"><span class="taCount">0</span>/100</span>
                  </div>
                </div>
              </div>
            </div>
          </div>


          </form>
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

       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');

      $('.comments').on("input", function() {
        var currentLength = $(this).val().length;
        $(this).parent().find('.taCountContainer').find('.taCount').html(currentLength);
      });
    </script>
@endpush
