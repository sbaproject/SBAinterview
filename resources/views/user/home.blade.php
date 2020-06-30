@extends('user.includes.layout')
@section('headInclude')
<link href="{{URL::asset('frontEnd/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">CANDIDATE INFORMATION</h2>
            </div>
            <div class="col-md-12">
                <div class="panel-body">
                    {{ Form::open(['route'=>['postUserHome'], 'method' => 'POST', 'class'=>'infoForm', 'autocomplete' => 'off']) }}
                    <div class="infouser">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <table class="table table-bordered table-striped" id="users">
                            <tbody>
                                <tr>
                                    <td style="width: 30%;">Candidate ID <span style="color:red">(*)</span></td>
                                    <td class="candidateid">
                                        <input type="text" name="candidate_id" value="{{old('candidate_id')}}" id="candidate_id" required>
                                        <div class="alert alert-danger" role="alert" style="display:none" id="errorcandi">Candidate not found</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Last Name</td>
                                    <td>
                                        <input type="text" name="lastname" value="{{old('lastname')}}" id="lastname">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">First Name</td>
                                    <td>
                                        <input type="text" name="firstname" value="{{old('firstname')}}" id="firstname">
                                    </td>
                                </tr>                                
                                <tr>
                                    <td>Address</td>
                                    <td><input type="text" name="address" value="{{old('address')}}" id="address"></td>
                                </tr>
                                <tr>
                                    <td>Birthday</td>
                                    <td><input type="text" name="dob" value="{{old('dob')}}" id="dob" data-date-format="DD-MM-YYYY" placeholder="dd-mm-yyyy"></td>
                                </tr>
                                <tr>
                                    <td>Tel</td>
                                    <td><input type="text" name="tel" value="{{old('tel')}}" id="tel"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" name="email" value="{{old('email')}}" id="email"></td>
                                </tr>
                                <tr>
                                    <td>Programing Language <span style="color:red">(*)</span></td>
                                    <td>
                                        <select name="selecttest" id="in_language">
                                            <option value="0">-- Select the test</option>
                                            <option value="1" @if(old('selecttest') == 1) selected @endif>{{Config::get('constants.LANGUAGE.1')}}</option>
                                            <option value="2" @if(old('selecttest') == 2) selected @endif>{{Config::get('constants.LANGUAGE.2')}}</option>
                                            <option value="3" @if(old('selecttest') == 3) selected @endif>{{Config::get('constants.LANGUAGE.3')}}</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;" data-toggle="button">SENT</button>
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
<script src="{{URL::asset('frontEnd/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/user.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $('#candidate_id').on('keyup', function(){
            var is = $(this);
            var id = $('#candidate_id').val();
            if(id == ""){
                $('#errorcandi').css('display','none');
            }else{
                $.ajax({
                    type: 'GET',
                    url: '{{Request::root()}}/ung-vien/load-candidate/' + id,
                    success: function(msg){
                        
                        if(msg != "error"){
                            var d = "", r = "";
                            if(msg.in_dob != null){
                                 d = msg.in_dob.split('-');
                                 r = d[2] + "-" + d[1] + "-" + d[0];
                            }else{
                                d = "";
                            }
                            $('#firstname').val(msg.in_firstname);
                            $('#lastname').val(msg.in_lastname);
                            $('#address').val(msg.in_address);
                            $('#dob').val(r);
                            $('#tel').val(msg.in_tel);
                            $('#email').val(msg.in_mail);                            
                            $('#in_language').val(msg.in_language.toString());
                            $('#errorcandi').css('display','none');
                        }else{
                            $('#errorcandi').css('display','block');
                            $('#firstname').val("");
                            $('#lastname').val("");
                            $('#address').val("");
                            $('#dob').val("");
                            $('#tel').val("");
                            $('#email').val("");
                            $('#in_language').val(0);
                        }
                    }
                });
            }
        });
        //
        $("#dob").datetimepicker({
            format: 'DD-MM-YYYY',
            widgetPositioning:{
                vertical:'bottom'
            },
            useCurrent: false,
        });
    });
</script>
@endsection