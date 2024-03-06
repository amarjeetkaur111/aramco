@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Idea Request List</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Idea Request List
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div style="display: flex; justify-content: flex-end; padding-bottom: 10px">
                                        <a class="btn rounded-pill btn-primary" href="{{ route('admin-service-idea-request-add') }}"><i class="fas fa-plus"></i> Add</a>
                                    </div>
                                    <table id="zero_config" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0">
                                                Id
                                            </th>
                                            <th class="sorting" tabindex="1">
                                                User Name
                                            </th>
                                            <th class="sorting" tabindex="1">
                                                Track Channel
                                            </th>
                                            <!-- <th class="sorting" tabindex="2">
                                                Use Case Contact
                                            </th> -->
                                            <th class="sorting" tabindex="3">
                                                Idea Name
                                            </th>
                                            <th class="sorting" tabindex="4">
                                                Current Implementaion Level
                                            </th>
                                            <th class="sorting" tabindex="4">
                                                Technology
                                            </th>
                                            <th class="sorting" tabindex="5">
                                                Status
                                            </th>

                                            <th class="sorting" tabindex="8">
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
                ajax: "{{ route('admin-service-idea-request-list') }}",
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'track_channel', name: 'track_channel'},
                    // {data: 'contact_of_usecase', name: 'use_case_contact'},
                    {data: 'idea_name', name: 'idea_name'},
                    {data: 'current_implementation_level', name: 'current_implementation_level'},
                    {data: 'technology', name: 'technology'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush

