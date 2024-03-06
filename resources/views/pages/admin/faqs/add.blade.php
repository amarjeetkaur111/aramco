@extends('layouts.admin')
@section('content')
    @php
        if(old('name')){
            $question = old('question');
            $answer = old('answer');

        }
        else if(isset($data) && $data){
            $question = $data->question;
            $answer = $data->answer;

        }
        else{
            $question = null;
            $answer = null;

        }
    @endphp
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
                                        FAQs
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Add FAQ</h5>
                        </div>
                        <div class="card-body">
                        <form method="post" action="{{ $action }}">
                        @csrf
                            <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Question</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                            >
                                        </span>
                                        <input
                                            name="question" value="{{$question}}"
                                            type="text"
                                            class="form-control"

                                            placeholder="Question"

                                           />
                                    </div>
                                    @if ($errors->has('question'))
                                        <span class="text-danger">{{ $errors->first('question') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Answer</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"
                                                >
                                            </span>
                                            <textarea
                                                name="answer"

                                                class="form-control"

                                                placeholder="Question"

                                                />{{$answer}}</textarea>
                                        </div>
                                        @if ($errors->has('answer'))
                                            <span class="text-danger">{{ $errors->first('answer') }}</span>
                                        @endif
                                    </div>
                                </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
                                </div>
                            </div>


                            <div class="d-flex align-items-end  justify-content-end mb-3 gap-2">
                                <button type="submit" class="btn btn-green rounded-pill" onClick="aboutLabFormValidate()" >Save</button>
                                <a href="{{route('admin-faqs-all')}}" class="btn btn-red rounded-pill" >Cancel</a>
                            </div>



                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('custom-scripts')

@endpush
