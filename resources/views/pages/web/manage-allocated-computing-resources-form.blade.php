@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-3 ">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
          <a href="{{route('manage-allocated-computing-resources')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
        </div>
      </div>

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">          
          <div class="pageheading mb-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/allocate-computing-resources-blue.svg')}}" class="img-fluid" /></div><div class="stext">Allocate Computing Resources</div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border-bottom pt-3 pb-4 mb-3">
          <div class="user-list">
            <span class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/user-profile-white.svg')}}" class="img-fluid" /></span>
            <div class="w-100">
              <div class="user-details fs-4" style="color: #323232;">User Profile 1</div>
              <div class="user-details" style="color: #5F6369;">user23@gmail.com</div>
            </div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

              <div class="infoDesc mt-0 text-warning"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning-yellow.svg')}}" class="img-fluid" /></span>Status : Pending</div>

          <form class="allocatedComputingResourcesForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
            <div class="row mt-5 font-1-5rem">

              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Name of the use case </label>
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
                  <label class="col-sm-4 col-form-label">Main contact of the usecase </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" />
                    <div class="errorMsg d-none" id="he-e5"></div>
                  </div>
                </div>
              </div> 
            </div> 
            <div class="row mb-4 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">No.of employees working on use case </label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" min="0" value="0"/>
                    <div class="errorMsg d-none" id="he-e7"></div>
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
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end align-items-end gap-3 mt-3">
                <label class="col-sm-2 hidden-xs col-form-label"></label>
                <button type="button" class="btn btn-success rounded-4 py-1" onClick="allocatedComputingResourcesValidate()">Accept</button>
                <button type="button" class="btn btn-primary rounded-4 py-1" onClick="allocatedComputingResourcesModifyValidate()">Modify</button>
                <button type="button" class="btn btn-danger rounded-4 py-1" onClick="checkfeedbackValidate()">Reject</button>
              </div> 

            </div>
          
          <div class="checkfeedbackForm d-none" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
            <div class="row font-1-5rem">
              <div class="col-sm-10 col-12 offset-sm-2 border-top mt-3 mb-5 pt-3">
                <div class="form-floating mb-2 position-relative">
                  <textarea class="form-control comments" rows="3" maxlength="100" placeholder="Enter Feedback.." data-parsley-required data-parsley-minlength="20" data-parsley-errors-container="#fb-e1"></textarea>
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

       var allocatedComputingResourcesValidate = () => {

        $('.checkfeedbackForm').addClass('d-none');
        $('.allocatedComputingResourcesForm').parsley().validate();

        if($('.allocatedComputingResourcesForm').parsley().isValid()){
          $('.formSuccess-modal').modal('show');
        }
       }
       var allocatedComputingResourcesModifyValidate = () => {

        $('.checkfeedbackForm').removeClass('d-none');        
        $('.allocatedComputingResourcesForm').parsley().validate();
        $('.checkfeedbackForm').parsley().validate();

        if( $('.allocatedComputingResourcesForm').parsley().isValid() && $('.checkfeedbackForm').parsley().isValid() ){
          $('.formSuccess-modal').modal('show');
        }
       }

       var checkfeedbackValidate = () => {

        $('.checkfeedbackForm').removeClass('d-none');   
        $('.checkfeedbackForm').parsley().validate();

        if($('.checkfeedbackForm').parsley().isValid()){
          $('.formSuccess-modal').modal('show');
        }
       }

       



       $('.comments').on("input", function() {
        var currentLength = $(this).val().length;
        $(this).parent().find('.taCountContainer').find('.taCount').html(currentLength);
      });
    </script>
@endpush