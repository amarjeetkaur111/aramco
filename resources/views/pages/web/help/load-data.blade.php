@foreach($helps as $help)

    <div class="accordion-item border-0">
        <h2 class="accordion-header" id="oldReq{{ $loop->iteration }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#or{{ $loop->iteration }}" aria-controls="or{{ $loop->iteration }}">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/oldReq-bullet.svg')}}" class="img-fluid" /></div>
                <div class="stext">
                    {{ $help->title ?? "" }}<br/>
                    <span class="stextSmall">Status - <span class="text-orange">{{ $help->status ?? "" }}</span></span>
                </div>
            </button>
        </h2>
        <div id="or{{ $loop->iteration }}" class="accordion-collapse collapse {{ ($loop->iteration == 1) ? "" : "" }}" aria-labelledby="oldReq{{ $loop->iteration }}" data-bs-parent=".oldReq_accordion">
            <div class="accordion-body">
                <div class="card p-3 border-0 rounded-4 oldReq-sub-card" style="background-color: #ffffff;">
                    <div class="card-header pb-3 bg-transparent card-pageheading">
                        <div class="sicon"><img src="{{asset('assets/web/images/icons/24/submit-request-black.svg')}}" class="img-fluid" /></div>
                        {{ $help->title ?? "" }}
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="col-form-label p-0 m-0">Email :</label>
                            <div class="form-control-plaintext p-0 m-0 mb-2 text-grey">{{ $help->user->email ?? "" }}</div>
                        </div>
                        <div class="mb-2">
                            <label class="col-form-label p-0 m-0">Description :</label>
                            <div class="form-control-plaintext p-0 m-0 mb-2 text-grey">
                                {{ $help->comment ?? "" }}
                            </div>
                        </div>
                        @if(!empty($help->document_path))
                            <div class="mb-2">
                                <div class="form-control-plaintext p-0 m-0 mb-2"><i class="fa-regular fa-file me-2"></i>
                                    <a href="{{ $help->document_path }}" target="_blank">Document</a>
                                </div>
                            </div>
                        @endif
                        <div class="row row-cols-auto align-items-center">
                            <label class="col-form-label p-0 m-0 ps-3">Status :</label>
                            <div class="form-control-plaintext d-inline-block w-auto p-0 m-0 ps-2 text-warning">{{ $help->status ?? "" }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

