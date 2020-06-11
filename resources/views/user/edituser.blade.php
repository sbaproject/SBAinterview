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
                    {{ Form::open(['route'=>['postUserHomeEditById'], 'method' => 'POST', 'class'=>'infoForm', 'autocomplete' => 'off']) }}
                    <input type="hidden" name="userId" value="{{$data->id}}">
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
                                    <td style="width: 30%;">Candidate ID</td>
                                    <td>
                                        <input type="text" name="candidate_id" value="{{$data->candidate_id}}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">First Name</td>
                                    <td>
                                        <input type="text" name="firstname" value="{{$data->candidate_firstname}}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Last Name</td>
                                    <td>
                                        <input type="text" name="lastname" value="{{$data->candidate_lastname}}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><input type="text" name="address" value="{{$data->candidate_address}}" required></td>
                                </tr>
                                <tr>
                                    <td>Birthday</td>
                                    <td><input type="text" name="dob" value="{{$data->candidate_dob}}" id="dob" data-date-format="DD-MM-YYYY" placeholder="dd-mm-yyyy" required></td>
                                </tr>
                                <tr>
                                    <td>Tel</td>
                                    <td><input type="text" name="tel" value="{{$data->candidate_tel}}" required></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" name="email" value="{{$data->candidate_mail}}" required></td>
                                </tr>
                                <tr>
                                    <td>Programing Language</td>
                                    <td>
                                        <select name="selecttest">
                                            <option value="0">-- Select the test</option>
                                            <option value="1" @if($data->candidate_language == 1) selected @endif>{{Config::get('constants.LANGUAGE.1')}}</option>
                                            <option value="2" @if($data->candidate_language == 2) selected @endif>{{Config::get('constants.LANGUAGE.2')}}</option>
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