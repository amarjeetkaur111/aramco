@extends('layouts.admin')
@section('content')

<style>


    .actionelementsdiv
    {
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        padding: 10px 0;

    }

    .table-action-link{
        color: #696cff;
        font-size:18px;
        line-height:18px;
        width:18px;
        height:18px;
        display:inline-block;
        margin: 1px 8px 1px 0px;
    }
    .table-action-link:hover{
        color: #5f61e6;
    }


    </style>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">AR Navigation</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        AR Navigation
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @if(\Illuminate\Support\Facades\Session::has('msg'))
                <div class="alert alert-{{ \Illuminate\Support\Facades\Session::has('class') ? \Illuminate\Support\Facades\Session::get('class') : 'default' }} alert-dismissible" role="alert">
                    {{ \Illuminate\Support\Facades\Session::get('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div style="display: flex; justify-content: flex-end; padding-bottom: 10px">
                                        <a class="btn btn-primary" href="{{ route('admin-ar-add') }}"><i class="fa afa-plus"> Add AR Navigation</i></a>
                                    </div>
                                    <table id="zero_config" class="table table-striped table-bordered dataTable"
                                           role="grid" aria-describedby="zero_config_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0"  width="5%">
                                                    Id
                                                </th>
                                                <th class="sorting" tabindex="0" width="20%">
                                                    AR Image
                                                </th>


                                                <th class="sorting" tabindex="0" width="10%">
                                                    Is Destination
                                                </th>
                                                 <th class="sorting" tabindex="0" width="20%">
                                                    Name
                                                </th>
                                                <th class="sorting" tabindex="0" width="40%">
                                                    Description
                                                </th>

                                                <th class="sorting" tabindex="0"   width="5%">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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

        $(function () {

            var table = $('#zero_config').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'arimage', name: 'arimage'},

                    {data: 'destination', name: 'destination'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


        });
    </script>
@endpush
