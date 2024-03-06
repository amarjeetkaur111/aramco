@extends('layouts.admin')
@section('content')
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
            @include('includes.admin.message')
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 text-success">User Profile</h4>

                            @if(CommonFunction::getAuthUserRoleId() && in_array(CommonFunction::getUserRoleIdByUserId($user_info->id), [4, 5]))
                                <button data-href="{{route('admin-users-change-role',['id' => $user_info->id])}}" class="btn btn-primary  float-right role-change">Change User Role</button>
                            @endif
                        </div>
                        <div class="card-body">

                            <!-- Account -->
                            <!-- <div class="card-body"> -->
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if(!empty($user_info->profile_photo))
                                    <img src="{{ $user_info->profile_photo }}" alt="user-avatar" class="d-block rounded"
                                         height="100" width="100" id="uploadedAvatar"/>
                                @else
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar"
                                         class="d-block rounded" height="100" width="100"/>
                                @endif

                            </div>

                            <!-- </div> -->
                            @role(1)
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Role</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">

                                        <input
                                            name="name" value="{{ CommonFunction::getRoleName($user_info->id) }}"
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
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Name</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                        ><i class="bx bx-user"></i>
                                        </span>
                                        <input
                                            name="name" value="{{ $user_info->first_name }}"
                                            type="text"
                                            class="form-control"
                                            id="basic-icon-default-role"
                                            placeholder="Name Here"
                                            aria-label="Name Here"
                                            aria-describedby="basic-icon-default-role2" disabled/>
                                    </div>
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
                                            name="email" value="{{ $user_info->email }}"
                                            type="email"
                                            class="form-control"
                                            id="basic-icon-default-role"
                                            placeholder="Email Here"
                                            aria-label="Email Here"
                                            aria-describedby="basic-icon-default-role2" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Date of
                                    Birth</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-date"></i></span>
                                        <input name="dob" value="{{ $user_info->dob }}" type="date" class="form-control"
                                               disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Phone</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                        ><i class="bx bx-date"></i>
                                        </span>
                                        <input name="phone" value="{{ $user_info->phone }}" type="text"
                                               class="form-control" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Gender</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-date"></i>
                                    </span>
                                        <input
                                            name="gender" value="{{ $user_info->gender }}" type="text"
                                            class="form-control" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"
                                       for="basic-icon-default-fullname">Nationality</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-date"></i>
                                        </span>
                                        <input name="nationality" value="{{ $user_info->nationality }}" type="text"
                                               class="form-control" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Job
                                    Experience</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-date"></i></span>
                                        <input name="job_experience" value="{{ $user_info->job_experience }}"
                                               type="text" class="form-control" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Status</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-date"></i></span>
                                        <input name="job_experience" value="{{ $user_info->status }}"
                                               type="text" class="form-control" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <!-- <button type="submit" class="btn btn-primary">Send</button> -->
                                    <a href="{{route('admin-users-index')}}"class="btn btn-primary">Back</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('custom-scripts')
    <script>
        $('body').on('click', '.role-change', function() {
            $href = $(this).attr('data-href');
            $.confirm({
                title: 'Change User Role',
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
