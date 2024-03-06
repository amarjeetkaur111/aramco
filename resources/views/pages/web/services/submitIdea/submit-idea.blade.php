@extends('layouts.web')
@section('content')

<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<div class="container min-vh-70">

  <div class="row gutters">
  @include('pages.web.services.common-service')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
      <div class="pageheading my-3">
        <div class="sicon"><img src="{{asset('assets/web/images/icons/24/bulb.svg')}}" class="img-fluid" /></div>
        <div class="stext">Submit an Idea</div>
      </div>
      <div class="col-sm-12">
            @if(\Illuminate\Support\Facades\Session::has('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ \Illuminate\Support\Facades\Session::get('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
      <p class="pagesubheading mb-2">To submit an idea please fill the data form below</p>

      <form class="submitIdeaForm" method="post" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled]" action="{{ route('services-submit-idea-store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_google_id" value="{{auth()->user()->google_id}}">
            <div class="row mt-5 font-1-5rem">

              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                <!-- <label class="col-sm-4 col-form-label">Select Track / Channel<span class="text-red">*</span></label> -->
                  <label class="col-sm-4 col-form-label">Track / Channel<span class="text-red">*</span></label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="track_channel" data-parsley-required data-parsley-errors-container="#sv-e1" placeholder="Enter.."/>
                    <div class="errorMsg d-none" id="sv-e1"></div>
                    @if ($errors->has('track_channel'))
                      <span class="text-danger">{{ $errors->first('track_channel') }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="row font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Idea Name<span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="idea_name" data-parsley-required data-parsley-errors-container="#sv-e2" placeholder="Enter Idea name.."/>
                    <div class="errorMsg d-none" id="sv-e2"></div>
                    @if ($errors->has('idea_name'))
                      <span class="text-danger">{{ $errors->first('idea_name') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Contributor<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="contributors" data-parsley-required data-parsley-errors-container="#sv-e3" placeholder="Enter Contributor.."/>
                    <div class="errorMsg d-none" id="sv-e3"></div>
                    @if ($errors->has('contributors'))
                      <span class="text-danger">{{ $errors->first('contributors') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Idea Problem<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" rows="5" name="idea_problem" data-parsley-required data-parsley-errors-container="#sv-e4" placeholder="Enter.."></textarea>
                    <div class="errorMsg d-none" id="sv-e4"></div>
                    @if ($errors->has('idea_problem'))
                      <span class="text-danger">{{ $errors->first('idea_problem') }}</span>
                    @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Idea Solution<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="idea_solution" rows="5" data-parsley-required data-parsley-errors-container="#sv-e5" placeholder="Enter.."></textarea>
                    <div class="errorMsg d-none" id="sv-e5"></div>
                    @if ($errors->has('idea_solution'))
                      <span class="text-danger">{{ $errors->first('idea_solution') }}</span>
                    @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Idea Resource Requirement<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="idea_resource_requirement" data-parsley-required data-parsley-errors-container="#sv-e6" placeholder="Enter Resource Requirement.."/>
                    <div class="errorMsg d-none" id="sv-e6"></div>
                    @if ($errors->has('idea_resource_requirement'))
                      <span class="text-danger">{{ $errors->first('idea_resource_requirement') }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-4 font-1-5rem">
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Point of Contact<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="point_of_contact" data-parsley-required data-parsley-errors-container="#sv-e7" placeholder="Enter your point of contact"/>
                    <div class="errorMsg d-none" id="sv-e7"></div>
                    @if ($errors->has('point_of_contact'))
                      <span class="text-danger">{{ $errors->first('point_of_contact') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Technology<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <select class="form-control" name="technology" id="technologyList" data-parsley-required data-parsley-errors-container="#sv-e8">
                      <option value="">Select</option>
                      @foreach($required_request as $key)
                      <option value="{{$key->id}}">{{$key->name}}</option>
                      @endforeach
                    </select>
                    <!-- <input type="text" class="form-control" name="technology" data-parsley-required data-parsley-errors-container="#sv-e8"/> -->
                    <div class="errorMsg d-none" id="sv-e8"></div>
                    @if ($errors->has('technology'))
                      <span class="text-danger">{{ $errors->first('technology') }}</span>
                    @endif
                  </div>
                </div>
                <div class="row mb-0" id="otherDiv" style="display: none;">
                  <label class="col-sm-2 col-form-label">Other Technology<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="other_technology" id="other_technology_id"/>
                    <div class="errorMsg d-none" id=""></div>

                  </div>
                </div><br/>
                <div class="row mb-0">
                  <label class="col-sm-2 col-form-label">Current Implementation level<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                      <select class="form-control" name="current_implementation_level" id="" data-parsley-required data-parsley-errors-container="#sv-e9">
                        <option value="">Select</option>
                        @foreach($implementation_request as $key2)
                        <option value="{{$key2->id}}">{{$key2->name}}</option>
                        @endforeach
                    </select>
                    <!-- <input type="text" class="form-control" name="current_implementation_level" data-parsley-required data-parsley-errors-container="#sv-e9"/> -->
                    <div class="errorMsg d-none" id="sv-e9"></div>
                    @if ($errors->has('current_implementation_level'))
                      <span class="text-danger">{{ $errors->first('current_implementation_level') }}</span>
                    @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-4">
                      <div class="fileInput-customIcon">
                        <div class="form-fileInput">
                          <label>View Attach Files ( 10 MB max )<span class="text-red">*</span></label>
                          <textarea class="form-control" readonly placeholder="click to add files" rows="1"></textarea>
                        </div>
                        <input class="form-control fileInput-control" name="attachment" type="file" data-parsley-required data-parsley-max-file-size="10" data-parsley-errors-container="#sv-e10">
                        <div class="errorMsg d-none" id="sv-e10"></div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end align-items-end">
                <button type="submit" class="btn btn-primary btn-lg" onClick="submitAnIdeaValidate()">Submit</button>
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

  var submitAnIdeaValidate = () => {
    $('.submitIdeaForm').parsley().validate();

    if ($('.submitIdeaForm').parsley().isValid()) {
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

  $('#technologyList').on('change', function () {
      var val = $("#technologyList option:selected").text();
      if (val == 'Other') {
          $('#otherDiv').show()
          $('#other_technology_id').attr('data-parsley-required', true);

      } else {
          $('#otherDiv').hide()
          $('#other_technology_id').removeAttr('data-parsley-required');
      }
  })
</script>
@endpush
