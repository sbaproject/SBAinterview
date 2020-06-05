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
                    {{ Form::open(['route'=>['postUserHome'], 'method' => 'POST', 'class'=>'infoForm']) }}
                    <div class="infouser">
                        <table class="table table-bordered table-striped" id="users">
                            <tbody>
                                <tr>
                                    <td style="width: 30%;">FullName</td>
                                    <td>
                                        <input type="text" name="name" require>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><input type="text" name="address" require></td>
                                </tr>
                                <tr>
                                    <td>Birthday</td>
                                    <td><input type="text" name="dob" id="dob" data-date-format="DD-MM-YYYY" placeholder="dd-mm-yyyy" require></td>
                                </tr>
                                <tr>
                                    <td>Tel</td>
                                    <td><input type="text" name="tel" require></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" name="email" require></td>
                                </tr>
                                <tr>
                                    <td>Programing Language</td>
                                    <td>
                                        <div class="optiongroup">
                                            <label>
                                                <input type="checkbox" name="skills[]" value="php"> 
                                                <div class="checkboxcss"></div>
                                                <span>PHP</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="skills[]" value="ASP.Net"> 
                                                <div class="checkboxcss"></div>
                                                <span>ASP.Net</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="skills[]" value="Javascript"> 
                                                <div class="checkboxcss"></div>
                                                <span>Javascript</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="skills[]" value="Jquery"> 
                                                <div class="checkboxcss"></div>
                                                <span>Jquery</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="skills[]" value="React Js"> 
                                                <div class="checkboxcss"></div>
                                                <span>React Js</span>
                                            </label>
                                        </div>
                                        <div class="optiongroup">
                                            <label>
                                                <input type="checkbox" name="skills[]" value="Angular Js"> 
                                                <div class="checkboxcss"></div>
                                                <span>Angular Js</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="skills[]" value="Vue Js"> 
                                                <div class="checkboxcss"></div>
                                                <span>Vue Js</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="skills[]" value="Node Js"> 
                                                <div class="checkboxcss"></div>
                                                <span>Node Js</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="skills[]" value="App Mobile"> 
                                                <div class="checkboxcss"></div>
                                                <span>App Mobile</span>
                                            </label>
                                        </div>
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
@endsection