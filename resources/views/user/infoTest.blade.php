@extends('user.includes.layout')
@section('headInclude')
<link href="{{URL::asset('frontEnd/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">THÔNG TIN ỨNG VIÊN</h2>
            </div>
            <div class="col-md-12">
                <div class="panel-body">
                    <input type="hidden" name="userId" value="{{$userId}}">
                    <div class="infouser">
                        <table class="table table-bordered table-striped" id="users">
                            <tbody>
                                <tr>
                                    <td style="width: 30%;">Candidate ID</td>
                                    <td>
                                        {{$data['candidate_id']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">FullName</td>
                                    <td>{{$data['candidate_firstname']}} {{$data['candidate_lastname']}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{$data['candidate_address']}}</td>
                                </tr>
                                <tr>
                                    <td>Birthday</td>
                                    <td>{{$data['candidate_dob']}}</td>
                                </tr>
                                <tr>
                                    <td>Tel</td>
                                    <td>{{$data['candidate_tel']}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$data['candidate_mail']}}</td>
                                </tr>
                                <tr>
                                    <td>Programing Language</td>
                                    <td>
                                        <label>
                                            <span><i class="fa fa-check" aria-hidden="true"></i> {{Config::get('constants.LANGUAGE.'.$data['candidate_language'])}}</span>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a href="{{route('userHomeEditById', $userId)}}" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;">Nhập lại</a>
                        <a href="{{route('getName', $data['candidate_id'])}}" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;">Bắt Đầu Thi</a>
                    </div>
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
@endsection