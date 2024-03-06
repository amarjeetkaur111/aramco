@extends('layouts.admin')
@section('content')
    @php
        if(isset($data) && $data){
            $name = $data->first_name.' '.$data->last_name;
            $email = $data->email;
            $phone = $data->phone;
            $dob = $data->dob;
            $gender = $data->gender;
            $nationality = $data->nationality;
            $job_experience = $data->job_experience;
            $status = $data->status;
            $national_id = $data->national_id;
            $profile_photo = $data->profile_photo;
        }
        else{
            $name = null;
            $email = null;
            $phone = null;
            $dob = null;
            $gender = null;
            $nationality = null;
            $job_experience = null;
            $status = null;
            $national_id = null;
            $profile_photo = "../assets/img/avatars/1.png";
        }
    @endphp
    <style>
        .form-control:disabled, .form-control[readonly] { background-color: #ffffff;}
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
                        <h4 class="mb-0 {{$status == 'Approved' ? 'text-success' : 'text-warning' }} ">{{$status}}</h4>
                        @if($data->status == 'Pending')<button data-href="{{route('admin-users-approval',['id' => $id])}}"class="btn btn-primary  float-right approval-button">Approve/Reject User</button>@endif
                        </div>
                        <div class="card-body">
                        <!-- Account -->
                        <!-- <div class="card-body"> -->
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                            src={{$profile_photo}}
                            alt="user-avatar"
                            class="d-block rounded"
                            height="100"
                            width="100"
                            />
                        </div>
                        <!-- </div> -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Name</label>
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
                                            aria-describedby="basic-icon-default-role2" disabled/>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                            ><i class="bx bx-envelope"></i>
                                        </span>
                                        <input
                                            name="email" value="{{$email}}"
                                            type="email"
                                            class="form-control"
                                            id="basic-icon-default-role"
                                            placeholder="Email Here"
                                            aria-label="Email Here"
                                            aria-describedby="basic-icon-default-role2" disabled/>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Date of Birth</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                            ><i class="bx bx-date"></i>
                                        </span>
                                        <input
                                            name="dob" value="{{$dob}}"
                                            type="date"
                                            class="form-control" disabled/>
                                    </div>
                                    @if ($errors->has('dob'))
                                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Phone</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                            ><i class="bx bx-date"></i>
                                        </span>
                                        <input
                                            name="phone" value="{{$phone}}"
                                            type="text"
                                            class="form-control" disabled/>
                                    </div>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Gender</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                            ><i class="bx bx-date"></i>
                                        </span>
                                        <input
                                            name="gender" value="{{$gender}}"
                                            type="text"
                                            class="form-control" disabled/>
                                    </div>
                                    @if ($errors->has('gender'))
                                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nationality</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                            ><i class="bx bx-date"></i>
                                        </span>
                                        <input
                                            name="nationality" value="{{$nationality}}"
                                            type="text"
                                            class="form-control" disabled/>
                                    </div>
                                    @if ($errors->has('nationality'))
                                        <span class="text-danger">{{ $errors->first('nationality') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Job Experience</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                            ><i class="bx bx-date"></i>
                                        </span>
                                        <input
                                            name="job_experience" value="{{$job_experience}}"
                                            type="text"
                                            class="form-control" disabled/>
                                    </div>
                                    @if ($errors->has('job_experience'))
                                        <span class="text-danger">{{ $errors->first('job_experience') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <!-- <button type="submit" class="btn btn-primary">Send</button> -->
                                    <a href="{{URL::previous()}}"class="btn btn-primary">Back</a>
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
<script>
   $('body').on('click', '.approval-button', function() {
            $href = $(this).attr('data-href')
            $.confirm({
                title: 'Approve/Reject User',
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

</script>
@endpush
