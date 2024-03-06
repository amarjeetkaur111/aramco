@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-5 mb-4">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
          <a href="{{ route('services-admin-reserve-technology-list') }}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
        </div>
      </div>

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading mb-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-technology-workshop-blue.svg')}}" class="img-fluid" /></div><div class="stext">Reserve Technology Workshop Space</div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border-bottom pt-3 pb-4 mb-3">
          <div class="user-list">
            <span class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/user-profile-white.svg')}}" class="img-fluid" /></span>
            <div class="w-100">
              <div class="user-details fs-4" style="color: #323232;">{{ ucfirst($resrveTech->user->first_name) }}</div>
              <div class="user-details" style="color: #5F6369;">{{ ucfirst($resrveTech->user->email) }}</div>
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

              <!-- <div class="infoDesc mt-0 text-warning"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning-yellow.svg')}}" class="img-fluid" /></span>Status : Pending</div> -->
              <div class="infoDesc mt-0 {{ CommonFunction::statusWiseServiceColor($resrveTech->status_of_request) }}"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning-yellow.svg')}}" class="img-fluid" /></span>Status : {{ $resrveTech->status_of_request ?? "" }}</div>
          <form class="reservedTechnologyWorkshopSpaceForm" action="{{route('services-admin-reserve-technology-change-status')}}" method="post" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
            @csrf
              <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">
              <input type="hidden" name="technology_workshop_id" value="{{$resrveTech->id}}">
          <div class="row mt-5 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Workshop Name <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="workshop_name" value="{{$resrveTech->workshop_name}}" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e"></div>
                      @if ($errors->has('workshop_name'))
                          <span class="text-danger">{{ $errors->first('workshop_name') }}</span>
                      @endif
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="row mb-3">
                      <label class="col-sm-4 col-form-label">Available Rooms <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                          <select name="space_name" class="form-control" id="available_room_id" data-parsley-required data-parsley-errors-container="#he-e99">
                              <option></option>
                          @foreach($available_room as $key => $value)
                              <option value="{{ $key }}" {{ ($key == $resrveTech->space_name) ? 'selected' : "" }}>{{ $value }}</option>
                          @endforeach
                          </select>
                          <div class="errorMsg d-none" id="he-e99"></div>
                          @if ($errors->has('space_name'))
                              <span class="text-danger">{{ $errors->first('space_name') }}</span>
                          @endif
                      </div>
                  </div>
              </div>
            </div>
            <div class="row font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Start Date <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                  <input type="date" name="start_date" value="{{ date('Y-m-d', strtotime($resrveTech->start_date)) }}" class="form-control" onclick="(this.type='date')"/>
                    <div class="errorMsg d-none" id="he-e1"></div>
                      @if ($errors->has('start_date'))
                          <span class="text-danger">{{ $errors->first('start_date') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">End Date <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                  <input type="date" name="end_date" value="{{ date('Y-m-d', strtotime($resrveTech->end_date)) }}" class="form-control" onclick="(this.type='date')"/>
                    <div class="errorMsg d-none" id="he-e2"></div>
                      @if ($errors->has('end_date'))
                          <span class="text-danger">{{ $errors->first('end_date') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Start Time <span class="text-red">*</span></label>
                  <div class="col-sm-8">
{{--                    <input type="time" name="start_time" class="form-control" value="{{ date('H:i', strtotime($resrveTech->start_date)) }}" onclick="(this.type='time')"/>--}}

                      <select class="form-control" name="start_time" data-parsley-required data-parsley-errors-container="#he-e3" id="start_time_id">
                          <option></option>
                          @foreach(CommonFunction::getTimeWithSelectionOption() as $index => $time)
                              <option value="{{ $index }}" {{ ($index == date('H:i', strtotime($resrveTech->start_date))) ? "selected" : "" }}>{{ $time }}</option>
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
                  <label class="col-sm-4 col-form-label">End Time <span class="text-red">*</span></label>
                  <div class="col-sm-8">
{{--                    <input type="time" name="end_time" value="{{ date('H:i', strtotime($resrveTech->end_date)) }}" class="form-control" onclick="(this.type='time')"/>--}}

                      <select class="form-control" name="end_time" data-parsley-required data-parsley-errors-container="#he-e4" id="end_time_id">
                          <option></option>
                          @foreach(CommonFunction::getTimeWithSelectionOption() as $index => $time)
                              <option value="{{ $index }}" {{ ($index == date('H:i', strtotime($resrveTech->end_date))) ? "selected" : "" }}>{{ $time }}</option>
                          @endforeach
                      </select>

                      <div class="errorMsg d-none" id="he-e4"></div>
                      @if ($errors->has('end_time'))
                          <span class="text-danger">{{ $errors->first('end_time') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Number of People <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="number" name="num_of_people"  class="form-control" min="0" value="{{$resrveTech->num_of_people}}"/>
                    <div class="errorMsg d-none" id="he-e5"></div>
                      @if ($errors->has('num_of_people'))
                          <span class="text-danger">{{ $errors->first('num_of_people') }}</span>
                      @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-4 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Point of Contact <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="point_of_contact" class="form-control" value="{{$resrveTech->point_of_contact}}"/>
                    <div class="errorMsg d-none" id="he-e6"></div>
                      @if ($errors->has('point_of_contact'))
                          <span class="text-danger">{{ $errors->first('point_of_contact') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Justification <span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control textarea-toggle" name="justification" rows="3" data-parsley-required data-parsley-errors-container="#he-e8">{{$resrveTech->justification}}</textarea>
                    <div class="errorMsg d-none" id="he-e8"></div>
                      @if ($errors->has('justification'))
                          <span class="text-danger">{{ $errors->first('justification') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Additional Information <span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control textarea-toggle" name="additional_info" rows="3" data-parsley-required data-parsley-errors-container="#he-e9">{{$resrveTech->additional_info}}</textarea>
                    <div class="errorMsg d-none" id="he-e9"></div>
                      @if ($errors->has('additional_info'))
                          <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                      @endif
                  </div>
                </div>
              </div>

                @if($resrveTech->status_of_request == "Pending")
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <a href="{{ route('services-admin-send-invite', ['module' => 'reserve-technology', 'id' => $resrveTech->id]) }}"
                                   class="btn btn-primary rounded-4 py-1">Add Invites</a>
                                <p class="mb-0 fs-5" style="color:#808080;">Send invites to remind attendees *</p>
                            </div>
                        </div>
                    </div>

                    <div id="action_div">
                        <div
                            class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end align-items-end gap-3 mt-3">
                            <button type="button" class="btn btn-primary rounded-4 py-1"
                                    onClick="showFeedbackField('modify')">Modify
                            </button>
                            <button type="submit" name="status_of_request" value="Approved"
                                    class="btn btn-success rounded-4 py-1 btn-action" onClick="showFeedbackField('accept')">Accept
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
        var get_available_room = "{{ empty($resrveTech->space_name) ? true : false }}";

        $(function() {
            $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, select').prop("readonly", true);
            $('#available_room_id').css('pointer-events','none');
            $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, #available_room_id, select').css('background-color' , '#E9ECEFFF');

            if (get_available_room){
                $('.btn-action').prop('disabled', true);
            } else {
                $('.btn-action').prop('disabled', false);
            }

            $('#start_time_id').css('pointer-events','none');
            $('#end_time_id').css('pointer-events','none');
        });

       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');

       function showFeedbackField(status){
            if (status == "modify" || status == "reject") {
                $('.check-feedback-form').css('display', 'block');
                $('.btn-submit').css('display', 'block');
                $('#btn_cancel').css('display', 'block');
                $('#action_div').hide();
            } else {
                $('#btn_cancel').css('display', 'none');
                $('#action_div').hide();
            }


           if (status == "accept") {
                $('.check-feedback-form').css('display', 'none');
                $('.btn-submit').css('display', 'none');
            }

            if (status == "modify") {
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, select').prop("readonly", false);
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, #available_room_id, select').attr('data-parsley-required', true);
                $('#available_room_id').css('pointer-events','unset');
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, #available_room_id, select').css('background-color' , '');

                $('#start_time_id').css('pointer-events','unset');
                $('#end_time_id').css('pointer-events','unset');

            } else {
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, select').prop("readonly", true);
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, #available_room_id, select').removeAttr('data-parsley-required');
                $('#available_room_id').css('pointer-events','none');
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle, #available_room_id, select').css('background-color' , '#E9ECEFFF');

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

      //  var reservedTechnologyWorkshopSpaceValidate = () => {

      //   $('.checkfeedbackForm').addClass('d-none');
      //   $('.reservedTechnologyWorkshopSpaceForm').parsley().validate();

      //   if($('.reservedTechnologyWorkshopSpaceForm').parsley().isValid()){
      //     $('.formSuccess-modal').modal('show');
      //   }
      //  }
      //  var reservedTechnologyWorkshopSpaceModifyValidate = () => {

      //   $('.checkfeedbackForm').removeClass('d-none');
      //   $('.reservedTechnologyWorkshopSpaceForm').parsley().validate();
      //   $('.checkfeedbackForm').parsley().validate();

      //   if( $('.reservedTechnologyWorkshopSpaceForm').parsley().isValid() && $('.checkfeedbackForm').parsley().isValid() ){
      //     $('.formSuccess-modal').modal('show');
      //   }
      //  }

      //  var checkfeedbackValidate = () => {

      //   $('.checkfeedbackForm').removeClass('d-none');
      //   $('.checkfeedbackForm').parsley().validate();

      //   if($('.checkfeedbackForm').parsley().isValid()){
      //     $('.formSuccess-modal').modal('show');
      //   }
      //  }





       $('.comments').on("input", function() {
        var currentLength = $(this).val().length;
        $(this).parent().find('.taCountContainer').find('.taCount').html(currentLength);
      });
    </script>
@endpush
