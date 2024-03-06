@extends('layouts.web')
@section('content')
<style>
  .checkbox {
    position: relative;
    display: flex;
    align-items: center;
    gap: 14px;
    cursor: pointer;
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;

    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    margin-top: 10px;
  }

  .checkbox input {
    position: absolute;
    width: 0;
    left: 50px;
    height: 0;
    opacity: 0;
    cursor: pointer;
  }

  .checkbox .checkmark {
    position: relative;
    display: block;
    top: 0;
    left: 0;
    width: 16px;
    height: 16px;
    background: white;
    border-radius: 3px;
    outline: 1px solid #acacac;
    transition: all 0.2s ease;
  }

  .checkbox:hover .checkmark {
    background: #f4f4f5;
    transition: all 0.2s ease;
  }

  .checkbox input:checked~.checkmark {
    background: #3f7fed;
    outline: 1px solid rgb(95, 126, 240);
  }

  /* .checkbox input[type="radio"] ~ .checkmark {
    border-radius: 50%;
} */

  .checkbox .checkmark::after {
    position: absolute;
    display: block;
    content: "";
    left: 50%;
    top: 40%;
    width: 4px;
    height: 8px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: translate(-50%, -50%) rotate(45deg);
    -webkit-transform: translate(-50%, -50%) rotate(45deg);
    -moz-transform: translate(-50%, -50%) rotate(45deg);
    -ms-transform: translate(-50%, -50%) rotate(45deg);
    opacity: 0;
    transition: all 0.2s ease;
  }

  .checkbox input:checked~.checkmark::after {
    opacity: 1;
    transition: all 0.2s ease;
  }
