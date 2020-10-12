@extends('master')
@section('menu')
@section('title','Test result list')
@parent
@endsection
@section('content')
    <div class="">
        <div class="header-index">
        <div class="header-title">
                    <span>Test result list</span>
                </div>
            {{--<a class="btn btn-primary add-new-btn" href="{{url('res-list/new')}}" role="button">Create new</a>--}}
            {{--@if (\Session::has('success'))--}}
                {{--<div class=" alert alert-success alert-dismissible fade show">--}}
                    {{--{{ \Session::get('success') }}--}}
                {{--</div>    --}}
            {{--@endif--}}
        </div>
        <div class="card card-default mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form method="get" id="search_form" action="">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="firstname">First name</label>
                                        <input type="text" class="form-control" id="candidate_firstname"  name="candidate_firstname" value="{{old('candidate_firstname',$req_arr['candidate_firstname'])}}" placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="lastname">Last name</label>
                                        <input type="text" class="form-control" id="candidate_lastname"  name="candidate_lastname" value="{{old('candidate_lastname',$req_arr['candidate_lastname'])}}" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="candidate_address"  name="candidate_address" value="{{old('candidate_address',$req_arr['candidate_address'])}}" placeholder="Address">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="tel">Tel</label>
                                        <input type="text" class="form-control {{ ($errors->first('candidate_tel')) ? 'is-invalid'  :'' }}" id="candidate_tel" name="candidate_tel" value="{{old('candidate_tel',$req_arr['candidate_tel'])}}" placeholder="Tel">
                                        <div class="invalid-feedback">
                                            @error('candidate_tel')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="mail">Mail</label>
                                        <input type="text" class="form-control {{ ($errors->first('candidate_mail')) ? 'is-invalid'  :'' }}" id="candidate_mail" name="candidate_mail" value="{{old('candidate_mail',$req_arr['candidate_mail'])}}"  placeholder="Mail">
                                        <div class="invalid-feedback">
                                            @error('candidate_mail')
                                            {{ $message }}
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="language">Language</label>
                                        <select class="form-control" name="candidate_language" >
                                            <option value="0" >Please choose language</option>
                                            @foreach($cst_lang As $k => $v){
                                            <option value="{{$k}}" {{ old('candidate_language',$req_arr['candidate_language']) == $k ? "selected"  : "" }}>{{$v}}</option>
                                            }
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{--<div class="col-12 col-md-4">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="dob">DOB</label>--}}
                                        {{--<input type="text" class="form-control" id="candidate_dob"  name="candidate_dob" value="{{old('candidate_dob',$req_arr['candidate_dob'])}}" placeholder="DOB">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn btn-primary">Search</button>
                                    <a role="button" href="{{url('result-list')}}" class="btn btn-secondary btn-form" >Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @if (isset($list_result) && $list_result_count > 0)
        <div class="row">
            <div class="col-12">
        <div class="table-responsive">
            <table id ="table_list_result" class="table table-bordered table-hover ">
                <thead class="table-header">
                    <tr>
                        <th width="5%" scope="col">No.</th>
                        <th width="10%" scope="col">Candidate ID</th>
                        <th width="10%" scope="col">First name</th>
                        <th width="10%" scope="col">Last name</th>
                        <th width="10%" scope="col">Tel</th>
                        <th width="10%" scope="col">Address</th>
                        <th width="10%" scope="col">Mail</th>
                        <th width="10%" scope="col">Language</th>
                        <th width="10%" scope="col">DOB</th>
                        <th width="20%" scope="col">Action</th>
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
                    function getProgammingLanguage($lang,$lang_arr){
                        $lg = '';
                        foreach ($lang_arr as $k => $v){
                            if($lang == $k){
                            $lg = $v;
                            }
                        }
                        return $lg;
                    }

                    @endphp



                    @foreach($list_result as $result)
                        <tr>
                            <th width="5%">{{ $index < 10 ? '0' . $index : $index }}</th>
                            <td width="10%">{{ $result->candidate_id }}</td>
                            <td width="10%">{{ $result->candidate_firstname }}</td>
                            <td width="10%">{{ $result->candidate_lastname }}</td>
                            <td width="10%">{{ $result->candidate_tel }}</td>
                            <td width="10%">{{ $result->candidate_address }}</td>
                            <td width="10%">{{ $result->candidate_mail }}</td>
                            <td width="10%">{{ getProgammingLanguage($result->candidate_language ,$cst_lang) }}</td>
                            <td width="10%">{{ $result->candidate_dob }}</td>
                            <td id="link" width="20%">
                                <a href="{{ url('result-iq/' . $result->id) }}">IQ Test result  </a> /
                                <a href="{{url('result-tech/'.$result->id)}}" style="color: {{$result->is_marked ? 'red' : '' }}">Tech test result</a>
                            </td>
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
                <div>{{ $list_result->appends(Request::except('page'))->links() }}</div>
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