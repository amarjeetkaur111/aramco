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
                        <h4 class="page-title">About the Lab</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        About the Lab
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
                                        <a class="btn btn-primary" href="{{ route('admin-aboutlab-addpage') }}"><i class="fa afa-plus"> Add New Page</i></a>
                                    </div>
                                    <table id="zero_config" class="table table-striped table-bordered dataTable"
                                           role="grid" aria-describedby="zero_config_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0"  width="2%">
                                                    Id
                                                </th>
                                                <th class="sorting" tabindex="0" width="10%">
                                                   Icon
                                                </th>
                                                <th class="sorting" tabindex="0" width="20%">
                                                    Banner
                                                 </th>


                                                <th class="sorting" tabindex="0" width="10%">
                                                   Page Title
                                                </th>
                                                 <th class="sorting" tabindex="0" width="10%">
                                                    Page Heading
                                                </th>
                                                <th class="sorting" tabindex="0" width="20%">
                                                    Description
                                                </th>

                                                <th class="sorting" tabindex="0"   width="10%">
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

        <form method="POST" id="status_page_form" action="{{ route('admin-aboutlab-changepagestatus')}}">
            @csrf
            <div class="d-flex align-items-end flex-column justify-content-end mt-2 pt-4 gap-2">
                   <input type="hidden" name="pageid"  id="pageid"  }}>
                {{-- <button type="submit" name="update_order" class="btn btn-primary rounded-pill"></button> --}}
            </div>
        </form>


        <form method="POST" id="delete_page_form" action="{{ route('admin-aboutlab-deletepage')}}">
            @csrf
            <div class="d-flex align-items-end flex-column justify-content-end mt-2 pt-4 gap-2">
                <input type="hidden" name="pageid"  id="del_pageid"  }}>

                {{-- <button type="submit" name="update_order" class="btn btn-primary rounded-pill"></button> --}}
            </div>
        </form>


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
                    {data: 'icon_image', name: 'icon_image'},
                    {data: 'banner_image', name: 'banner_image'},

                    {data: 'page_title', name: 'page_title'},
                    {data: 'page_heading', name: 'page_heading'},
                    {data: 'page_desc', name: 'page_desc'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


        });



        $('body').on('click','.status-page',function(e) {
    e.preventDefault();

   var pageid= $(this).attr('data-id');
   var msg= $(this).attr('data-msg');

    $.confirm({
          title: '', // Change "text" to "title"
          content: msg,
          buttons: {
            Yes: function () {
                // code comes here
               $('#pageid').val(pageid);
               $("#status_page_form").submit()
            },
            cancel: function() {
                //close
            },
          }
        })

  });




  $('body').on('click','.delete-page',function(e) {
    e.preventDefault();

   var pageid= $(this).attr('data-id');


    $.confirm({
          title: '', // Change "text" to "title"
          content: 'Do you want to delete this Page',
          buttons: {
            Delete: function () {
                // code comes here
               $('#del_pageid').val(pageid);
               $("#delete_page_form").submit()
            },
            cancel: function() {
                //close
            },
          }
        })

  });





    </script>
@endpush
