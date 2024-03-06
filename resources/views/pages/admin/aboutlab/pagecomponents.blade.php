@extends('layouts.admin')
@section('content')
@php

// echo '<pre>';
// print_r($finalarr);

//  exit;
@endphp
<style>
.form-control:disabled,
.form-control[readonly] {
    background-color: #ffffff;
}

.br-375 {
    border-radius: 0.375rem !important;
}

.multi-input-container .input-group:first-child .btn {
    display: none;
}
.handle{
    cursor: move;
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
.actionelementsdiv
{
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    padding: 10px 0;

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
                                    About The Lab
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

        <div class="row">
            <div class="col-xxl">
                <!-- component repeater start here -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-end justify-content-end mb-1 gap-2">
                            <a href="{{route('admin-aboutlab-addcomponent',['pageid' => $pageid])}}" class="btn btn-primary btn-sm rounded-pill px-3"> Add Component</a>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:20px">Change Order</th>
                                        <th>Component Title</th>
                                        <th>Component Type</th>
                                        <th>Created On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">


                                    @foreach($finalarr as $data)
                                    <tr id="{{$data['id']}}" data-order="{{$data['component_order']}}">
                                        <td><i class="fas fa-arrows-alt handle"></i></td>
                                        <td>{{$data['component_title']}}</td> <!-- id from DB -->
                                        <td>{{$data['template']}}</td>
                                        <td>{{date("d-m-Y" ,strtotime($data['created_at']))}}</td> <!-- order from DB  -->

                                        <td >



                                            <a class="table-action-link" href="{{route('admin-aboutlab-editcomponent',['pageid'=> $pageid,'id'=>$data['id']])}}" title="Edit Component">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a class="table-action-link delete-component" data-id="{{$data['id']}}" href="" title="Delete Component" >
                                                <i class="fas fa-trash-alt"></i>
                                            </a>

                                            @php

                                            $icon="fa-eye";
                                            $title="Activate this Component";
                                            if($data['status']==1){

                                                $icon="fa-eye-slash";

                                                $title="De-activate this Component";
                                            }



                                            @endphp

                                            <a class="table-action-link status-component" data-id="{{$data['id']}}" href=""  data-msg="Are you sure you want to {{$title}} ?" title="{{ $title}}">
                                                <i class="fas  {{ $icon}}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        @if(count($finalarr)>0)

                       <form method="POST" id="update_order_form" action="{{ route('admin-aboutlab-updatecomponentorder')}}"">
                        @csrf
                        <input type="hidden" name="pageid"  value={{ $pageid}}>
                            <div class="d-flex align-items-end flex-column justify-content-end mt-2 pt-4 gap-2">
                                <button type="submit" name="update_order" class="btn btn-primary rounded-pill">Update Order</button>
                            </div>
                        </form>

                        @endif



                        <form method="POST" id="delete_component_form" action="{{ route('admin-aboutlab-deletecomponent')}}">
                            @csrf
                            <div class="d-flex align-items-end flex-column justify-content-end mt-2 pt-4 gap-2">
                                <input type="hidden" name="delete_component_id"  id="delete_component_id">
                                <input type="hidden" name="pageid"  value={{ $pageid}}>
                                {{-- <button type="submit" name="update_order" class="btn btn-primary rounded-pill"></button> --}}
                            </div>
                        </form>



                        <form method="POST" id="status_component_form" action="{{ route('admin-aboutlab-changecomponentstatus')}}">
                            @csrf
                            <div class="d-flex align-items-end flex-column justify-content-end mt-2 pt-4 gap-2">
                                <input type="hidden" name="status_component_id"  id="status_component_id">
                                <input type="hidden" name="pageid"  value={{ $pageid}}>
                                {{-- <button type="submit" name="update_order" class="btn btn-primary rounded-pill"></button> --}}
                            </div>
                        </form>
                    </div>

                </div>
            </div>


            @endsection
            @push('custom-scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <script>
            $(document).ready(function() {
                // Return a helper with preserved width of cells
                var fixHelper = function(e, ui) {
                ui.children().each(function() {
                    $(this).width($(this).width());
                });
                return ui;
                };

                $("table tbody").sortable({
                    handle: '.handle',
                     helper: fixHelper
                }).disableSelection();
                // Save button click event
                $("[name='update_order']").click(function(e) {
                    e.preventDefault();
                    UpdateOrder();
                });
            });

            function UpdateOrder() {
                var jsonObj = [];
                var id = '';
                var existing_order = '';
                var updated_order = '';
                var updated_row = {};
                jQuery("table tbody tr").each(function(index, value) {
                    if ((index + 1) != $(this).data(
                        'order')) { // To check whether the current row order has been changed or not. Only the changed order rows only needs to be updated.
                        id = $(this).attr("id");
                        existing_order = $(this).data('order');
                        updated_order = (index + 1);
                        updated_row = {}
                        updated_row["id"] = id;
                        updated_row["existing_order"] =
                        existing_order; // I just added for your reference. If you do not need this value, comment this line.
                        updated_row["updated_order"] = updated_order;
                        jsonObj.push(updated_row);
                    }
                });
                console.log(JSON.stringify(jsonObj));
                //ex: [{"id":"2","existing_order":2,"updated_order":1},{"id":"3","existing_order":3,"updated_order":2},{"id":"1","existing_order":1,"updated_order":3}]
                $('#update_order_form').append("<input type='hidden' name='updated_rows' value='" + JSON.stringify(jsonObj) + "'>").submit();
                 // To send the values to server side script (here, PHP). Please do empty validation before you send to server if you need
                //  $("#update_order_form").submit();
                }



  $('body').on('click','.delete-component',function(e) {
    e.preventDefault();

   var comp_id= $(this).attr('data-id');

    $.confirm({
          title: '', // Change "text" to "title"
          content: 'Do you want to delete component',
          buttons: {
            Delete: function () {
                // code comes here
               $('#delete_component_id').val(comp_id);
               $("#delete_component_form").submit()
            },
            cancel: function() {
                //close
            },
          }
        })

  });




  $('body').on('click','.status-component',function(e) {
    e.preventDefault();

   var comp_id= $(this).attr('data-id');
   var msg= $(this).attr('data-msg');

    $.confirm({
          title: '', // Change "text" to "title"
          content: msg,
          buttons: {
            Yes: function () {
                // code comes here
               $('#status_component_id').val(comp_id);
               $("#status_component_form").submit()
            },
            cancel: function() {
                //close
            },
          }
        })

  });





            </script>
            @endpush
