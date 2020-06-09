@extends('master')
@section('title','IQ Test Result')
@section('menu')
    @parent
@endsection
@section('content')

    <div class="container padding-20">
        <div class="row">
            <div id="staff_new_edit_frm" class="col-xl-10 col-lg-10 col-md-10 col-sm-12">
                <h2 class="border-bottom">
                    IQ Test Result
                </h2>
                <form >
                    @csrf
                         @php
                            $n =0;
                         @endphp
                    @foreach($list_iq_question_arr As $question)
                        @php
                            $n = $n +1;
                        @endphp
                        <div class="form-group">
                            <label for="formiqQuestion_content" class="font-weight-bold"><span> {{$n}}.  </span>{{ $question['content']}} </label>
                        </div>
                        
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iq_question" id="exampleRadios1" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Default radio
                        </label>
                    </div>

               @endforeach
                </form>
            </div>
        </div>
    </div>
@endsection