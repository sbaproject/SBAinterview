@extends('user.includes.layout')
@section('headInclude')
@endsection
@section('content')
<section>
    <div id="scrollbar" class="scrollbar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="toptest">
                        <h2>TEST {{Config::get('constants.LANGUAGE.'.$type)}}</h2>
                        <div class="counttime">
                            <div id="clock1">45:00</div>
                            <div id="clock2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-body">
                    {{ Form::open(['route'=>['postResultIQ'], 'method' => 'POST', 'class'=>'infoForm']) }}
                    <div class="listtest">
                        @foreach($data['q'] as $k => $v)
                        <div class="test">
                            <div class="question"><strong>{{$k+1}}.</strong> {{$v['content']}}</div>
                            <div class="anser">
                                @foreach($v['option'] as $key => $val)
                                <label>
                                    <input type="radio" name="anser[{{$v['id']}}]" value="{{$val->id}}"/>
                                    <div class="radioboxcss"></div>
                                    <span>{{$val->option_value}}</span>
                                </label>
                                @endforeach
                            </div>
                        </div> 
                        @endforeach
                    </div>                  
                    <div class="text-center">
                        <button type="submit" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;" data-toggle="button">SAVE/EXIT</button>
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
<script src="{{URL::asset('frontEnd/countdown/jquery.countdown.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        var fiveSeconds = new Date().getTime() + 1000 * 30 * 60;
        $('#clock1').countdown(fiveSeconds)
        .on('update.countdown', function(event) {
            var $this = $(this);             
            $this.html(event.strftime('<span style="font-size: 23px; color: #FFC300;">%M:%S</span>'));
        });
    });   
    //
    window.onscroll = function() {myFunction()};

    var navbar = document.getElementById("scrollbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>
@endsection