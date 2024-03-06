@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.min.css')}}"/>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Technology List</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Technology List
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
                                        <a class="btn rounded-pill btn-primary" href="{{ route('admin-service-technology-add') }}"><i class="fas fa-plus"></i> Add</a>
                                    </div>
                                    <table id="zero_config" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0">
                                                Id
                                            </th>
                                            <th class="sorting" tabindex="1">
                                                Name
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
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(function () {
            getList();
        });

        function getList()
        {
            $('#zero_config').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{ route('admin-service-technology-list') }}",
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        }

        function deleteData(row_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                // width: '400px'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin-service-technology-delete') }}",
                        type: 'POST',
                        data: { row_id: row_id, _token: "{{ csrf_token() }}" },
                        dataType: 'json'
                    }).done(function(response){
                        if (response.status == "success") {
                            Swal.fire('Deleted!','Your data has been deleted.','success');
                            getList();
                        }

                    }).fail(function(){
                        swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                    });
                }
            })
        }
    </script>
@endpush

