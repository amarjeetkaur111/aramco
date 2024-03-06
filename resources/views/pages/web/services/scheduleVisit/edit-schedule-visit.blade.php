@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-3 ">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
          <a href="{{route('my-activity')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>My Activity <span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span> Schedule a Visit</a>
        </div>
      </div>

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading mb-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/event-schedule-blue.svg')}}" class="img-fluid" /></div><div class="stext">Schedule a Visit</div>
          </div>
        </div>
        <div>Please edit the form below</div>
        @if(Session::has('msg'))
                <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                    {{ Session::get('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form class="scheduleVisitForm" action="{{route('services-my-schedule-visits-edit-post')}}" method="POST" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
            @csrf
              <input type="hidden" name="schedule_visit_id" value="{{ $scheduleVisit->id }}">
              <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">
            <div class="row mt-0 mb-4 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                    <label class="col-sm-4 col-form-label">Visit Title <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                      <input type="text" name="visit_title" @if($showMode) disabled @endif class="form-control" value="{{ $scheduleVisit->visit_title ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e1"/>
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
                    <input type="date" name="start_date" @if($showMode) disabled @endif value="{{ date('Y-m-d', strtotime($scheduleVisit->start_date)) }}" class="form-control" onclick="(this.type='date')" data-parsley-required data-parsley-errors-container="#sv-e2"/>
                    <div class="errorMsg d-none" id="sv-e2"></div>
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
                    <input type="time" name="start_time" @if($showMode) disabled @endif class="form-control" onclick="(this.type='time')" value="{{ date('H:i', strtotime($scheduleVisit->start_date)) }}" data-parsley-required data-parsley-errors-container="#sv-e3"/>
                    <div class="errorMsg d-none" id="sv-e3"></div>
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
                    <input type="time" name="end_time" @if($showMode) disabled @endif class="form-control" onclick="(this.type='time')" value="{{ date('H:i', strtotime($scheduleVisit->end_date)) }}" data-parsley-required data-parsley-errors-container="#sv-e4"/>
                    <div class="errorMsg d-none" id="sv-e4"></div>
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
                    <input type="number" name="num_of_visitors" @if($showMode) disabled @endif class="form-control" min="0" value="{{ $scheduleVisit->num_of_visitors ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e5"/>
                    <div class="errorMsg d-none" id="sv-e5"></div>
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
                    <input type="text" name="visitor_coordinator_contact" @if($showMode) disabled @endif class="form-control" value="{{ $scheduleVisit->visitor_coordinator_contact ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e6"/>
                    <div class="errorMsg d-none" id="sv-e6"></div>
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
                    <textarea class="form-control textarea-toggle" rows="3" @if($showMode) disabled @endif name="justification" data-parsley-required data-parsley-errors-container="#sv-e7">{{ $scheduleVisit->justification ?? "" }}</textarea>
                      <div class="errorMsg d-none" id="sv-e7"></div>
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
                    <textarea class="form-control textarea-toggle" rows="3" name="additional_info" @if($showMode) disabled @endif data-parsley-required data-parsley-errors-container="#sv-e8">{{ $scheduleVisit->additional_info ?? "" }}</textarea>
                      <div class="errorMsg d-none" id="sv-e8"></div>
                      @if ($errors->has('additional_info'))
                          <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              @if(!$showMode)
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-end gap-3 mt-3">
              <label class="col-sm-2 hidden-xs col-form-label"> </label>
                <button type="submit" class="btn btn-primary rounded-4 py-1" onClick="scheduleVisitValidate()">Save Changes</button>
              </div>
              @endif

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
        <p class="fs-5">Service submitted successfully</p>
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

      var scheduleVisitValidate = () => {
        $('.scheduleVisitForm').parsley().validate();
        if($('.scheduleVisitForm').parsley().isValid()){
          $('.formSuccess-modal').modal('show');
        }else{
          return false;
        }
       }
    </script>
@endpush
