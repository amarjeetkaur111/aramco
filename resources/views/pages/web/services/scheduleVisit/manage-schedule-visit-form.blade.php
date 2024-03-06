@extends('layouts.web')
@section('content')

<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-3 ">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
          <a href="{{route('services-admin-schedule-visit-list')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
        </div>
      </div>

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading mb-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/event-schedule-blue.svg')}}" class="img-fluid" /></div><div class="stext">Manage Schedule Visit</div>
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

          <form class="schedule-visit-form" action="{{ route('services-admin-schedule-visit-change-status') }}" method="POST" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
            @csrf
              <input type="hidden" name="schedule_visit_id" value="{{ $getVisitSchedule->id }}">
              <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">
            <div class="row mt-0 mb-4 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                    <label class="col-sm-4 col-form-label">Visit Title <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                      <input type="text" name="visit_title" class="form-control" value="{{ $getVisitSchedule->visit_title ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e1"/>
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
                    <input type="date" name="start_date" value="{{ date('Y-m-d', strtotime($getVisitSchedule->start_date)) }}" class="form-control" onclick="(this.type='date')" data-parsley-required data-parsley-errors-container="#sv-e3"/>
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
{{--                    <input type="time" name="start_time" class="form-control" onclick="(this.type='time')" value="{{ date('H:i', strtotime($getVisitSchedule->start_date)) }}" data-parsley-required data-parsley-errors-container="#sv-e4"/>--}}
                      <select class="form-control" name="start_time" data-parsley-required data-parsley-errors-container="#sv-e4" id="start_time_id">
                          <option></option>
                          @foreach(CommonFunction::getTimeWithSelectionOption() as $index => $time)
                              <option value="{{ $index }}" {{ ($index == date('H:i', strtotime($getVisitSchedule->start_date))) ? "selected" : "" }}>{{ $time }}</option>
                          @endforeach
                      </select>

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
{{--                    <input type="time" name="end_time" class="form-control" onclick="(this.type='time')" value="{{ date('H:i', strtotime($getVisitSchedule->end_date)) }}" data-parsley-required data-parsley-errors-container="#sv-e5"/>--}}

                      <select class="form-control" name="end_time" data-parsley-required data-parsley-errors-container="#sv-e5" id="end_time_id">
                          <option></option>
                          @foreach(CommonFunction::getTimeWithSelectionOption() as $index => $time)
                              <option value="{{ $index }}" {{ ($index == date('H:i', strtotime($getVisitSchedule->end_date))) ? "selected" : "" }}>{{ $time }}</option>
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
                <div class="row mb-5">
                  <label class="col-sm-2 col-form-label">Number of Visitors <span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <input type="number" name="num_of_visitors" class="form-control" min="0" value="{{ $getVisitSchedule->num_of_visitors ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e6"/>
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
                    <input type="text" name="visitor_coordinator_contact" class="form-control" value="{{ $getVisitSchedule->visitor_coordinator_contact ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e7"/>
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
                    <textarea class="form-control textarea-toggle" rows="3" name="justification" data-parsley-required data-parsley-errors-container="#sv-e8">{{ $getVisitSchedule->justification ?? "" }}</textarea>
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
                    <textarea class="form-control textarea-toggle" rows="3" name="additional_info" data-parsley-required data-parsley-errors-container="#sv-e9">{{ $getVisitSchedule->additional_info ?? "" }}</textarea>
                      <div class="errorMsg d-none" id="sv-e9"></div>
                      @if ($errors->has('additional_info'))
                          <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                      @endif
                  </div>
                </div>
              </div>
                @if($getVisitSchedule->status_of_request == "Pending")
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-end gap-3 mt-3">
                        <label class="col-sm-2 hidden-xs col-form-label"> </label>
                        <button type="submit" name="status_of_request" value="Approved" class="btn btn-success rounded-4 py-1" onClick="showFeedbackField('accept')">Accept</button>
                        <button type="button" class="btn btn-primary rounded-4 py-1" onClick="showFeedbackField('modify')">Modify</button>
                        <button type="button" class="btn btn-danger rounded-4 py-1" onClick="showFeedbackField('reject')">Reject</button>
                    </div>
                @endif
            </div>

          <div class="check-feedback-form" style="display: none">
            <div class="row font-1-5rem">
              <div class="col-sm-10 col-12 offset-sm-2 border-top mt-3 mb-4 pt-3">
                <div class="form-floating mb-2 position-relative">
                  <textarea class="form-control comments" rows="3" name="feedback" maxlength="100" placeholder="Enter Feedback.."></textarea>
                  <label>Enter Feedback..</label>
                  <div class="d-flex justify-content-start align-items-start taCountContainer">
                    <span class="ms-auto fs-5"><span class="taCount">0</span>/100</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end align-items-end gap-3 mt-3" style="display: none">
              <button type="submit" class="btn btn-primary rounded-4 py-1 btn-submit" name="status_of_request" value="modify" id="btn_modify" style="display: none">Save Changes</button>
              <button type="submit" class="btn btn-primary rounded-4 py-1 btn-submit" name="status_of_request" value="Rejected" id="btn_reject" style="display: none">Save Changes</button>
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

        $(function() {
            $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, select').prop("readonly", true);
            $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, select').css('background-color' , '#E9ECEFFF');

            $('#start_time_id').css('pointer-events','none');
            $('#end_time_id').css('pointer-events','none');
        });

       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');

        function showFeedbackField(status){
            if (status == "modify" || status == "reject") {
                $('.check-feedback-form').css('display', 'block');
                $('.btn-submit').css('display', 'block');
            }

            if (status == "accept") {
                $('.check-feedback-form').css('display', 'none');
                $('.btn-submit').css('display', 'none');
            }

            if (status == "modify") {
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, select').prop("readonly", false);
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, select').attr('data-parsley-required', true);
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, select').css('background-color' , '');

                $('#start_time_id').css('pointer-events','unset');
                $('#end_time_id').css('pointer-events','unset');
            } else {
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, select').prop("readonly", true);
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, select').removeAttr('data-parsley-required');
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, select').css('background-color' , '#E9ECEFFF');

                $('#start_time_id').css('pointer-events','none');
                $('#end_time_id').css('pointer-events','none');
            }

            if (status == "modify") {
                $('#btn_modify').css('display', 'block');
            } else {
                $('#btn_modify').css('display', 'none');
            }

            if (status == "reject") {
                $('#btn_reject').css('display', 'block');
            } else {
                $('#btn_reject').css('display', 'none');
            }


        }
       // var scheduleVisitValidate = () => {
       //
       //  $('.checkfeedbackForm').addClass('d-none');
       //  $('.scheduleVisitForm').parsley().validate();
       //
       //  if($('.scheduleVisitForm').parsley().isValid()){
       //    $('.formSuccess-modal').modal('show');
       //  }
       // }
       // var scheduleVisitModifyValidate = () => {
       //
       //  $('.checkfeedbackForm').removeClass('d-none');
       //  $('.scheduleVisitForm').parsley().validate();
       //  $('.checkfeedbackForm').parsley().validate();
       //
       //  if( $('.scheduleVisitForm').parsley().isValid() && $('.checkfeedbackForm').parsley().isValid() ){
       //    $('.formSuccess-modal').modal('show');
       //  }
       // }
       //
       // var checkfeedbackValidate = () => {
       //
       //  $('.checkfeedbackForm').removeClass('d-none');
       //  $('.checkfeedbackForm').parsley().validate();
       //
       //  if($('.checkfeedbackForm').parsley().isValid()){
       //    $('.formSuccess-modal').modal('show');
       //  }
       // }





       $('.comments').on("input", function() {
        var currentLength = $(this).val().length;
        $(this).parent().find('.taCountContainer').find('.taCount').html(currentLength);
      });
    </script>
@endpush
