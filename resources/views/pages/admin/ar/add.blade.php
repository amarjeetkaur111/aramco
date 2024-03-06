@extends('layouts.admin')
@section('content')
@php
if(old('ar_name')){
$ar_image = old('ar_image');
$start = old('start');
$destination = old('destination');
$ar_name = old('ar_name');
$ar_description = old('ar_description');
$ar_detail_image = old('ar_detail_image');

}
else if(isset($data) && $data){
$ar_image = $data->ar_image_path;
$start = $data->start;
$destination = $data->destination;
$ar_name = $data->name;
$ar_description = $data->description;
$ar_detail_image = $data->description_image_path;

}
else{
$ar_image = null;
$start = null;
$destination = null;
$ar_name = null;
$ar_description = null;
$ar_detail_image = null;

}
@endphp
<style>
.form-control:disabled,
.form-control[readonly] {
    background-color: #ffffff;
}
.br-375{
    border-radius: 0.375rem !important;
}
.multi-input-container .input-group:first-child .btn{
    display:none;
}
.component-card{
    position: relative;
}
.delete-component{
    position: absolute;
    color:#ff0000 !important;
    font-size:22px;
    z-index: 9;
    top: -15px;
    right: -10px;
}

.errorMsg{
    line-height: 0;
  }
  .errorMsg .parsley-errors-list,
  .errorMsg .parsley-required,
  .errorMsg ul{
    margin: 0px;
    padding: 0px;
    color: #F05F41;
    font-size:12px;
    /* line-height: 0rem; */
    font-weight:400;
    list-style: none;
    list-style-type: none;
  }
  .errorMsg ul{
    margin-top: 5px !important;
  }
</style>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $add }} AR Navigation
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <form method="post" action="{{ $action }}" enctype="multipart/form-data" id="form_id" class="aboutLabForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
@csrf

            <!--
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4 component-card" id="cc-01">
                        <div class="card-body">
                            <div class="row g-0 mb-2 pb-2">
                                <label class="col-sm-2 col-form-label">Header Text</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div> -->


            <div class="row" >
                <div class="col-xxl" id="compo-main-container">
                    <!-- component repeater start here -->
                    <div class="card mb-4 component-card">
                        <div class="card-body">


                            <div class="d-flex justify-content-start align-items-center flex-column " style="min-height:220px">


                                @if($add=="Edit")
                                <div class="row g-0 mb-3 w-100 ">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-5">
                                       <img src="{{ $data->ar_image_path}}"  style="width:100%"/>
                                    </div>
                                </div>

                                @endif

                                <div class="comp_elem w-100  only_image ">
                                    <div class="row g-0 mb-3 w-100  ">
                                        <label class="col-sm-2 col-form-label">Change AR Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="ar_image" data-parsley-imagemindimensions="1310x230" data-parsley-imagemaxdimensions="1920x1280"   @if($add=="Add") data-parsley-required data-parsley-max-file-size="1" data-parsley-errors-container="#al-e1" @endif />
                                            <div class="fw-300 fst-italic text-muted text-end" style="font-size:10px;">Image dimensions should be between 1310x230 px and 1920x1280 px </div>
                                            <span class="errorMsg" id="al-e1"></span>
                                        </div>
                                   </div>
                                </div>
                                <div class="comp_elem w-100 text_image ">
                                    <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label"> </label>
                                            <div class="col-sm-10">
                                                {{-- <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="start" value="1" id="defaultCheck3"  />
                                                    <label class="form-check-label" for="defaultCheck3"> Start </label>
                                                  </div> --}}
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="destination" value="1" id="defaultCheck3" @if($destination==1) checked @endif  />
                                                    <label class="form-check-label" for="defaultCheck3"> Is Destination </label>
                                                  </div>
                                                <span class="errorMsg" id="al-e2"></span>
                                            </div>
                                    </div>

                                </div>

                                <div class="comp_elem w-100 image_text ">
                                    <div class="row g-0 mb-3 w-100 ">
                                        <label class="col-sm-2 col-form-label">Name </label>
                                        <div class="col-sm-10">
                                            <input  type="text" class="form-control" name="ar_name" value="{{$ar_name}}" row="3" data-parsley-required data-parsley-errors-container="#al-e3">
                                            <span class="errorMsg" id="al-e3"></span>
                                        </div>
                                    </div>


                                        <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label">Description </label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="ar_description" row="3" data-parsley-required data-parsley-errors-container="#al-e4">{{$ar_description}}</textarea>
                                                <span class="errorMsg" id="al-e4"></span>
                                            </div>
                                        </div>

                                        @if($add=="Edit")
                                        <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-5">
                                               <img src="{{ $data->description_image_path}}"  style="width:100%"/>
                                            </div>
                                        </div>

                                        @endif
                                        <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label">Select Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="ar_detail_image" data-parsley-imagemindimensions="1310x230" data-parsley-imagemaxdimensions="1920x1280"  />
                                                <div class="fw-300 fst-italic text-muted text-end" style="font-size:10px;">Image dimensions should be between 1310x230 px and 1920x1280 px </div>
                                                <span class="errorMsg" id="al-e5"></span>
                                            </div>
                                        </div>
                                </div>


                            </div>

                        </div>
                    </div>


                </div>

                <div class="d-flex align-items-end  justify-content-end mb-3 gap-2">
                    <button type="submit" class="btn btn-green rounded-pill" onClick="aboutLabFormValidate()">Save</button>
                    <a href="{{route('admin-ar-all')}}" class="btn btn-red rounded-pill">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
