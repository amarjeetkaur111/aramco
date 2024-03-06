@extends('layouts.web')
@section('content')
    <link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

        <div class="row justify-content-between align-items-center mt-3 ">
            <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
                <a href="{{ route('calender-calendar') }}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
            </div>
        </div>

        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="pageheading mb-3">
                    <div class="sicon"><img src="{{asset('assets/web/images/icons/24/menu-board.svg')}}" class="img-fluid" /></div>
                    <div class="stext">Edit Event</div>
                </div>
            </div>


            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                @if(Session::has('msg'))
                    <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                        {{ Session::get('msg') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div>Please fill the form below</div>
                <form class="eventForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled]" action="{{ route('calender-admin-update-event') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">
                    <input type="hidden" name="event_id" value="{{ $getEvent->id }}">
                    <div class="row mt-5 font-1-5rem">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="row mb-5">
                                <label class="col-sm-4 col-form-label">Event Name<span class="text-red">*</span> </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" data-parsley-required data-parsley-errors-container="#he-e" name="title" value="{{ $getEvent->title ?? '' }}" />
                                    <div class="errorMsg d-none" id="he-e"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row font-1-5rem">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="row mb-5">
                                <label class="col-sm-4 col-form-label">Start Date<span class="text-red">*</span> </label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" data-parsley-required data-parsley-errors-container="#he-e1" name="start_date" value="{{ date('Y-m-d', strtotime($getEvent->start_date)) }}" />
                                    <div class="errorMsg d-none" id="he-e1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="row mb-5">
                                <label class="col-sm-4 col-form-label">End Date<span class="text-red">*</span> </label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" data-parsley-required data-parsley-errors-container="#he-e2" name="end_date" value="{{ date('Y-m-d', strtotime($getEvent->end_date)) }}"/>
                                    <div class="errorMsg d-none" id="he-e2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="row mb-5">
                                <label class="col-sm-4 col-form-label">Start Time<span class="text-red">*</span> </label>
                                <div class="col-sm-8">
                                    <input type="time" class="form-control" data-parsley-required data-parsley-errors-container="#he-e3" name="start_time" value="{{ date('H:i', strtotime($getEvent->start_date)) }}"/>
                                    <div class="errorMsg d-none" id="he-e3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="row mb-5">
                                <label class="col-sm-4 col-form-label">End Time<span class="text-red">*</span> </label>
                                <div class="col-sm-8">
                                    <input type="time" class="form-control" data-parsley-required data-parsley-errors-container="#he-e4" name="end_time" value="{{ date('H:i', strtotime($getEvent->end_date)) }}"/>
                                    <div class="errorMsg d-none" id="he-e4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row mb-5">
                                <label class="col-md-2 col col-sm-4 -form-label">Event Description<span class="text-red">*</span> </label>
                                <div class="col-md-10 col-sm-8">
                                    <textarea class="form-control" rows="3" data-parsley-required data-parsley-errors-container="#he-e5" name="description">{{ $getEvent->description ?? "" }}</textarea>
                                    <div class="errorMsg d-none" id="he-e95"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4 font-1-5rem">

                        <div class="offset-md-2 offset-sm-4 offset-0 col-md-10 col-sm-8 col-12 d-flex justify-content-between">
                            <div>
                                <div class="" style="border: 2px dashed #c0c0c0;border-radius:15px;cursor:pointer;">
                                    <div class=" upload-cal-button">
                                        @if(!empty($getEvent->calendar_image))
                                            <img src="{{ $getEvent->calendar_image ?? "" }}" class="preview-cal-pic img-fluid" />
                                        @else
                                        <img src="{{asset('assets/web/images/icons/24/upload_image.svg')}}" class="preview-cal-pic img-fluid" />
                                        @endif
                                    </div>
                                    <input class="img-cal-upload" name="calendar_image" type="file" accept=".png, .jpg, .jpeg" {{ (empty($getEvent->calendar_image) ? "data-parsley-required" : "") }} data-parsley-max-file-size="10" data-parsley-errors-container="#he-e6"  />
                                    <div class="errorMsg d-none" id="he-e6"></div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row mb-5">
                                <label class="col-md-2 col col-sm-4 -form-label"></label>
                                <div class="col-md-10 col-sm-8 mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary rounded-4 py-1" onClick="eventFormValidate()">Update</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal formSuccess-modal" data-bs-backdrop="stmodalatic" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered -sm modal-dialog-centered">
            <div class="modal-content rounded-5">
                <div class="modal-header px-5 py-4 border-success" style="border-width:0.15rem;">
                    <h4 class="modal-title fs-4 d-flex align-items-center"><i class="fa-solid fa-circle-check text-success me-2" style="font-size:2rem;"></i> Success</h4>
                </div>
                <div class="modal-body px-5 py-4">
                    <p class="fs-5">Event submitted successfully</p>
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

        // var eventFormValidate = () => {
        //
        //     $('.eventForm').parsley().validate();
        //
        //     if ($('.eventForm').parsley().isValid()) {
        //         $('.formSuccess-modal').modal('show');
        //     }
        // }
        // var loadFile = function(event) {
        //     var image = document.getElementById('output');
        //     image.src = URL.createObjectURL(event.target.files[0]);
        // };

        window.Parsley.addValidator('maxFileSize', {
            validateString: function(_value, maxSize, parsleyInstance) {
                if (!window.FormData) {
                    return true;
                }
                var files = parsleyInstance.$element[0].files;
                var fullFilesSize = 0;
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    fullFilesSize += file.size;
                }
                console.log(fullFilesSize)
                // return files.length != 1  || files[0].size <= (maxSize * 1024 * 1024);
                return fullFilesSize <= (maxSize * 1024 * 1024);
            },
            requirementType: 'integer',
            messages: {
                en: 'Upload should not be larger than %s MB.',
                ar: 'Upload should not be larger than %s MB.'
            }
        });
        var readCalURL = (input) => {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {

                    $('.preview-cal-pic').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('body').on("change", ".img-cal-upload", function() {
            readCalURL(this);
        });

        $('body').on("click", ".upload-cal-button", function() {
            $(".img-cal-upload").click();
        });
    </script>
@endpush
