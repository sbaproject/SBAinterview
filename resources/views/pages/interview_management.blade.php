@extends('master')
@section('title','Interview Management')
@section('menu')
@parent
@endsection
@section('content')
    <div class="padding-20">
        <div class="header-index">
        <div class="header-title">
                    <span>Interview Management</span>
                </div>
            <a class="btn btn-primary add-new-btn" href="{{url('interview-management/new')}}" role="button">Create new</a>
            @if (\Session::has('success'))
                <div class=" alert alert-success alert-dismissible fade show">
                    {{ \Session::get('success') }}
                </div>    
            @endif
        </div>

        <div class="card card-default mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form method="get" id="search_form" action="">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="firstname">First name</label>
                                        <input type="text" class="form-control" id="in_firstname"  name="in_firstname" value="{{old('in_firstname',$req_arr['in_firstname'])}}" placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="lastname">Last name</label>
                                        <input type="text" class="form-control" id="in_lastname"  name="in_lastname" value="{{old('in_lastname',$req_arr['in_lastname'])}}" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="address">Adress</label>
                                        <input type="text" class="form-control" id="in_address"  name="in_address" value="{{old('in_address',$req_arr['in_address'])}}" placeholder="Address">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="tel">Tel</label>
                                        <input type="text" class="form-control {{ ($errors->first('in_tel')) ? 'is-invalid'  :'' }}" id="in_tel" name="in_tel" value="{{old('in_tel',$req_arr['in_tel'])}}" placeholder="Tel">
                                        <div class="invalid-feedback">
                                            @error('in_tel')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="mail">Mail</label>
                                        <input type="text" class="form-control {{ ($errors->first('in_mail')) ? 'is-invalid'  :'' }}" id="in_mail" name="in_mail" value="{{old('in_mail',$req_arr['in_mail'])}}"  placeholder="Mail">
                                        <div class="invalid-feedback">
                                            @error('in_mail')
                                            {{ $message }}
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="language">Language</label>
                                        <select class="form-control" name="in_language" >
                                            <option value="0" >Please choose language</option>
                                            @foreach($cst_lang As $k => $v){
                                            <option value="{{$k}}" {{ old('in_language',$req_arr['in_language']) == $k ? "selected"  : "" }}>{{$v}}</option>
                                            }
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="dob">DOB</label>
                                        <input type="text" class="form-control" id="in_dob"  name="in_dob" value="{{old('in_dob',$req_arr['in_dob'])}}" placeholder="DOB">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="language">CV channel</label>
                                        <select class="form-control" name="in_cvchannel" >
                                            <option value="0" >Please choose CV channel</option>
                                                @foreach($cst_cvchannel As $k1 => $v1){
                                                    <option value="{{$k1}}" {{ old('in_cvchannel',$req_arr['in_cvchannel']) == $k1 ? "selected"  : "" }}>{{$v1}}</option>
                                                }
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn btn-primary">Search</button>
                                    <a role="button" href="{{url('interview-management')}}" class="btn btn-secondary btn-form" >Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @if (isset($list_interviewers) && $list_interviewers_count > 0)
        <div class="row">
            <div class="col-12">
        <div class="table-responsive">
            <table id ="table_staff" class="table table-bordered table-hover table-fixed">
                <thead class="table-header">
                    <tr>
                        <th width="5%" scope="col">No.</th>
                        <th width="10%" scope="col">CV No. </th>
                        <th width="10%" scope="col">CV Channel</th>
                        <th width="10%" scope="col">First name</th>
                        <th width="10%" scope="col">Last name</th>
                        <th width="10%" scope="col">DOB</th>
                        <th width="10%" scope="col">Mail</th>
                        <th width="5%" scope="col">Language</th>
                        <th width="10%" scope="col">Tel</th>
                        <th width="10%" scope="col">Status</th>
                        <th width="10%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Đánh số thứ tự theo trang --}}
                    @php
                        $page = request()->get("page");
                        if ($page)
                            $index = $page * 10 - 9;
                        else
                            $index = 1;

                    @endphp

                    @php
                         function getStatusInterview_lay($status,$status_arr){

                           $status_res = '';
                           foreach ($status_arr as $key => $val){
                               if ($status == $key){
                                   $status_res = $val;
                               }
                           }
                           return $status_res;

                       }
                    function getCVChannel_lay($channel,$channel_arr){
                        $channel_text = '';
                        foreach ($channel_arr as $kcn => $vcn){
                            if($channel == $kcn){
                                $channel_text = $vcn;
                            }
                        }
                        return $channel_text;
                    }
                    function getLanguage_lay($lang,$lang_arr){
                        $lag = '';
                        foreach ($lang_arr as $klg => $vlg){
                            if($lang == $klg){
                                $lag = $vlg;
                            }
                        }
                        return $lag;
                    }
                    @endphp

                    @foreach($list_interviewers as $interviewer)
                        <tr>
                            <th width="5%">{{ $index < 10 ? '0' . $index : $index }}</th>
                            <td width="10%">{{ $interviewer->in_cvno }}</td>
                            <td width="10%">{{ getCVChannel_lay($interviewer->in_cvchannel,$cst_cvchannel) }}</td>
                            <td width="10%">{{ $interviewer->in_firstname }}</td>
                            <td width="10%">{{ $interviewer->in_lastname}}</td>
                            <td width="10%">{{ $interviewer->in_dob }}</td>
                            <td width="10%">{{ $interviewer->in_mail }}</td>
                            <td width="5%">{{getLanguage_lay($interviewer->in_language ,$cst_lang)}}</td>
                            <td width="10%">{{ $interviewer->in_tel }}</td>
                            <td width="10%">{{ getStatusInterview_lay($interviewer->in_status,$cst_status) }}</td>
                            <td id="link" width="10%"><a href="{{ url('interview-management/edit/' . $interviewer->in_id) }}">Edit /
                                </a>&nbsp;<a href="{{ url('interview-management/delete/' . $interviewer->in_id) }}" style="color: red;"  onclick="return confirm('Are you sure to delete this item?')">Delete</a></td>
                        </tr>
                        @php
                            $index++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
            </div>
            </div>
            </div>
            <div class="pagination-container">
                <div>{{ $list_interviewers->links() }}</div>
            </div>
            @else
            <div class="row">
                <div class="md-12">
                    <div class="padding-20">
                        There are no results
                    </div>

                </div>
            </div>
        @endif
    </div>
@endsection