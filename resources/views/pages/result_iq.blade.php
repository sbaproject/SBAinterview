@extends('master')
@section('title','IQ Test Result')
@section('menu')
    @parent
@endsection
@section('content')

    <div class="">
        <div class="row">
            <div class="col-12 col-lg-4 col-sm-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="font-weight-bold text-primary ">Number of questions : <span class="text-success">{{$count_iq_question}}</span></div>
                        <div class="font-weight-bold text-primary">Result : <span class="text-success">{{$count_correct}} / {{$count_iq_question *10}}</span></div>
                    </div>
                </div>
            </div>
        </div>
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
                    <div class="question-group">
                        <div class="form-group">
                            <div for="formiqQuestion_content" class="font-weight-bold">Câu {{$n}}. </div>
                            <label for="formiqQuestion_content" class="font-weight-bold">{!! html_entity_decode($question['content']) !!} </label>
                            @foreach($question['list_option'] As $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="option_value[{{$n-1}}]"  value="{{$option['id']}}" disabled {{$option['id'] == $question['question_options_id'] ? 'checked' : ''}} >
                                    <label class="form-check-label" for="option_value">
                                        {{$option['option_value']}}
                                    </label>
                                        @if($option['id'] == $question['question_options_id'] && $option['correct_flg'] == 1 )
                                            <span>
                                                <img src ='images/correct.png' style="vertical-align: baseline "></img>
                                            </span>
                                       @endif
                                        @if($option['id'] == $question['question_options_id'] && $option['correct_flg'] == 0 )
                                            <span>
                                                    <img src ='images/wrong.png' style="vertical-align: baseline "></img>
                                                </span>
                                        @endif
                                        @if($option['correct_flg'] == 1)
                                            <span>
                                                <img src ='images/correct.png' style="vertical-align: baseline "></img>
                                            </span>
                                        @endif

                                </div>
                            @endforeach
                        </div>

                    </div>
               @endforeach
                </form>
            </div>
        </div>
    </div>
@endsection