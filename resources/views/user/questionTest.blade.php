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
                    {{ Form::open(['route'=>['postTech'], 'method' => 'POST', 'class'=>'infoForm']) }}
                    <div class="listtest">
                        <?php
                            for($i = 1; $i <= 10; $i++){
                        ?>
                        <div class="test">
                            <div class="question"><strong>{{$i}}.</strong> Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies.</div>
                            <div class="anser">
                                <textarea rows="6"></textarea>
                            </div>
                        </div> 
                        <?php } ?>
                        <div class="text-center">
                            <button type="submit" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;" data-toggle="button">SAVE</button>
                            <a href="{{route('postUserTest', 'IQ')}}" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;" data-toggle="button">TEST IQ</a>
                        </div>
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
        var fiveSeconds = new Date().getTime() + 1000 * 45 * 60;
        $('#clock1').countdown(fiveSeconds)
        .on('update.countdown', function(event) {
            var $this = $(this);             
            $this.html(event.strftime('<span style="font-size: 23px; color: #FFC300;">%M:%S</span>'));
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
    });   
</script>
@endsection