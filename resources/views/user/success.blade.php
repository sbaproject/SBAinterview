@extends('user.includes.layout')
@section('headInclude')
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center">CHÚC MỪNG BẠN ĐÃ HOÀN THÀNH BÀI TEST CỦA STARBOARD ASIA</h4>
                <h4 class="text-center">TEST TECHNICAL: {{$tech_total}}</h4>
                <h4 class="text-center">TEST IQ: {{$iq_total}}</h4>
                <h2 class="text-center">THANKS YOU!</h2>      
                <div class="text-center">
                    <div class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;">
                        <div class="timeexit">
                            <div id="clock1">10</div>
                        </div>
                    </div>          
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
        var fiveSeconds = new Date().getTime() + 1000 * 10;
        $('#clock1').countdown(fiveSeconds)
        .on('update.countdown', function(event) {
            var $this = $(this);             
            $this.html(event.strftime('<span style="font-size: 23px; color: #FFC300;">EXIT(%S)</span>'));
        })
        .on('finish.countdown', function(event){
            localStorage.clear();
            window.location.href = "/logout";
        });
    });   
</script>
@endsection