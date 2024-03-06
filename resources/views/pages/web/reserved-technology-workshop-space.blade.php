@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />

    <div class="container">
      <div class="row justify-content-between align-items-center my-3">
        <div class="col-12 d-flex justify-content-start align-items-center">
          <nav class="aram-breadcrumb">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{route('my-activity')}}">My Activity</a></li>
                <li class="breadcrumb-item active">My Reserved Technology Workshop Space</li>
              </ol>
          </nav>
        </div>
      </div>
    </div>

    <div class="container min-vh-70">

      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading my-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-technology-workshop-blue.svg')}}" class="img-fluid" /></div><div class="stext">Reserve Technology Workshop Space</div>
          </div>
          <p class="pagesubheading mb-2">Please Edit the form below</p>

          <form class="reservedTechnologyWorkshopSpaceForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
            <div class="row mt-5 font-1-5rem">

              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Workshop Name </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e"></div>
                  </div>
                </div>
              </div> 
            </div> 
            <div class="row font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Start Date </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" onclick="(this.type='date')"/>
                    <div class="errorMsg d-none" id="he-e1"></div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">End Date </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" onclick="(this.type='date')"/>
                    <div class="errorMsg d-none" id="he-e2"></div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Start Time </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" onclick="(this.type='time')"/>
                    <div class="errorMsg d-none" id="he-e3"></div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">End Time </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" onclick="(this.type='time')"/>
                    <div class="errorMsg d-none" id="he-e4"></div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Number of People </label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" min="0" value="0"/>
                    <div class="errorMsg d-none" id="he-e5"></div>
                  </div>
                </div>
              </div> 
            </div> 
            <div class="row mb-4 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Point of Contact </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e6"></div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Justification <span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" data-parsley-required data-parsley-errors-container="#he-e8"></textarea>
                    <div class="errorMsg d-none" id="he-e8"></div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Additional Information <span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" data-parsley-required data-parsley-errors-container="#he-e9"></textarea>
                    <div class="errorMsg d-none" id="he-e9"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end align-items-end">
                <button type="button" class="btn btn-primary" onClick="reservedTechnologyWorkshopSpaceValidate()">Save Changes</button>
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
        <p>Details saved successfully</p>
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

        if($('.reservedTechnologyWorkshopSpaceForm').parsley().isValid()){
          $('.formSuccess-modal').modal('show');
        }
       }

    </script>
@endpush