</style>
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<div class="container min-vh-70">

  <div class="row gutters">
     @include('pages.web.services.common-service')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
      <div class="pageheading my-3">
        <div class="sicon"><img src="{{asset('assets/web/images/icons/24/event.svg')}}" class="img-fluid" /></div>
        <div class="stext">Host an Event</div>
      </div>
        <div class="col-sm-12">
            @if(\Illuminate\Support\Facades\Session::has('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ \Illuminate\Support\Facades\Session::get('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
      <p class="pagesubheading mb-2">To host an event please fill the data form below</p>

      <form class="hostEventForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" method="post" action="{{ route('services-host-event-store') }}">
          @csrf
          <input type="hidden" name="user_google_id" value="{{ auth()->user()->google_id }}">
          <div class="row mt-5 mb-4 font-1-5rem">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Event Name<span class="text-red">*</span></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ old('event_name') }}" name="event_name" data-parsley-required data-parsley-errors-container="#sv-e1" placeholder="Enter event name.."/>
                <div class="errorMsg d-none" id="sv-e1"></div>
                  @if ($errors->has('event_name'))
                      <span class="text-danger">{{ $errors->first('event_name') }}</span>
                  @endif
              </div>
            </div>
          </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Available Rooms<span class="text-red">*</span></label>
                <div class="col-sm-10">
                    <select class="form-control" name="space_name" data-parsley-required data-parsley-errors-container="#space_name_error">
                    <option class="disabled-opt" value="" disabled selected>Select Room</option>
                        @foreach($available_room as $key => $value)
                            <option value="{{ $key }}" {{ ($key == old('space_name')) ? "selected" : "" }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    <div class="errorMsg d-none" id="space_name_error"></div>
                    @if ($errors->has('space_name'))
                        <span class="text-danger">{{ $errors->first('space_name') }}</span>
                    @endif
                </div>
            </div>
        </div>

          <div style="color:#18b9ec;">
            Required Resources<span class="text-red">*</span>
          </div>

            @foreach($required_request as $data)
                <div>
                    <label class="checkbox" for="required_resources_{{$loop->iteration}}">
                        <input type="checkbox" class="form-check-input other-field" name="required_resources[]" value="{{ $data->id }}" data-parsley-required id="required_resources_{{$loop->iteration}}">
                        <span class="checkmark"></span>
                        <span>{{ $data->name }}</span>

                    </label>
                </div>
            @endforeach

              @if ($errors->has('required_resources'))
                  <span class="text-danger">{{ $errors->first('required_resources') }}</span>
              @endif
              <br/>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="other_div" hidden>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Other Required Resources<span class="text-red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="other_required_resource" data-parsley-required value="{{ old('other_required_resource') }}" placeholder="Other Resource.."/>
                    </div>
                </div>
            </div><br/><br/>

          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-4 col-form-label">Start Date<span class="text-red">*</span></label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="start_date" id="startDate" onclick="(this.type='date')" value="{{ old('start_date') ? date('Y-m-d', strtotime(old('start_date'))) : "" }}" data-parsley-required data-parsley-errors-container="#start_date_error" placeholder="dd/mm/yyyy"/>
                <div class="errorMsg d-none" id="start_date_error"></div>
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
                <input type="text" class="form-control" id="endDate" name="end_date" onclick="(this.type='date')" value="{{ old('end_date') ? date('Y-m-d', strtotime(old('end_date'))) : "" }}" data-parsley-required data-parsley-errors-container="#end_date_error" placeholder="dd/mm/yyyy"/>
                <div class="errorMsg d-none" id="end_date_error"></div>
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
{{--                <input type="text" class="form-control" name="start_time" onclick="(this.type='time')" value="{{ old('start_time') ? date('H:i', strtotime(old('start_time'))) : "" }}" data-parsley-required data-parsley-errors-container="#sv-e3" />--}}

                  <select class="form-control" name="start_time" data-parsley-required data-parsley-errors-container="#sv-e3">
                      <option class="disabled-opt" value="" disabled selected>HH:MM</option>
                      @foreach(CommonFunction::getTimeWithSelectionOption() as $index => $time)
                          <option value="{{ $index }}">{{ $time }}</option>
                      @endforeach
                  </select>

                  <div class="errorMsg d-none" id="sv-e3"></div>
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
{{--                <input type="text" class="form-control" name="end_time" onclick="(this.type='time')" value="{{ old('end_time') ? date('H:i', strtotime(old('end_time'))) : "" }}" data-parsley-required data-parsley-errors-container="#sv-e6" />--}}

                  <select class="form-control" name="end_time" data-parsley-required data-parsley-errors-container="#sv-e6">
                      <option class="disabled-opt" value="" disabled selected>HH:MM</option>
                      @foreach(CommonFunction::getTimeWithSelectionOption() as $index => $time)
                          <option value="{{ $index }}">{{ $time }}</option>
                      @endforeach
                  </select>

                  <div class="errorMsg d-none" id="sv-e6"></div>
                  @if ($errors->has('end_time'))
                      <span class="text-danger">{{ $errors->first('end_time') }}</span>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Number of Visitors<span class="text-red">*</span></label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="num_of_attendees" min="1" value="{{ old('num_of_attendees') ?? '1'}}" data-parsley-required data-parsley-errors-container="#sv-e4" />
                <div class="errorMsg d-none" id="sv-e4"></div>
                  @if ($errors->has('num_of_attendees'))
                      <span class="text-danger">{{ $errors->first('num_of_attendees') }}</span>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Visitors Coordinator Contact<span class="text-red">*</span></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="coordinator_contact" value="{{ old('coordinator_contact') }}" data-parsley-required data-parsley-errors-container="#visitor_contact_error" placeholder="Enter Visitor Contact..."/>
                <div class="errorMsg d-none" id="visitor_contact_error"></div>
                  @if ($errors->has('coordinator_contact'))
                      <span class="text-danger">{{ $errors->first('coordinator_contact') }}</span>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Justification<span class="text-red">*</span></label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="justification" maxlength="100" value="{{ old('justification') }}" data-parsley-required data-parsley-errors-container="#justification_error" placeholder="Enter.."></textarea>
                  <div class="errorMsg d-none" id="justification_error"></div>
                  @if ($errors->has('justification'))
                      <span class="text-danger">{{ $errors->first('justification') }}</span>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Additional Information<span class="text-red">*</span></label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="additional_info" maxlength="100" value="{{ old('additional_info') }}" data-parsley-required data-parsley-errors-container="#additional_info_error" placeholder="Enter.."></textarea>
                  <div class="errorMsg d-none" id="additional_info_error"></div>
                  @if ($errors->has('additional_info'))
                      <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end align-items-end">
            <button type="submit" class="btn btn-primary btn-lg" onClick="scheduleVisitValidate()">Submit</button>
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

  var scheduleVisitValidate = () => {
    $('.hostEventForm').parsley().validate();

    if ($('.hostEventForm').parsley().isValid()) {
      $('.formSuccess-modal').modal('show');
    }
  }

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

  $(".other-field").change(function() {
      let other_text = $(this).next().next().text().toLowerCase();
      if(this.checked) {
          if (other_text == "others" || other_text == "other") {
              $('#other_div').removeAttr('hidden');
          }
      }

      if(!this.checked) {
          if (other_text == "others" || other_text == "other") {
              $('#other_div').attr('hidden', true);
              $('#other_required_resource_id').val('');
          }
      }
  });
</script>
@endpush
