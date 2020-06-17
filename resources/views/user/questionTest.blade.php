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
                    {{ Form::open(['route'=>['postResultTech'], 'method' => 'POST', 'class'=>'infoForm']) }}
                    <input type="hidden" name="typetech" value="{{$type}}" />
                    <div class="listtest">
                        <div id="listquestion">
                            @foreach($data as $key => $item)
                            <div class="test">
                                <div class="question"><strong>{{$key+1}}.</strong> <div>{!!$item->content!!}</div></div>
                                <div class="anser">
                                    <textarea rows="6" id="aws-{{$key}}" name="tech[{{$item->id}}]"></textarea>
                                </div>
                            </div> 
                            @endforeach
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;">SAVE/TEST IQ</button>
                            <!-- <a href="{{route('postUserTest', 'IQ')}}" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;" data-toggle="button">TEST IQ</a> -->
                        </div>
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
<script src="{{URL::asset('frontEnd/countdown/jquery.countdown.js')}}" type="text/javascript"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    $(document).ready(function() {
        var time = 0;
        var d = localStorage.getItem('time');
        if(!d) {
            time = new Date().getTime() + 1000  * 60 * 45;
        } else {
            var a = d.split(':');
            var second = 1000 * 60 * parseInt(a[0]) + parseInt(a[1])*1000;
            time = new Date().getTime() + second ;
        }
        $('#clock1').countdown(time)
        .on('update.countdown', function(event) {
            var $this = $(this);   
            localStorage.setItem('timeTECH', event.strftime('%M:%S'));       
            $this.html(event.strftime('<span style="font-size: 23px; color: #FFC300;">%M:%S</span>'));
        }).on('finish.countdown', function(event){
            alert("Hết thời gian làm bài test, vui lòng lưu bài và tiếp tục.");
            $('#listquestion').css('display', 'none');
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
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
  @foreach($data as $k => $v)
  CKEDITOR.replace( 'aws-' + {{$k}}, options);
  @endforeach
</script>
@endsection