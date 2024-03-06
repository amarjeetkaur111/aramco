@extends('layouts.admin')
@section('content')
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
                                        Event Request View
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @include('includes.admin.message')
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-end">
                            <h4 class="mb-0 me-auto {{ CommonFunction::statusWiseTextColor($data->status_of_request) }}">{{ $data->status_of_request }}</h4>
                            <button data-href="#" class="btn rounded-pill btn-info me-2 edit-data"><i class="fa fa-edit"></i> Edit</button>
                            <button data-href="{{ route('admin-service-incubator-request-change-status', ['id' => $data->id]) }}" class="btn rounded-pill btn-primary float-right status-change">Change status</button>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin-service-incubator-request-store') }}" enctype="multipart/form-data" id="form_id">
                                @csrf

                                <input type="hidden" name="incubator_id" value="{{ $data->id }}">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="event_name_id">Usecase Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="usecase_name" value="{{ $data->usecase_name ?? '' }}" type="text" class="form-control"
                                                   id="event_name_id" placeholder="Event Name Here" data-parsley-errors-container="#event_name_error"
                                                   required/>
                                        </div>
                                        <span class="text-danger" id="event_name_error"></span>
                                        @if ($errors->has('usecase_name'))
                                            <span class="text-danger">{{ $errors->first('usecase_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                               

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="start_date_id">Start Date</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="start_date" value="{{ $data->start_date ?? "" }}" type="datetime-local" class="form-control"
                                                   data-parsley-errors-container="#start_date_error" required/>
                                        </div>
                                        <span class="text-danger" id="start_date_error"></span>
                                        @if ($errors->has('start_date'))
                                            <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="end_date_id">End Date</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="end_date" value="{{ $data->end_date ?? '' }}" type="datetime-local" class="form-control"
                                                   data-parsley-errors-container="#end_date_error" required/>
                                        </div>
                                        <span class="text-danger" id="end_date_error"></span>
                                        @if ($errors->has('end_date'))
                                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="coordinator_contact_id">Contact of Usecase</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="contact_of_usecase" value="{{ $data->contact_of_usecase ?? '' }}" type="text" class="form-control" id="coordinator_contact_id"
                                                   data-parsley-errors-container="#coordinator_contact_error" required/>
                                        </div>
                                        <span class="text-danger" id="coordinator_contact_error"></span>
                                        @if ($errors->has('contact_of_usecase'))
                                            <span class="text-danger">{{ $errors->first('contact_of_usecase') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="num_of_attendees_id">No. Of Employees</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="num_of_employees" value="{{ $data->num_of_employees ?? '' }}" type="number" class="form-control" id="num_of_attendees_id"
                                                   data-parsley-errors-container="#num_of_attendees_error" required/>
                                        </div>
                                        <span class="text-danger" id="num_of_attendees_error"></span>
                                        @if ($errors->has('num_of_employees'))
                                            <span class="text-danger">{{ $errors->first('num_of_employees') }}</span>
                                        @endif
                                    </div>
                                </div>

                               

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="justification_id">Justification</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="justification" value="{{ $data->justification ?? "" }}" type="text" class="form-control" data-parsley-errors-container="#justification_error" required/>
                                        </div>
                                        <span class="text-danger" id="justification_error"></span>
                                        @if ($errors->has('justification'))
                                            <span class="text-danger">{{ $errors->first('justification') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="additional_info_id">Additional Information</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="additional_info" value="{{ $data->additional_info ?? "" }}" type="text" class="form-control" data-parsley-errors-container="#additional_info_error" required/>
                                        </div>
                                        <span class="text-danger" id="additional_info_error"></span>
                                        @if ($errors->has('additional_info'))
                                            <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <a href="{{ route('admin-service-incubator-request-index') }}" class="btn rounded-pill btn-danger">Back</a>
                                        <button type="submit" class="btn rounded-pill btn-primary" id="update_data">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('custom-scripts')
    <script src="{{asset('assets/web/js/parsley.min.js')}}"></script>

    <script>
        $('body').on('click', '.status-change', function() {
            $href = $(this).attr('data-href');
            $.confirm({
                title: 'Change User Status',
                content: 'url:' + $href,
                columnClass: 'medium',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function() {
                            $('#from-assign').submit()
                        }
                    },
                    cancel: function() {
                        //close
                    },
                },
            });
        });

        $(function() {
            $('input[type="text"], input[type="datetime-local"], input[type="number"]').prop("readonly",true);
            $('input[type="checkbox"]').prop('disabled', true);
            $('#update_data').hide();

            $('#form_id').parsley();
            $(".other-field").trigger('change');
        });

        $('.edit-data').on('click', function (){
            $('input[type="text"], input[type="datetime-local"], input[type="number"], input[type="checkbox"]').prop("readonly", false);
            $('input[type="checkbox"]').prop('disabled', false);
            $('#update_data').show();
        });

        $(".other-field").change(function() {
            if(this.checked) {
                if (($(this).next().text() == "Others" || $(this).next().text() == "others" || $(this).next().text() == "other")) {
                    $('#other_div').removeAttr('hidden');
                }
            }

            if(!this.checked) {
                if (($(this).next().text() == "Others" || $(this).next().text() == "others" || $(this).next().text() == "other")) {
                    $('#other_div').attr('hidden', true);
                    $('#other_required_resource_id').val('');
                }
            }
        });

    </script>
@endpush
