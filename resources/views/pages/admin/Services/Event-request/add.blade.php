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
                                        Event Request Add
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
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <!-- <h5 class="mb-0">Add User</h5> -->
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin-service-event-request-store') }}" enctype="multipart/form-data" id="form_id">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="event_name_id">Event Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="event_name" value="{{ old('event_name') }}" type="text" class="form-control"
                                                   id="event_name_id" placeholder="Event Name Here" data-parsley-errors-container="#event_name_error"
                                                   required/>
                                        </div>
                                        <span class="text-danger" id="event_name_error"></span>
                                        @if ($errors->has('event_name'))
                                            <span class="text-danger">{{ $errors->first('event_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="space_name_id">Space Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="space_name" value="{{ old('space_name') }}" type="text" class="form-control" id="space_name_id"
                                                   data-parsley-errors-container="#space_name_error"
                                                   required/>
                                        </div>
                                        <span class="text-danger" id="space_name_error"></span>
                                        @if ($errors->has('space_name'))
                                            <span class="text-danger">{{ $errors->first('space_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="space_name_id">Required Resources</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            @foreach($required_request as $data)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input other-field" type="checkbox" name="required_resources[]" id="required_resources_{{$loop->iteration}}" value="{{ $data->id }}">
                                                    <label class="form-check-label" for="required_resources_{{$loop->iteration}}">{{ $data->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3" id="other_div" hidden>
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="other_required_resource" value="{{ old('other_required_resource') }}" type="text" class="form-control"
                                                   placeholder="Other Required Resources Here" id="other_required_resource_id"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="start_date_id">Start Date</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="start_date" value="{{ old('start_date') }}" type="datetime-local" class="form-control"
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
                                            <input name="end_date" value="{{ old('end_date') }}" type="datetime-local" class="form-control"
                                                   data-parsley-errors-container="#end_date_error" required/>
                                        </div>
                                        <span class="text-danger" id="end_date_error"></span>
                                        @if ($errors->has('end_date'))
                                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="num_of_attendees_id">Attendees No.</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="num_of_attendees" value="{{ old('num_of_attendees') }}" type="number" class="form-control" id="num_of_attendees_id"
                                                   data-parsley-errors-container="#num_of_attendees_error" required/>
                                        </div>
                                        <span class="text-danger" id="num_of_attendees_error"></span>
                                        @if ($errors->has('num_of_attendees'))
                                            <span class="text-danger">{{ $errors->first('num_of_attendees') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="coordinator_contact_id">Coordinator Contact.</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="coordinator_contact" value="{{ old('coordinator_contact') }}" type="text" class="form-control" id="coordinator_contact_id"
                                                   data-parsley-errors-container="#coordinator_contact_error" required/>
                                        </div>
                                        <span class="text-danger" id="coordinator_contact_error"></span>
                                        @if ($errors->has('coordinator_contact'))
                                            <span class="text-danger">{{ $errors->first('coordinator_contact') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="justification_id">Justification</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="justification" value="{{ old('justification') }}" type="text" class="form-control" data-parsley-errors-container="#justification_error" required/>
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
                                            <input name="additional_info" value="{{ old('additional_info') }}" type="text" class="form-control" data-parsley-errors-container="#additional_info_error" required/>
                                        </div>
                                        <span class="text-danger" id="additional_info_error"></span>
                                        @if ($errors->has('additional_info'))
                                            <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <a href="{{ route('admin-service-event-request-index') }}" class="btn rounded-pill btn-danger">Back</a>
                                        <button type="submit" class="btn rounded-pill btn-primary">Save</button>
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
        $(function() {
            $('#form_id').parsley();
        });

        $(".other-field").change(function() {
            let other_text = $(this).next().text().toLowerCase();

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
