@extends('master')
@section('title','Tech Test Result')
@section('menu')
    @parent
@endsection
@section('content')

    <div class="">
        {{--<div class="row">--}}
            {{--<div class="col-4 col-sm 12 mb-2">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-body">--}}
                        {{--<div class="font-weight-bold text-primary ">Number of questions : <span class="text-success">{{$count_tech_question}}</span></div>--}}
                        {{--<div class="font-weight-bold text-primary">Score : <span class="text-success"></span></div>--}}
                        {{--<div class="pt-2">--}}
                            {{--@if ($is_marked == 0)--}}
                                {{--<button role="button"  class="btn btn-primary btn-form to_mark" result_id = "{{$result_id}}">Mark</button>--}}
                            {{--@else--}}
                                {{--<button role="button"  class="btn btn-primary btn-form to_mark" result_id = "{{$result_id}}" >Re-mark</button>--}}
                            {{--@endif--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
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
                      //  var_dump($list_tech_question_arr);die;
                            $n = $n +1;
                        @endphp
                        {{--<input type="hidden"  class="form-control" name="result_id" id="result_id" value="{{ $question['result_id'] }}">--}}
                        {{--<div    id="result_id" value="{{ $question['result_id'] }}" style="display: none;"></div>--}}
                        <div class="font-weight-bold" for="question_content"><span>{{$n}}. </span>{!! $question['content'] !!}</div>
                        <div class="pl-4 mb-2">{!! html_entity_decode($question['tech_content_ans']) !!}</div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Score</span>
                                </div>
                                <input type="text"   class="form-control score_class {{ ($errors->first('score_'.$question['id'])) ? 'is-invalid'  :'' }}"  name="score_{{$question['id']}}" value="{{ old('score_'.$question['id'], $question['score'] )}}"
                                          >
                                <div class="invalid-feedback">
                                    @error('score_'.$question['id'])
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div id="button_group" >
                            <div class="form-group-button">
                                <button type="submit"  class="btn btn-primary btn-form btn-left">Update</button>
                                <a role="button" href="{{url('result-tech')}}/{{$question['result_id']}}" class="btn btn-secondary btn-form" >Cancel</a>
                            </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            @for($i =count($list_tech_question_arr)-1;$i>-1;$i--)
                @if($errors->first('score_'.$list_tech_question_arr[$i]['id']))
                    @php
                        $name = 'score_'.$list_tech_question_arr[$i]['id'];
                    @endphp
                    $("input[name='{{$name }}']").focus();
                @endif
            @endfor
            {{--@foreach($list_tech_question_arr As $question)--}}
                    {{--@if($errors->first('score_'.$question['id']))--}}
                      {{--@php--}}
                          {{--$name = 'score_'.$question['id'];--}}
                      {{--@endphp--}}
                        {{--$("input[name='{{$name }}']").focus();--}}
                    {{--@endif--}}
            {{--@endforeach--}}
        });

    </script>

@endsection

