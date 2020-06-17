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
                        <h2>TEST IQ</h2>
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
                        <div id="listquestion">
                            @foreach($data['q'] as $k => $v)
                            <div class="test">
                                <div class="question"><strong>{{$k+1}}.</strong> <div>{!!$v['content']!!}</div></div>
                                <div class="anser">
                                    @foreach($v['option'] as $val)
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
<footer></footer>
@endsection
@section('footInclude')
<script src="{{URL::asset('js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('frontEnd/countdown/jquery.countdown.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        var time = 0;
        var d = localStorage.getItem('timeIQ');
        if(!d) {
            time = new Date().getTime() + 1000  * 60 * 30;
        } else {
            var a = d.split(':');
            var second = (1000 * 60 * parseInt(a[0]) + parseInt(a[1])*1000);
            time = new Date().getTime() + second ;
        }
        $('#clock1').countdown(time)
        .on('update.countdown', function(event) {
            var $this = $(this);   
            localStorage.setItem('timeIQ', event.strftime('%M:%S'));       
            $this.html(event.strftime('<span style="font-size: 23px; color: #FFC300;">%M:%S</span>'));
        }).on('finish.countdown', function(event){
            alert("hết thời gian làm bài test IQ lưu bài và thoát.");
            $('#listquestion').css('display', 'none');
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
