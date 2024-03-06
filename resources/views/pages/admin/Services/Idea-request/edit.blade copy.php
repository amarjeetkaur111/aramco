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
                                        Idea Request Add
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
                            <form method="post" action="{{ route('admin-service-idea-request-store') }}" enctype="multipart/form-data" id="form_id">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label required-star" for="track_channel_id">Track/ Channel</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input name="track_channel" value="{{ $getData->track_channel ?? '' }}" type="text" class="form-control"
                                                   id="track_channel_id" placeholder="Track/ Channel Here" data-parsley-errors-container="#track_channel_error" required/>
                                        </div>
                                        <span class="text-danger" id="track_channel_error"></span>
                                        @if ($errors->has('track_channel'))
                                            <span class="text-danger">{{ $errors->first('track_channel') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label required-star" for="idea_name_id">Idea Name</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input name="idea_name" value="{{ $getData->idea_name ?? '' }}" type="text" class="form-control" id="idea_name_id"
                                                   data-parsley-errors-container="#idea_name_error" required/>
                                        </div>
                                        <span class="text-danger" id="idea_name_error"></span>
                                        @if ($errors->has('idea_name'))
                                            <span class="text-danger">{{ $errors->first('idea_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label required-star" for="idea_problem_id">Idea Problem</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input name="idea_problem" value="{{ $getData->idea_problem }}" type="text" class="form-control" id="idea_problem_id"
                                                   data-parsley-errors-container="#idea_problem_error" required/>
                                        </div>
                                        <span class="text-danger" id="idea_problem_error"></span>
                                        @if ($errors->has('idea_problem'))
                                            <span class="text-danger">{{ $errors->first('idea_problem') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label required-star" for="idea_solution_id">Idea Solution</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input name="idea_solution" value="{{ $getData->idea_solution ?? '' }}" type="text" class="form-control" id="idea_solution_id"
                                                   data-parsley-errors-container="#idea_solution_error" required/>
                                        </div>
                                        <span class="text-danger" id="idea_solution_error"></span>
                                        @if ($errors->has('idea_solution'))
                                            <span class="text-danger">{{ $errors->first('idea_solution') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label required-star" for="idea_resource_requirement_id">Idea Resource Requirement</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input name="idea_resource_requirement" value="{{ $getData->idea_resource_requirement }}" type="text" class="form-control" id="idea_resource_requirement_id"
                                                   data-parsley-errors-container="#idea_resource_requirement_error" required/>
                                        </div>
                                        <span class="text-danger" id="idea_resource_requirement_error"></span>
                                        @if ($errors->has('idea_resource_requirement'))
                                            <span class="text-danger">{{ $errors->first('idea_resource_requirement') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label required-star" for="contributors_id">Contributors</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input name="contributors" value="{{ $getData->contributors ?? '' }}" type="text" class="form-control" id="contributors_id"
                                                   data-parsley-errors-container="#contributors_error" required/>
                                        </div>
                                        <span class="text-danger" id="contributors_error"></span>
                                        @if ($errors->has('contributors'))
                                            <span class="text-danger">{{ $errors->first('contributors') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label required-star" for="point_of_contact_id">Contact No.</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input name="point_of_contact" value="{{ $getData->point_of_contact ?? '' }}" type="text" class="form-control" id="point_of_contact_id"
                                                   data-parsley-errors-container="#point_of_contact_error" required/>
                                        </div>
                                        <span class="text-danger" id="point_of_contact_error"></span>
                                        @if ($errors->has('point_of_contact'))
                                            <span class="text-danger">{{ $errors->first('point_of_contact') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label required-star" for="current_implementation_level_id">Implementation Level</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <select class="form-control" name="current_implementation_level" id="current_implementation_level_id" data-parsley-errors-container="#current_implementation_level_error" required>
                                                <option></option>
                                                @foreach($implementation_level as $key => $level)
                                                    <option value="{{ $key }}"  @if($key == $getData->current_implementation_level) selected @endif >{{ $level }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger" id="current_implementation_level_error"></span>
                                        @if ($errors->has('current_implementation_level'))
                                            <span class="text-danger">{{ $errors->first('current_implementation_level') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label required-star" for="technology_id">Technology</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <select class="form-control other-field" name="technology" id="technology_id" data-parsley-errors-container="#technology_error" required>
                                                <option></option>
                                                @foreach($technology as $key => $data)
                                                    <option value="{{ $key }}" @if($key == $getData->technology) selected @endif>{{ $data }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger" id="technology_error"></span>
                                        @if ($errors->has('technology'))
                                            <span class="text-danger">{{ $errors->first('technology') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3" id="other_div" hidden>
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input name="other_technology" value="{{ $getData->other_technology ?? '' }}" type="text" class="form-control"
                                                   placeholder="Other Technology Here" id="other_technology_id"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="attachment_id">Attachment</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input type="file" name="attachment" id="attachment">
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <a href="{{ route('admin-service-resource-index') }}" class="btn rounded-pill btn-danger">Back</a>
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
            $(".other-field").trigger('change');
        });

        $(".other-field").change(function() {
            let technology = $(".other-field option:selected" ).text().toLowerCase();

            if (technology == "Others" || technology == "other") {
                $('#other_div').removeAttr('hidden');
            } else {
                $('#other_div').attr('hidden', true);
                $('#other_technology_id').val('');
            }
        });
    </script>
@endpush
