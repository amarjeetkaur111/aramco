@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-3 ">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
           <a href="{{route('my-activity')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>My Activity <span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span> Host an Event</a>
        </div>
      </div>

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading mb-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/host-an-event-blue.svg')}}" class="img-fluid" /></div><div class="stext">Host an Event</div>
          </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            @if(Session::has('msg'))
                <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                    {{ Session::get('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <div>Please edit the form below</div>
        <form class="hostedEventForm" action="{{ route('services-my-hosted-events-edit-post') }}" method="POST"  data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
          @csrf
              <input type="hidden" name="event_id" value="{{ $getHostedEvent->id }}">
              <input type="hidden" name="id" value="{{ $getHostedEvent->id }}">
              <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">

          <div class="row mt-5 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Event Name<span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="event_name" @if($showMode) disabled @endif class="form-control" value="{{ $getHostedEvent->event_name ?? "" }}" data-parsley-required data-parsley-errors-container="#he-e1"/>
                    <div class="errorMsg d-none" id="he-e"></div>
                      @if ($errors->has('event_name'))
                          <span class="text-danger">{{ $errors->first('event_name') }}</span>
                      @endif
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="row mb-5">
                      <label class="col-sm-4 col-form-label">Available Rooms<span class="text-red">*</span></label>
                      <div class="col-sm-8">
                      <select name="space_name" @if($showMode) disabled @endif class="form-control" data-parsley-required data-parsley-errors-container="#he-e2">
                          <option></option>
                          @foreach($available_room as $key => $value)
                              <option value="{{ $key }}" {{ ($key == $getHostedEvent->space_name) ? 'selected' : "" }}>{{ $value }}</option>
                          @endforeach
                      </select>
                          <div class="errorMsg d-none" id="he-e2"></div>
                          @if ($errors->has('space_name'))
                              <span class="text-danger">{{ $errors->first('space_name') }}</span>
                          @endif
                      </div>
                  </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-12 col-form-label text-blue">Required Resources<span class="text-red">*</span> </label>
                  <div class="col-sm-12">

                    @php $r_r = $getHostedEvent->required_resources_list; @endphp
                      @foreach($required_request as $data)
                          <div class="form-check">
                              <label class="checkbox" for="required_resources_{{$loop->iteration}}">
                                  <input type="checkbox" class="form-check-input other-field"
                                         name="required_resources[]" value="{{ $data->id }}"
                                         id="required_resources_{{$loop->iteration}}" @if($showMode) disabled @endif
                                      @foreach($getHostedEvent->required_resources_list as $rr)
                                      {{($rr->id == $data->id) ? 'checked' : ''}}
                                      @endforeach

                                  />
                                  <span class="checkmark"></span>
                                  <span>{{ $data->name }}</span>

                              </label>
                          </div>
                      @endforeach
                    <div class="errorMsg d-none" id="he-e0"></div>
                      @if ($errors->has('required_resources'))
                          <span class="text-danger">{{ $errors->first('required_resources') }}</span>
                      @endif
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="other_div" @if($r_r->contains('id',6)) @else hidden @endif>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Other Required Resources<span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" @if($showMode) disabled @endif class="form-control" name="other_required_resource" value="{{$getHostedEvent->other_required_resource}}" data-parsley-required data-parsley-errors-container="#he-e" />
                                <div class="errorMsg d-none" id="he-e"></div>
                            </div>
                        </div>
                        @if ($errors->has('other_required_resource'))
                            <span class="text-danger">{{ $errors->first('other_required_resource') }}</span>
                        @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Start Date<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="date" @if($showMode) disabled @endif name="start_date" value="{{ date('Y-m-d', strtotime($getHostedEvent->start_date)) }}" class="form-control" onclick="(this.type='date')" data-parsley-required data-parsley-errors-container="#he-e3"/>
                    <div class="errorMsg d-none" id="he-e3"></div>
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
                    <input type="date" name="end_date" @if($showMode) disabled @endif value="{{ date('Y-m-d', strtotime($getHostedEvent->end_date)) }}" class="form-control" onclick="(this.type='date')" data-parsley-required data-parsley-errors-container="#he-e4"/>
                    <div class="errorMsg d-none" id="he-e4"></div>
                      @if ($errors->has('end_date'))
                          <span class="text-danger">{{ $errors->first('end_date') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Start Time<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="time" @if($showMode) disabled @endif name="start_time" class="form-control" onclick="(this.type='time')" value="{{ date('H:i', strtotime($getHostedEvent->start_date)) }}" data-parsley-required data-parsley-errors-container="#he-e5"/>
                    <div class="errorMsg d-none" id="he-e5"></div>
                      @if ($errors->has('start_time'))
                          <span class="text-danger">{{ $errors->first('start_time') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">End Time<span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="time"  name="end_time" @if($showMode) disabled @endif class="form-control" onclick="(this.type='time')" value="{{ date('H:i', strtotime($getHostedEvent->end_date)) }}" data-parsley-required data-parsley-errors-container="#he-e6"/>
                    <div class="errorMsg d-none" id="he-e6"></div>
                      @if ($errors->has('end_time'))
                          <span class="text-danger">{{ $errors->first('end_time') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Number of Visitors<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="number" name="num_of_attendees" @if($showMode) disabled @endif class="form-control" min="0" value="{{ $getHostedEvent->num_of_attendees ?? "" }}" data-parsley-required data-parsley-errors-container="#he-e7"/>
                    <div class="errorMsg d-none" id="he-e7"></div>
                      @if ($errors->has('num_of_attendees'))
                          <span class="text-danger">{{ $errors->first('num_of_attendees') }}</span>
                      @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-4 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Coordinator Contact<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="text" name="coordinator_contact" @if($showMode) disabled @endif class="form-control" value="{{ $getHostedEvent->coordinator_contact ?? "" }}" data-parsley-required data-parsley-errors-container="#he-e8"/>
                    <div class="errorMsg d-none" id="he-e8"></div>
                      @if ($errors->has('coordinator_contact'))
                          <span class="text-danger">{{ $errors->first('coordinator_contact') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">No.of employees working on use case<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" min="0" value="0"/>
                    <div class="errorMsg d-none" id="he-e7"></div>
                  </div>
                </div> -->
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-2 col-form-label">Justification<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control textarea-toggle" @if($showMode) disabled @endif rows="3" name="justification" data-parsley-required data-parsley-errors-container="#he-e9">{{ $getHostedEvent->justification ?? "" }}</textarea>
                    <div class="errorMsg d-none" id="he-e9"></div>
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
                    <textarea class="form-control textarea-toggle" @if($showMode) disabled @endif rows="3" name="additional_info" data-parsley-required data-parsley-errors-container="#he-e10">{{ $getHostedEvent->additional_info ?? "" }}</textarea>
                    <div class="errorMsg d-none" id="he-e10"></div>
                      @if ($errors->has('additional_info'))
                          <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              @if(!$showMode)
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <div class="col-sm-10 offset-sm-2">
                  <button type="submit" class="btn btn-primary rounded-4 py-1" onClick="hostedEventsValidate()">Save Changes</button>
                  </div>
                </div>
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

      var hostedEventsValidate = () => {
        $('.hostedEventForm').parsley().validate();
        // if($('.hostedEventForm').parsley().isValid()){
        //   $('.formSuccess-modal').modal('show');
        // }else{
        //   return false;
        // }
       }

       $(".other-field").change(function() {
           // let other_text = $(this).next().next().text().toLowerCase();
           let other_text = $(this).val();
           if(this.checked) {
               if (other_text == "6" || other_text == 6) {
                   $('#other_div').removeAttr('hidden');
               }
           }
           if(!this.checked) {
               if (other_text == "6" || other_text == 6) {
                   $('#other_div').attr('hidden', true);
                   $('#other_required_resource_id').val('');
               }
           }
       });


    </script>
@endpush