@push('custom-scripts')
<script src="{{asset('assets/web/js/parsley.min.js')}}"></script>
<script>
// $(function() {
//     $('#form_id').parsley();
// });






// window.Parsley.addValidator('imagemindimensions', {
//     requirementType: 'string',
//     validateString: function (value, requirement, parsleyInstance) {

//         let file = parsleyInstance.$element[0].files[0];
//         let [width, height] = requirement.split('x');
//         let image = new Image();
//         let deferred = $.Deferred();

//         image.src = window.URL.createObjectURL(file);
//         image.onload = function() {
//             if (image.width >= width && image.height >= height) {
//                 deferred.resolve();
//             }
//             else {
//                 deferred.reject();
//             }
//         };

//         return deferred.promise();
//     },
//     messages: {
//         en: 'Image dimensions should be greater than %spx'
//     }
// });

// window.Parsley.addValidator('imagemaxdimensions', {
//     requirementType: 'string',
//     validateString: function (value, requirement, parsleyInstance) {

//         let file = parsleyInstance.$element[0].files[0];
//         let [width, height] = requirement.split('x');
//         let image = new Image();
//         let deferred = $.Deferred();

//         image.src = window.URL.createObjectURL(file);
//         image.onload = function() {
//             if (image.width <= width && image.height <= height) {
//                 deferred.resolve();
//             }
//             else {
//                 deferred.reject();
//             }
//         };

//         return deferred.promise();
//     },
//     messages: {
//         en: 'Image dimensions should be less than  %spx'
//     }
// });

// window.Parsley.addValidator('maxFileSize', {
//     validateString: function(_value, maxSize, parsleyInstance) {
//     if (!window.FormData) {
//         return true;
//     }
//     var files = parsleyInstance.$element[0].files;
//     var fullFilesSize = 0;
//     for (var i = 0; i < files.length; i++) {
//         var file = files[i];
//         fullFilesSize += file.size;
//     }
//     // console.log(fullFilesSize)
//     // return files.length != 1  || files[0].size <= (maxSize * 1024 * 1024);
//     return fullFilesSize <= (maxSize * 1024 * 1024);
//     },
//     requirementType: 'integer',
//     messages: {
//     en: 'Upload should not be larger than %s MB.',
//     // ar: 'Upload should not be larger than %s MB.'
//     }
// });


var aboutLabFormValidate = () => {
    $('.aboutLabForm').parsley().validate();
    if($('.aboutLabForm').parsley().isValid()){
        return true;
    }else{
        return false;
    }
}
</script>
@endpush
