@extends('layouts.web')
@section('content')
    <link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container">
        <div class="row justify-content-between align-items-center my-3">
            <div class="col-12 d-flex justify-content-start align-items-center">
                <a href="{{route('help-submit-request')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
            </div>
        </div>
    </div>
    <div class="container min-vh-70">

        <div class="row">
            <div class="col-12 py-2">

                <div class="card p-3 border-0 rounded-4 bg-aramco-grey" >
                    <div class="card-header bg-transparent card-pageheading">
                        <div class="sicon"><img src="{{asset('assets/web/images/icons/24/submit-request-black.svg')}}" class="img-fluid" /></div><div class="stext">My Submitted Requests</div>
                    </div>
                    <div class="card-body pb-0 scroll-container" style="max-height:43vh; overflow:hidden; overflow-y:auto;">
                     
                        <div class="accordion oldReq_accordion" id="data-wrapper">
                            @include('pages.web.help.load-data')
                        </div>

                    </div>

                    <div class="card-footer border-0 bg-transparent pt-4 pb-0">

                        <div id="oldReq-pagination"></div>

                        <!-- <ul class="pagination justify-content-end card-pagination">
                          <li class="page-item disabled"><a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item active"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
                        </ul> -->

            <div class="d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-light btn-activity load-more-data">
                    <span class="loading">
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                    show more
                </button>
            </div>


                    </div>

                </div>


            </div>
        </div>




    </div>
@endsection
@push('custom-scripts')
    <script src="{{asset('assets/web/plugins/jquery-bootpag/jquery.bootpag.min.js')}}"></script>
    <script src="{{asset('assets/web/service.js')}}"></script>
    <script>

        $('.header').removeClass('header--light');
        $('.header').addClass('header--dark');

        let total = "{{ $total }}";
        let URL = "{{ route('help-old-request') }}";
        let page = 1;

        // $('#oldReq-pagination').bootpag({
        //     total: total,
        //     page: 1,
        //     maxVisible: 10,
        //     leaps: true,
        //     firstLastUse: false,
        //     first: null,
        //     last: null,
        //     prev: '<i class="fa-solid fa-chevron-left"></i>',
        //     next: '<i class="fa-solid fa-chevron-right"></i>',
        //     wrapClass: 'pagination justify-content-end card-pagination',
        //     activeClass: 'active',
        //     disabledClass: 'disabled',
        //     // nextClass: 'next',
        //     // prevClass: 'prev',
        //     // lastClass: 'last',
        //     // firstClass: 'first'
        // }).on("page", function(event, num){
        //     // or some ajax content loading...
        //     infiniteLoadMore(URL + "?page=" + num, 'loading', 'data-wrapper');
        // });

        $(document).ready(function () {
          $('#oldReq-pagination').DataTable( {
            "ordering": false,
            dom: 'Plrtp',
            scrollY: '50vh',
            scrollX: false,
            scrollCollapse: false,
            paging: false,
          });
       });

       document.querySelector('.load-more-data').addEventListener('click', function (){
           page++;
           infiniteLoadMore(URL + "?page=" + page, 'loading', 'data-wrapper');
       });

        // function infiniteLoadMore(url, loader_class, table_body) {
        //     $.ajax({
        //         beforeSend: function () {
        //             $('.' + loader_class).show();
        //         },
        //         datatype: "html",
        //         type: "get",
        //         url: url,
        //         data: {
        //             _token: "{{ csrf_token() }}"
        //         },
        //         success: function (response) {
        //             if (response.html == '') {
        //                 $('.' + loader_class).text("No more data ...");
        //                 return;
        //             }

        //             $('.' + loader_class).hide();
        //             $("#" + table_body).html(response.html);
        //         },
        //         complete: function () {
        //             $('.' + loader_class).hide();
        //         },
        //         error: function (jqXHR, textStatus, errorThrown) {
        //             console.log(textStatus, errorThrown);
        //             $('.' + loader_class).hide();
        //         }
        //     });
        // }

    </script>
@endpush
