@extends('master')
@section('title','Tech Test Result')
@section('menu')
    @parent
@endsection
@section('content')

    <div class="">
        <div class="row">
            <div class="col-12 col-lg-4 col-sm-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="font-weight-bold text-primary ">Number of questions : <span class="text-success">{{$count_tech_question}}</span></div>
                        <div class="font-weight-bold text-primary">Status : <span class="text-success">{{$is_marked ? 'Marked' : 'Not marked yet'}}</span></div>
                        @if($is_marked)
                            <div class="font-weight-bold text-primary">Score : <span class="text-success">{{$total_score}}</span></div>
                        @endif

                        <div class="pt-2">
                            @if ($is_marked == 0 && $count_tech_question >0)
                                <a role="button" href="{{url('result-tech/mark').'/'.$result_id}}" class="btn btn-primary btn-form to_mark" >Mark</a>
                            @elseif($is_marked != 0 && $count_tech_question >0)
                                <a role="button" href="{{url('result-tech/mark').'/'.$result_id}}" class="btn btn-primary btn-form to_mark"  >Re-mark</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="staff_new_edit_frm" class="col-xl-10 col-lg-10 col-md-10 col-sm-12">
                <h2 class="border-bottom">
                    Tech Test Result
                </h2>
                <form method="post">
                    @csrf
                         @php
                            $n =0;
                         @endphp
                    @foreach($list_tech_question_arr As $question)
                        @php
                            $n = $n +1;
                        @endphp
                        <input    id="result_id" value="{{ $question['result_id'] }}" type="hidden">
                        <div class="font-weight-bold" for="question_content"><span>{{$n}}. </span>{!! $question['content'] !!}</div>
                        <div class="pl-4 mb-2 ">{!! html_entity_decode($question['tech_content_ans']) !!}</div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Score</span>
                                </div>
                                <input type="text"  class="form-control score_class {{ ($errors->first('score_'.$question['id'])) ? 'is-invalid'  :'' }}"  name="score_{{$question['id']}}" value="{{ old('score_'.$question['id'], $question['score'] )}}"
                                readonly>

                            </div>
                        </div>

               @endforeach

                </form>
            </div>
        </div>
    </div>

@endsection

