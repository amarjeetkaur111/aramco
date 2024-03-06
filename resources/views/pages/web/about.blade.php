@extends('layouts.web')
@section('content')
<link rel="stylesheet" href="{{asset('assets/web/plugins/slick-1.8.1/slick/slick.css')}}" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<div class="container min-vh-70">
    <div class="pageheading my-3 justify-content-center">
        <div class="stext">About Lab</div>
    </div>
    <p class="pagesubheading mb-2  justify-content-center">{{ $page_title ?? "" }}</p>
    <div class="row">
        <div class="col-12 py-4">
            <p class="aboutHeading justify-content-center my-4">{{ $page_heading ?? "" }}</p>
        </div>
        @foreach($components as $component)
            {{--header text section--}}
            @if($component->template == "image_text")
                <div class="col-12 pt-4 pb-5 text-center">
                    <img src="{{ $component->image ?? "" }}" class="img-fluid" />
                </div>
                <div class="col-12 py-4">
                    <p class="text-justify">{!! nl2br($component->text) ?? "" !!}</p>
                </div>
            @endif

            @if($component->template == "list")
                <div class="col-12 pt-4 pb-2">
                    <p class="aboutSubHeading justify-content-center my-4"><span class="blue-underline">{{ $component->list_title ?? "" }}</span></p>
                </div>
                <div class="col-12 py-4  d-flex justify-content-center align-items-center">
                    <ul>
                        @foreach($component->list as $value)
                            <li class="mx-md-3 mx-sm-2 mx-2"><div class="offer-item"><div class="stext">{{ $value }}</div></div></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($component->template == "only_text")
                <div class="col-12 pt-5 pb-3">
                    <p class="text-justify">{!! nl2br( $component->text) ?? "" !!}</p>
                </div>
            @endif

            @if($component->template == "text_image")
                <div class="col-12 py-4">
                    <p class="text-justify">{!! nl2br( $component->text) ?? "" !!}</p>
                </div>
                <div class="col-12 pt-4 pb-5 text-center">
                    <img src="{{ $component->image ?? "" }}" class="img-fluid" />
                </div>
            @endif

            @if($component->template == "only_image")
                <div class="col-12 pt-4 pb-5 text-center">
                    <img src="{{ $component->image ?? "" }}" class="img-fluid" />
                </div>
            @endif
        @endforeach

        <div class="col-12 py-3 mt-4">
            <div class="row d-flex align-items-stretch aboutSliderContainer aboutContainer">

                @foreach($sliders as $slider)
                    @if($slider->pageid != $page_id)
                        <div class="aboutCard white mx-3 col">
                            <div class="aboutCard-img p-0">
                                <div class="aboutCard-img-hover"><a class="btn btn-primary btn-about-view" href="{{ ($slider->page_content_exixts == 1) ? route('about-lab', ['pageid'=> $slider->pageid]) : "#" }}">view</a>
                                </div>
                                <img src="{{ $slider->page_banner ?? "" }}" class="img-fluid"/>
                            </div>
                            <div class="aboutCard-content px-3 py-lg-4 py-md-3 yp-sm-3 py-3">
                                <p class="aboutCardBrief mb-2 w-100">{!! nl2br($slider->page_desc) ?? "" !!}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

        <section>
            <div class="footer-app-promo container">
                <h2>Download D&IT Lab Excellence app today</h2>
                <a href="#" target="_blank" rel="noreferrer" class="footer-app-promo__link">
                    <img src="{{asset('assets/web/images/google-play-badge.svg')}}" alt="google-play">
                </a>
                <a href="#" target="_blank" rel="noreferrer" class="footer-app-promo__link">
                    <img src="{{asset('assets/web/images/app-store-badge.svg')}}" alt="app-store">
                </a>
            </div>
        </section>


</div>
@endsection
@push('custom-scripts')
<script src="{{asset('assets/web/plugins/slick-1.8.1/slick/slick.min.js')}}"></script>
<script>

$('.header').removeClass('header--light');
$('.header').addClass('header--dark');

var aboutSliderOpts = {
    arrows: false,
    dots: true,
    autoplay: true,
    lazyLoad: 'ondemand',
    infinite: true,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    rows: 1,
    responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 822,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 776,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 420,
            settings: {
                slidesToShow: 1,
            }
        }
    ]
};
$('.aboutSliderContainer').slick(aboutSliderOpts); //.on('wheel', (function(e) {
//     e.preventDefault();
//     if (e.originalEvent.deltaY < 0) {
//         $(this).slick('slickNext');
//     } else {
//         $(this).slick('slickPrev');
//     }
// }));
</script>
@endpush
