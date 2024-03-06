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
                                        Workshop Request Add
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
                            <form method="post" action="{{ route('admin-service-workshop-request-store') }}" enctype="multipart/form-data" id="form_id">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="workshop_name_id">Workshop Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="workshop_name" value="{{ old('workshop_name') }}" type="text" class="form-control"
                                                   id="workshop_name_id" placeholder="Workshop Name Here" data-parsley-errors-container="#workshop_name_error" required/>
                                        </div>
                                        <span class="text-danger" id="workshop_name_error"></span>
                                        @if ($errors->has('workshop_name'))
                                            <span class="text-danger">{{ $errors->first('workshop_name') }}</span>
                                        @endif
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
                                    <label class="col-sm-2 col-form-label required-star" for="num_of_people_id">Number of People</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="num_of_people" value="{{ old('num_of_people') }}" type="number" class="form-control"
                                                   data-parsley-errors-container="#num_of_people_error" required/>
                                        </div>
                                        <span class="text-danger" id="num_of_people_error"></span>
                                        @if ($errors->has('num_of_people'))
                                            <span class="text-danger">{{ $errors->first('num_of_people') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="point_of_contact_id">Contact No.</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="point_of_contact" value="{{ old('point_of_contact') }}" type="text" class="form-control"
                                                   data-parsley-errors-container="#point_of_contact_error" required/>
                                        </div>
                                        <span class="text-danger" id="point_of_contact_error"></span>
                                        @if ($errors->has('point_of_contact'))
                                            <span class="text-danger">{{ $errors->first('point_of_contact') }}</span>
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
                                        <a href="{{ route('admin-service-workshop-request-index') }}" class="btn rounded-pill btn-danger">Back</a>
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
    </script>
@endpush
