@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/plugins/datatables/datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<div class="container min-vh-70">

    <div class="pageheading my-3 mt-4 d-flex justify-content-between">
        <div class="d-flex flex-row">
            <div class="sicon"><img src="{{asset('assets/web/images/icons/24/calender_large.svg')}}"
                    class="img-fluid" /></div>
            <div class="stext">Feedback Management</div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-md-12 col-sm-12 col-12">
            @if(Session::has('msg'))
                <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show my-5" role="alert">
                    {{ Session::get('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-setting">

                            <div class="row justify-content-between align-items-center mt-3 mb-3">
                                <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
                                    <a href="{{route('feedback-admin-index')}}" class="pagesTopNavLink"><span class="sicon"><img
                                                src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}"
                                                class="img-fluid" /></span>Back</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item mb-3 border-0 p-0">
                                            <div
                                                class="p-3 border-0 rounded-5 w-100 bg-aramco-grey overflow-hidden justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <span class="sicon"><img
                                                                src="{{asset('assets/web/images/icons/24/user_icon.svg')}}"
                                                                class="img-fluid" /></span>
                                                    </div>
                                                    <div class="ms-2">{{ $data->user->first_name ?? ''}} {{ $data->user->last_name ?? ''}}</div>
                                                </div>
                                                <hr />
                                                <div>
                                                    <div class="fw-bold">Email:</div>
                                                    <div>{{$data->user->email ?? ''}}</div>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="fw-bold">Description:</div>
                                                    <div>{{ $data->comment ?? ''}}</div>
                                                </div>
                                               
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                    <div>
                                        <div class="mt-2"><img src="{{asset('assets/web/images/icons/24/reply.svg')}}"
                                                class="img-fluid" /> <span>Provide Feedback:</span></div>
                                        <div class="mt-4">
                                            <form action="{{route('feedback-admin-feedback-system-response-store')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="feedbackid" value="{{ $data->id }}">
                                                <div class="col-lg-4">
                                                    <textarea class="form-control comments" name="comment" maxlength="250" placeholder="Enter Your Comments...."
                                                        id="floatingTextarea2" style="height: 100px"></textarea>
                                                    <span class="ms-auto me-0 d-block fs-5 text-end taCountContainer"><span class="taCount">0</span>/250</span>
                                                    @if ($errors->has('comment'))
                                                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                                                    @endif
                                                    <div class="d-flex justify-content-end mt-4 pt-3">
                                                        <button type="submit"
                                                            class="btn btn-primary ms-2 submit-btn">Submit</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
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
<script src="{{asset('assets/web/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/web/js/moment.min.js')}}"></script>
<script src="{{asset('assets/web/plugins/datatables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js')}}"></script>
<script>
    $('.header').removeClass('header--light');
    $('.header').addClass('header--dark');

    $('.comments').on("input", function() {
        var currentLength = $(this).val().length;
        $(this).parent().find('.taCountContainer').find('.taCount').html(currentLength);
    });
</script>
@endpush