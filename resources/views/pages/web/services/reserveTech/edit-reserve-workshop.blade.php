@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-5 mb-4">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
        <a href="{{route('my-activity')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>My Activity <span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span> My Reserved Technology Workshop Space</a>
        </div>
      </div>

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading mb-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-incubator-blue.svg')}}" class="img-fluid" /></div><div class="stext">Reserve Technology Workshop Space</div>
          </div>
        </div>
        <div>Please edit the form below</div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form class="reservedTechnologyWorkshopSpaceForm" action="{{route('services-my-reserve-tech-events-edit-post')}}" method="post" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
            @csrf
            <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">
              <input type="hidden" name="technology_workshop_id" value="{{ $resrveTech->id }}">
              <input type="hidden" name="id" value="{{ $resrveTech->id }}">
          <div class="row mt-5 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Workshop Name <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="workshop_name" @if($showMode) disabled @endif value="{{$resrveTech->workshop_name}}" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e"></div>
                      @if ($errors->has('workshop_name'))
                          <span class="text-danger">{{ $errors->first('workshop_name') }}</span>
                      @endif
                  </div>
                </div>
              </div>


                      @role('Admin|Super Admin')
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="row mb-3">
                              <label class="col-sm-4 col-form-label">Available Rooms <span class="text-red">*</span></label>
                              <div class="col-sm-8">
                                  <select @if($showMode) disabled @endif name="space_name" class="form-control">
                                  <option></option>
                                  @foreach($available_room as $key => $value)
                                      <option value="{{ $key }}" {{ ($key == $getAllocatedRequest->space_name) ? 'selected' : "" }}>{{ $value }}</option>
                                  @endforeach
                                  </select>
                                  <div class="errorMsg d-none" id="he-e"></div>
                                  @if ($errors->has('space_name'))
                                      <span class="text-danger">{{ $errors->first('space_name') }}</span>
                                  @endif
                              </div>
                          </div>
                      </div>
                        @endrole
            </div>
            <div class="row font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Start Date <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                  <input type="date" name="start_date" @if($showMode) disabled @endif value="{{ date('Y-m-d', strtotime($resrveTech->start_date)) }}" class="form-control" onclick="(this.type='date')"/>
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
                  <input type="date" name="end_date" @if($showMode) disabled @endif value="{{ date('Y-m-d', strtotime($resrveTech->end_date)) }}" class="form-control" onclick="(this.type='date')"/>
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
                    <input type="time" name="start_time" @if($showMode) disabled @endif class="form-control" value="{{ date('H:i', strtotime($resrveTech->start_date)) }}" onclick="(this.type='time')"/>
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
                    <input type="time" name="end_time" @if($showMode) disabled @endif value="{{ date('H:i', strtotime($resrveTech->end_date)) }}" class="form-control" onclick="(this.type='time')"/>
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
                    <input type="number" name="num_of_people" @if($showMode) disabled @endif  class="form-control" min="0" value="{{$resrveTech->num_of_people}}"/>
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
                    <input type="text" name="point_of_contact" @if($showMode) disabled @endif class="form-control" value="{{$resrveTech->point_of_contact}}"/>
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
                    <textarea class="form-control textarea-toggle" @if($showMode) disabled @endif name="justification" rows="3" data-parsley-required data-parsley-errors-container="#he-e8">{{$resrveTech->justification}}</textarea>
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
                    <textarea class="form-control textarea-toggle" @if($showMode) disabled @endif name="additional_info" rows="3" data-parsley-required data-parsley-errors-container="#he-e9">{{$resrveTech->additional_info}}</textarea>
                    <div class="errorMsg d-none" id="he-e9"></div>
                      @if ($errors->has('additional_info'))
                          <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              @if(!$showMode)
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-end gap-3 mt-3">
                <label class="col-sm-2 hidden-xs col-form-label"></label>
                <button type="submit" class="btn btn-primary rounded-4 py-1" onClick="reservedTechnologyWorkshopSpaceValidate()">Save Changes</button>
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
        <p class="fs-5">Activity request submitted successfully</p>
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

       var reservedTechnologyWorkshopSpaceValidate = () => {
        $('.reservedTechnologyWorkshopSpaceForm').parsley().validate();
        // if($('.reservedTechnologyWorkshopSpaceForm').parsley().isValid()){
        //   $('.formSuccess-modal').modal('show');
        // }
       }

    </script>
@endpush
