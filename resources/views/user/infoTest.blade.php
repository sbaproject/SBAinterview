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
                    {{ Form::open(['route'=>['postUserTest'], 'method' => 'POST', 'class'=>'infoForm']) }}
                    <div class="infouser">
                        <table class="table table-bordered table-striped" id="users">
                            <tbody>
                                <tr>
                                    <td style="width: 30%;">FullName</td>
                                    <td>Nguyễn Văn B</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>ABC, Quận 1, TP HCM</td>
                                </tr>
                                <tr>
                                    <td>Birthday</td>
                                    <td>20/2/2020</td>
                                </tr>
                                <tr>
                                    <td>Tel</td>
                                    <td>0987654321</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>abc@gmail.com</td>
                                </tr>
                                <tr>
                                    <td>Programing Language</td>
                                    <td>
                                        <div class="optiongroup">
                                            <label>
                                                <span><i class="fa fa-check" aria-hidden="true"></i> PHP</span>
                                            </label>
                                            <label>
                                                <span><i class="fa fa-check" aria-hidden="true"></i> ASP.Net</span>
                                            </label>
                                            <label>
                                                <span><i class="fa fa-check" aria-hidden="true"></i> Javascript</span>
                                            </label>
                                            <label>
                                                <span><i class="fa fa-check" aria-hidden="true"></i> Jquery</span>
                                            </label>
                                            <label>
                                                <span><i class="fa fa-check" aria-hidden="true"></i> React Js</span>
                                            </label>
                                        </div>
                                        <div class="optiongroup">
                                            <label>
                                                <span><i class="fa fa-check" aria-hidden="true"></i> Angular Js</span>
                                            </label>
                                            <label>
                                                <span><i class="fa fa-check" aria-hidden="true"></i> Vue Js</span>
                                            </label>
                                            <label>
                                                <span><i class="fa fa-check" aria-hidden="true"></i> Node Js</span>
                                            </label>
                                            <label>
                                                <span><i class="fa fa-check" aria-hidden="true"></i> App Mobile</span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Select the test</td>
                                    <td>
                                        <select name="selecttest">
                                            <option value="0">-- Select the test</option>
                                            <option value="1">PHP</option>
                                            <option value="2">.NET</option>
                                            <option value="3">IQ</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-responsive button-alignment btn-primary" style="margin-bottom:7px;" data-toggle="button">Bắt Đầu Thi</button>
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
@endsection