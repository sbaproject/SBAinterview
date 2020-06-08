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
                                        <label for="fullname">Full name</label>
                                        <input type="in_name" class="form-control" id="in_name"  name="in_name" value="{{old('in_name',$req_arr['in_name'])}}" placeholder="Full name">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="address">Adress</label>
                                        <input type="in_address" class="form-control" id="in_address"  name="in_address" value="{{old('in_address',$req_arr['in_address'])}}" placeholder="Address">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="dob">DOB</label>
                                        <input type="in_dob" class="form-control" id="in_dob"  name="in_dob" value="{{old('in_dob',$req_arr['in_dob'])}}" placeholder="DOB">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="tel">Tel</label>
                                        <input type="in_tel" class="form-control {{ ($errors->first('in_tel')) ? 'is-invalid'  :'' }}" id="in_tel" name="in_tel" value="{{old('in_tel',$req_arr['in_tel'])}}" placeholder="Tel">
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
                                        <input type="in_mail" class="form-control {{ ($errors->first('in_mail')) ? 'is-invalid'  :'' }}" id="in_mail" name="in_mail" value="{{old('in_mail',$req_arr['in_mail'])}}"  placeholder="Mail">
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
                                            <option value="1" {{ old('in_language',$req_arr['in_language']) == 1 ? "selected"  : "" }}>PHP</option>
                                            <option value="2" {{ old('in_language',$req_arr['in_language']) == 2 ? "selected"  : "" }}>C#/ASP.NET</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn btn-primary">Search</button>
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
                        <th width="10%" scope="col">Name</th>
                        <th width="10%" scope="col">DOB</th>
                        <th width="10%" scope="col">Mail</th>
                        <th width="10%" scope="col">Language</th>
                        <th width="10%" scope="col">Tel</th>
                        <th width="10%" scope="col">Status</th>
                        <th width="5%" scope="col">Time</th>
                        <th width="10%" scope="col">date</th>
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
                         function getStatusInterview_lay($status){
                           $status_arr = array(
                               0 => '',
                               1 => 'Phone&mail contacted',
                               2 => 'Interviewed',
                               3 => 'Cancelled interview',
                               4 => 'Not pass Contacted'
                           );
                           $status_res = '';
                           foreach ($status_arr as $key => $val){
                               if ($status == $key){
                                   $status_res = $val;
                               }
                           }
                           return $status_res;

                       }
                    @endphp

                    @foreach($list_interviewers as $interviewer)
                        <tr>
                            <th width="5%">{{ $index < 10 ? '0' . $index : $index }}</th>
                            <td width="10%">{{ $interviewer->in_cvno }}</td>
                            <td width="10%">{{ $interviewer->in_name }}</td>
                            <td width="10%">{{ $interviewer->in_dob }}</td>
                            <td width="10%">{{ $interviewer->in_mail }}</td>
                            <td width="10%">{{ $interviewer->in_language == 1 ? 'PHP' : 'C#/ASP.NET' }}</td>
                            <td width="10%">{{ $interviewer->in_tel }}</td>
                            <td width="10%">{{ getStatusInterview_lay($interviewer->in_status) }}</td>
                            <td width="5%">{{ date('H:i',strtotime($interviewer->in_time )) }}</td>
                            <td width="10%">{{ $interviewer->in_date }}</td>
                            <td id="link" width="10%"><a href="{{ url('interview-management/edit/' . $interviewer->in_id) }}">Edit / </a>&nbsp;<a href="{{ url('interview-management/delete/' . $interviewer->in_id) }}" style="color: red;">Delete</a></td>
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