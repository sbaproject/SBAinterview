@extends('user.includes.layout')
@section('headInclude')
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">TEST IQ</h2>
            </div>
            <div class="col-md-12">
                <div class="panel-body">
                    {{ Form::open(['route'=>['postUserHome'], 'method' => 'POST', 'class'=>'infoForm']) }}
                    <div class="listtest">
                        <?php
                            for($i = 1; $i <= 10; $i++){
                        ?>
                        <div class="test">
                            <div class="question"><strong>{{$i}}.</strong> Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies.</div>
                            <div class="anser">
                                <label>
                                    <input type="radio" name="anser[{{$i}}]" />
                                    <div class="radioboxcss"></div>
                                    <span>Proin nunc justo felis mollis tincidunt, risus risus pede, posuere cubilia Curae. </span>
                                </label>
                                <label>
                                    <input type="radio" name="anser[{{$i}}]" />
                                    <div class="radioboxcss"></div>
                                    <span>Proin nunc justo felis mollis tincidunt, risus risus pede, posuere cubilia Curae. </span>
                                </label>
                                <label>
                                    <input type="radio" name="anser[{{$i}}]" />
                                    <div class="radioboxcss"></div>
                                    <span>Proin nunc justo felis mollis tincidunt, risus risus pede, posuere cubilia Curae. </span>
                                </label>
                                <label>
                                    <input type="radio" name="anser[{{$i}}]" />
                                    <div class="radioboxcss"></div>
                                    <span>Proin nunc justo felis mollis tincidunt, risus risus pede, posuere cubilia Curae. </span>
                                </label>
                            </div>
                        </div> 
                        <?php } ?>
                    </div>                  
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footInclude')
<script src="{{URL::asset('js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/user.js')}}" type="text/javascript"></script>
@endsection