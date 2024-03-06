@extends('layouts.admin')
@section('content')
    @php
        if(old('name')){
            $name = old('name');
            $role_permissions = [];
        }
        else if(isset($data) && $data){
            $name = $data->name;
            $role_permissions = $data->permissions->pluck('id');
        }
        else{
            $name = null;
            $role_permissions = [];
        }
    @endphp
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Roles
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
                        <h5 class="mb-0">Add Role</h5>
                        </div>
                        <div class="card-body">
                        <form method="post" action="{{ $action }}">
                        @csrf
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
                                            placeholder="Enter Role   Eg. Admin"
                                            aria-label="Enter Role   Eg. Admin"
                                            aria-describedby="basic-icon-default-role2"/>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Permissions</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <select class="form-select" name="permissions[]" id="permissions" multiple>
                                            @foreach ($permissions as $p)
                                                <option value="{{$p->id}}">{{$p->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('permissions'))
                                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                                    @endif
                                </div>
                            </div>                            -->
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Send</button>
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
    $(function () {
        $('#permissions').select2({
            width: '100%'
        });
        console.log('Ready...')
    });
    @if($role_permissions)
    $('#permissions').val({!!$role_permissions!!}).trigger('change');
    @endif
</script>
@endpush
