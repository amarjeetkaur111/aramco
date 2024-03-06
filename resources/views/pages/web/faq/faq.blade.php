@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">
        <div class="pageheading my-3">
            <div class="sicon"><img src="{{asset('assets/web/images/icons/24/faq.svg')}}" class="img-fluid" /></div><div class="stext">FAQ</div>
        </div>

        <div class="row">
            <div class="col-12 py-4">
            <div class="accordion faq_accordion" id="faq_accordion">
                @foreach($getFaqs as $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="fh{{ $loop->iteration }}">
                            <button class="accordion-button {{ ($loop->iteration != 1) ? "collapsed" : "" }}" type="button" data-bs-toggle="collapse" data-bs-target="#f{{ $loop->iteration }}" aria-controls="f{{ $loop->iteration }}">
                                {{ $faq->question ?? "" }}
                            </button>
                        </h2>
                        <div id="f{{ $loop->iteration }}" class="accordion-collapse collapse {{ ($loop->iteration == 1) ? "show" : "" }}" aria-labelledby="fh{{ $loop->iteration }}" data-bs-parent="#faq_accordion">
                            <div class="accordion-body">
                                {!! nl2br($faq->answer) ?? "" !!}
                            </div>
                        </div>
                    </div>
                @endforeach
              </div>
              </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');
    </script>
@endpush
