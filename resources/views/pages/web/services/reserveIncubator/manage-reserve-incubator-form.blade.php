@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-5 mb-4">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
          <a href="{{ route('services-admin-reserve-incubator-list') }}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
        </div>
      </div>

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading mb-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-incubator-blue.svg')}}" class="img-fluid" /></div><div class="stext">Reserve Incubator</div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border-bottom pt-3 pb-4 mb-3">
          <div class="user-list">
            <span class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/user-profile-white.svg')}}" class="img-fluid" /></span>
            <div class="w-100">
              <div class="user-details fs-4" style="color: #323232;">{{ ucfirst($getReserveIncubator->user->first_name) }}</div>
              <div class="user-details" style="color: #5F6369;">{{ ucfirst($getReserveIncubator->user->email) }}</div>
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

            <div class="infoDesc mt-0 {{ CommonFunction::statusWiseServiceColor($getReserveIncubator->status_of_request) }}"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning-yellow.svg')}}" class="img-fluid" /></span>Status : {{ $getReserveIncubator->status_of_request ?? "" }}</div>

          <form class="reservedIncubatorsForm" action="{{ route('services-admin-reserve-incubator-change-status') }}" method="POST" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
            @csrf

              <input type="hidden" name="reserve_incubator_id" value="{{ $getReserveIncubator->id }}">
              <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">

              <div class="row mt-5 font-1-5rem">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                      <div class="row mb-5">
                          <label class="col-sm-4 col-form-label">Name of the use case<span class="text-red">*</span>
                          </label>
                          <div class="col-sm-8">
                              <input type="text" class="form-control" name="usecase_name"
                                     value="{{ $getReserveIncubator->usecase_name ?? "" }}" data-parsley-required
                                     data-parsley-errors-container="#sv-e1"/>
                              <div class="errorMsg d-none" id="sv-e1"></div>
                              @if ($errors->has('usecase_name'))
                                  <span class="text-danger">{{ $errors->first('usecase_name') }}</span>
                              @endif
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                      <div class="row mb-5">
                          <label class="col-sm-4 col-form-label">Available Rooms<span class="text-red">*</span>
                          </label>
                          <div class="col-sm-8">
                              <select class="form-control" id="available_room_id" name="space_name" data-parsley-required data-parsley-errors-container="#sv-e101">
                                  <option></option>
                                  @foreach($available_room as $key => $value)
                                      <option value="{{ $key }}" {{ ($key == $getReserveIncubator->space_name) ? 'selected' : "" }}>{{ $value }}</option>
                                  @endforeach
                              </select>
                              <div class="errorMsg d-none" id="sv-e101"></div>
                              @if ($errors->has('space_name'))
                                  <span class="text-danger">{{ $errors->first('space_name') }}</span>
                              @endif
                          </div>
                      </div>
                  </div>
              </div>

            <div class="row font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Start Date<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" onclick="(this.type='date')" name="start_date" value="{{ date('Y-m-d', strtotime($getReserveIncubator->start_date)) }}" data-parsley-required data-parsley-errors-container="#sv-e2"/>
                    <div class="errorMsg d-none" id="he-e2"></div>
                      @if ($errors->has('start_date'))
                          <span class="text-danger">{{ $errors->first('start_date') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">End Date<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                      <input type="date" class="form-control" onclick="(this.type='date')" name="end_date" value="{{ date('Y-m-d', strtotime($getReserveIncubator->end_date)) }}" data-parsley-required data-parsley-errors-container="#sv-e3"/>
                      <div class="errorMsg d-none" id="he-e3"></div>
                      @if ($errors->has('end_date'))
                          <span class="text-danger">{{ $errors->first('end_date') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Main contact of the use case<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="contact_of_usecase" value="{{ $getReserveIncubator->contact_of_usecase ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e4"/>
                    <div class="errorMsg d-none" id="he-e4"></div>
                      @if ($errors->has('contact_of_usecase'))
                          <span class="text-danger">{{ $errors->first('contact_of_usecase') }}</span>
                      @endif
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">No.of employees working on use case<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" min="0" name="num_of_employees" value="{{ $getReserveIncubator->num_of_employees ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e5"/>
                    <div class="errorMsg d-none" id="he-e5"></div>
                      @if ($errors->has('num_of_employees'))
                          <span class="text-danger">{{ $errors->first('num_of_employees') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-2 col-form-label">Justification<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control textarea-toggle" rows="3" data-parsley-required data-parsley-errors-container="#he-e6" name="justification">{{ $getReserveIncubator->justification ?? "" }}</textarea>
                    <div class="errorMsg d-none" id="he-e6"></div>
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
                    <textarea class="form-control textarea-toggle" rows="3" data-parsley-required data-parsley-errors-container="#he-e7" name="additional_info">{{ $getReserveIncubator->additional_info ?? "" }}</textarea>
                    <div class="errorMsg d-none" id="he-e7"></div>
                      @if ($errors->has('additional_info'))
                          <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                      @endif
                  </div>
                </div>
              </div>

                @if($getReserveIncubator->status_of_request == "Pending")
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <a href="{{ route('services-admin-send-invite', ['module' => 'reserve-incubator', 'id' => $getReserveIncubator->id]) }}" class="btn btn-primary rounded-4 py-1">Add Invites</a>
                                <p class="mb-0 fs-5" style="color:#808080;">Send invites to remind attendees *</p>
                            </div>
                        </div>
                    </div>
                    <div id="action_div">
                        <div
                            class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-end gap-3 mt-3">

                            <label class="col-sm-2 hidden-xs col-form-label"> </label>
                            <button type="button" class="btn btn-primary rounded-4 py-1"
                                    onClick="showFeedbackField('modify')">Modify
                            </button>
                            <button type="submit" name="status_of_request" value="Approved"
                                    class="btn btn-success rounded-4 py-1 btn-action"
                                    onClick="showFeedbackField('accept')">Accept
                            </button>
                            <button type="button" class="btn btn-danger rounded-4 py-1 btn-action"
                                    onClick="showFeedbackField('reject')">Reject
                            </button>
                        </div>
                    </div>
                @endif

            </div>

              <div class="check-feedback-form" style="display: none">
                  <div class="row font-1-5rem">
                      <div class="col-sm-10 col-12 offset-sm-2 border-top mt-3 mb-4 pt-3">
                          <div class="form-floating mb-2 position-relative">
                              <textarea class="form-control comments" name="feedback" rows="3" maxlength="100" placeholder="Enter Feedback.."></textarea>
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
                  <a class="btn btn-danger rounded-4 py-1" id="btn_cancel" style="display: none" onclick="location.reload()">Cancel</a>

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

       var get_available_room = "{{ empty($getReserveIncubator->space_name) ? true : false }}";

       $(function() {
           $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle').prop("readonly", true);
           $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, #available_room_id').css('background-color' , '#E9ECEFFF');
           $('#available_room_id').css('pointer-events','none');

            if (get_available_room){
                $('.btn-action').prop('disabled', true);
            } else {
                $('.btn-action').prop('disabled', false);
            }
       });

       function showFeedbackField(status){
           if (status == "modify" || status == "reject") {
               $('.check-feedback-form').css('display', 'block');
               $('.btn-submit').css('display', 'block');
               $('#btn_cancel').css('display', 'block');
               $('#action_div').hide();
           } else {
               $('#btn_cancel').css('display', 'none');
               $('#action_div').show();
           }

           if (status == "accept") {
               $('.check-feedback-form').css('display', 'none');
               $('.btn-submit').css('display', 'none');
           }

           if (status == "modify") {
               $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle').prop("readonly", false);
               $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, #available_room_id').attr('data-parsley-required', true);
               $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, #available_room_id').css('background-color' , '');
               $('#available_room_id').css('pointer-events','unset');
           } else {
               $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle').prop("readonly", true);
               $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, #available_room_id').removeAttr('data-parsley-required');
               $('#available_room_id').css('pointer-events','none');
               $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, #available_room_id').css('background-color' , '#E9ECEFFF');
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

       // var reservedIncubatorsValidate = () => {
       //
       //  $('.checkfeedbackForm').addClass('d-none');
       //  $('.reservedIncubatorsForm').parsley().validate();
       //
       //  if($('.reservedIncubatorsForm').parsley().isValid()){
       //    $('.formSuccess-modal').modal('show');
       //  }
       // }
       // var reservedIncubatorsModifyValidate = () => {
       //
       //  $('.checkfeedbackForm').removeClass('d-none');
       //  $('.reservedIncubatorsForm').parsley().validate();
       //  $('.checkfeedbackForm').parsley().validate();
       //
       //  if( $('.reservedIncubatorsForm').parsley().isValid() && $('.checkfeedbackForm').parsley().isValid() ){
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
