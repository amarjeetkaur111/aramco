@extends('layouts.admin')
@section('content')
    @php
        if(old('name')){
            $profile_photo = old('profile_photo');
            $name = old('name');
            $email = old('email');
            $phone = old('phone');
            $dob = old('dob');
            $gender = old('gender');
            $nationality = old('nationality');
            $job_experience = old('job_experience');
            $status = old('status');
            $national_id =  old('national_id');
            $user_roles = [];
        }
        else if(isset($data) && $data){
            $name = $data->first_name.' '.$data->last_name;
            $email = $data->email;
            $profile_photo = $data->profile_photo;
            $phone = $data->phone;
            $dob = $data->dob;
            $gender = $data->gender;
            $nationality = $data->nationality;
            $job_experience = $data->job_experience;
            $status = $data->status;
            $national_id = $data->national_id;
            $user_roles = $data->roles->pluck('id');
        }
        else{
            $name = null;
            $email = null;
            $phone = null;
            $profile_photo = "../assets/img/avatars/1.png";
            $dob = null;
            $gender = null;
            $nationality = null;
            $job_experience = null;
            $status = null;
            $national_id = null;
            $user_roles = [];
        }
    @endphp
    <style>
        .form-control:disabled, .form-control[readonly] {
            background-color: #ffffff;
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
                                        Users
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                        <!-- <h5 class="mb-0">Add User</h5> -->
                        </div>
                        <div class="card-body">
                        <form method="post" action="{{ $action }}" enctype="multipart/form-data" id="form_id">
                        @csrf
                        <!-- Account -->
                        <!-- <div class="card-body"> -->
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                            src={{ $profile_photo ?? asset('assets/img/avatars/1.png') }}
                            alt="user-avatar"
                            class="d-block rounded"
                            height="100"
                            width="100"
                            id="uploadedAvatar"
                            />
                            <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input
                                type="file"
                                id="upload"
                                class="account-file-input"
                                hidden
                                accept="image/png, image/jpeg"
                                name="profile_photo"
                                max-size="800"
                                />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            @if ($errors->has('profile_photo'))
                                <span class="text-danger">{{ $errors->first('profile_photo') }}</span>
                            @endif
                            </div>
                        </div>
                        <!-- </div> -->
                            @role(1)
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Role</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">

                                        <input
                                            name="name1" value="{{ CommonFunction::getRoleName(Auth::user()->id) }}"
                                            type="text"
                                            class="form-control"
                                            id="basic-icon-default-role"
                                            placeholder="Name Here"
                                            aria-label="Name Here"
                                            aria-describedby="basic-icon-default-role2" disabled/>
                                    </div>
                                </div>
                            </div>
                            @endrole
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-star" for="basic-icon-default-fullname">Name</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                            ><i class="bx bx-user"></i>
                                        </span>
                                        <input
                                            name="name" value="{{$name}}"
                                            type="text"
                                            class="form-control"
                                            id="basic-icon-default-role"
                                            placeholder="Name Here"
                                            aria-label="Name Here"
                                            aria-describedby="basic-icon-default-role2"
                                            data-parsley-errors-container="#name_error"
                                            required/>
                                    </div>

                                    <span class="text-danger" id="name_error"></span>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-envelope"></i></span>
                                        <input
                                            name="email" value="{{$email}}"
                                            type="email"
                                            class="form-control"
                                            id="basic-icon-default-role"
                                            placeholder="Email Here"
                                            aria-label="Email Here"
                                            aria-describedby="basic-icon-default-role2" readonly/>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-star" for="basic-icon-default-fullname">Date of Birth</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <input
                                            name="dob" value="{{$dob}}"
                                            type="date"
                                            class="form-control"
                                            data-parsley-errors-container="#dob_error"
                                            required/>
                                    </div>
                                    <span class="text-danger" id="dob_error"></span>
                                    @if ($errors->has('dob'))
                                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-star" for="basic-icon-default-fullname">Phone</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <input
                                            name="phone" value="{{$phone}}"
                                            type="text"
                                            class="form-control"
                                            data-parsley-errors-container="#phone_error"
                                            required/>
                                    </div>

                                    <span class="text-danger" id="phone_error"></span>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-star" for="basic-icon-default-fullname">Gender</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <select name="gender" class="form-control" data-parsley-errors-container="#gender_error" required>
                                            <option></option>
                                            <option value="Male" {{ $gender == "Male" ? "selected" : " " }}>Male</option>
                                            <option value="Female" {{ $gender == "Female" ? "selected" : " " }}>Female</option>
                                            <option value="Others" {{ $gender == "Others" ? "selected" : " " }}>Others</option>
                                        </select>
                                    </div>
                                    <span class="text-danger" id="gender_error"></span>
                                    @if ($errors->has('gender'))
                                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-star" for="basic-icon-default-fullname">Nationality</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <select name="nationality" class="form-control" data-parsley-errors-container="#nationality_error" required>
                                            <option></option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->name }}" {{ $nationality == $country->name ? "selected" : " " }}>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="text-danger" id="nationality_error"></span>
                                    @if ($errors->has('nationality'))
                                        <span class="text-danger">{{ $errors->first('nationality') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-star" for="basic-icon-default-fullname">Job Experience</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <input
                                            name="job_experience" value="{{$job_experience}}"
                                            type="text"
                                            class="form-control"
                                            data-parsley-errors-container="#job_experience_error"
                                            required/>
                                    </div>

                                    <span class="text-danger" id="job_experience_error"></span>
                                    @if ($errors->has('job_experience'))
                                        <span class="text-danger">{{ $errors->first('job_experience') }}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Role</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <select class="form-select" name="role" id="role" @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Super Admin')) '' @else  readonly style="pointer-events: none;" @endif>
                                        @foreach ($roles as $p)
                                            <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('role'))
                                        <span class="text-danger">{{ $errors->first('role') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Status</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <select class="form-select" name="status" id="status" @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Super Admin')) '' @else  readonly style="pointer-events: none;" @endif>
                                            <option value="Pending">Pending</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>             -->
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary rounded-pill">Update</button>
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
