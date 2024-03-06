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
                                        General Reservation Add
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
                            <button data-href="{{ route('admin-service-general-reservation-change-status', ['id' => $data->id]) }}" class="btn rounded-pill btn-primary float-right status-change">Change status</button>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin-service-general-reservation-store') }}" enctype="multipart/form-data" id="form_id">
                                @csrf
                                <input type="hidden" name="reservation_id" value="{{ $data->id }}">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="title_id">Title</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input name="title" value="{{ $data->title ?? "" }}" type="text" class="form-control"
                                                   id="title_id" placeholder="Title Here"
                                                   data-parsley-errors-container="#title_error" required/>
                                        </div>
                                        <span class="text-danger" id="title_error"></span>
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
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
                                            <input name="end_date" value="{{ $data->end_date ?? "" }}" type="datetime-local" class="form-control"
                                                   data-parsley-errors-container="#end_date_error" required/>
                                        </div>
                                        <span class="text-danger" id="end_date_error"></span>
                                        @if ($errors->has('end_date'))
                                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label required-star" for="num_of_employees_id">Description</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <textarea name="description" class="form-control" rows="5" data-parsley-errors-container="#description_error" required>{{ $data->description ?? "" }}</textarea>
                                        </div>
                                        <span class="text-danger" id="description_error"></span>
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
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

                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <a href="{{ route('admin-service-general-reservation-index') }}" class="btn rounded-pill btn-danger">Back</a>
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
            $('input[type="text"], input[type="datetime-local"], textarea').prop("readonly",true);
            $('#update_data').hide();

            $('#form_id').parsley();
        });

        $('.edit-data').on('click', function (){
            $('input[type="text"], input[type="datetime-local"], textarea').prop("readonly", false);
            $('#update_data').show();
        });

    </script>
@endpush
