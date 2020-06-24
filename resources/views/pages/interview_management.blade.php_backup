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
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Report test result</button>
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
                                        <label for="cvno">CV No.</label>
                                        <input type="text" class="form-control" id="in_cvno"  name="in_cvno" value="{{old('in_cvno',$req_arr['in_cvno'])}}" placeholder="CV No.">
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
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="firstname">First name</label>
                                        <input type="text" class="form-control" id="in_firstname"  name="in_firstname" value="{{old('in_firstname',$req_arr['in_firstname'])}}" placeholder="First name">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="lastname">Last name</label>
                                        <input type="text" class="form-control" id="in_lastname"  name="in_lastname" value="{{old('in_lastname',$req_arr['in_lastname'])}}" placeholder="Last name">
                                    </div>
                                </div>
                                {{--<div class="col-4">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="tel">Tel</label>--}}
                                        {{--<input type="text" class="form-control {{ ($errors->first('in_tel')) ? 'is-invalid'  :'' }}" id="in_tel" name="in_tel" value="{{old('in_tel',$req_arr['in_tel'])}}" placeholder="Tel">--}}
                                        {{--<div class="invalid-feedback">--}}
                                            {{--@error('in_tel')--}}
                                            {{--{{ $message }}--}}
                                            {{--@enderror--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
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
                                        <label for="language">Skill</label>
                                        <select class="form-control" name="in_language" >
                                            <option value="0" >Please choose skill</option>
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
                                        <label for="status">Status</label>
                                        <select class="form-control" name="in_status" >
                                            <option value="0" >Please choose a status</option>
                                            @foreach($cst_status As $k2 => $v2){
                                            <option value="{{$k2}}" {{ old('in_status',$req_arr['in_status']) == $k2 ? "selected"  : "" }}>{{$v2}}</option>
                                            }
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="status">Test time from</label>
                                        <div class="input-group mb-3">
                                            {{--<input type="text"  class="form-control "  name="in_date" value="{{ old('in_date') }}" >--}}
                                            <input id="date_from" readonly type="text" class="form-control datetimepicker-input"
                                                   name="date_from" autocomplete="off" value="{{ old('date_from', $req_arr['date_from']) }}">
                                            <div class="input-group-append" data-target="#date_from" onclick="$('#date_from').focus();">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="status">Test time to</label>
                                        <div class="input-group mb-3">
                                            {{--<input type="text"  class="form-control "  name="in_date" value="{{ old('in_date') }}" >--}}
                                            <input id="date_to" readonly type="text" class="form-control datetimepicker-input"
                                                   name="date_to" autocomplete="off" value="{{ old('date_to', $req_arr['date_to']) }}">
                                            <div class="input-group-append" data-target="#date_to" onclick="$('#date_to').focus();">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>

                                        </div>
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
                        <th width="10%" scope="col">Candidate_id</th>
                        <th width="10%" scope="col">CV No. </th>
                        <th width="10%" scope="col">CV Channel</th>
                        <th width="10%" scope="col">Last name</th>
                        <th width="10%" scope="col">First name</th>
                        {{--<th width="10%" scope="col">Mail</th>--}}
                        <th width="5%" scope="col">Skill</th>
                        {{--<th width="10%" scope="col">Tel</th>--}}
                        <th width="20%" scope="col">Note</th>
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
                            <td width="10%">{{ $interviewer->in_id }}</td>
                            <td width="10%">{{ $interviewer->in_cvno }}</td>
                            <td width="10%">{{ getCVChannel_lay($interviewer->in_cvchannel,$cst_cvchannel) }}</td>
                            <td width="10%">{{ $interviewer->in_lastname}}</td>
                            <td width="10%">{{ $interviewer->in_firstname }}</td>
                            {{--<td width="10%">{{ $interviewer->in_mail }}</td>--}}
                            <td width="5%">{{getLanguage_lay($interviewer->in_language ,$cst_lang)}}</td>
                            {{--<td width="10%">{{ $interviewer->in_tel }}</td>--}}
                            <td width="10%">{{ $interviewer->in_note }}</td>
                            <td width="10%">{{ getStatusInterview_lay($interviewer->in_status,$cst_status) }}</td>
                            <td id="link" width="10%"><a href="{{ url('interview-management/edit/' . $interviewer->in_id) }}">Edit /
                                </a>&nbsp;<a href="{{ url('interview-management/delete/' . $interviewer->in_id).'/'.$current_page }}" style="color: red;"  onclick="return confirm('Are you sure to delete this item?')">Delete</a></td>
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
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="chartContainer" style="height: 800px; width: 800px;">
                </div>


            </div>
        </div>
    </div>
    <!-- Modal -->
    <script type="text/javascript">
        // $(window).load(function () {
        //     $("#chartContainer").css("width", "800");
        //     var chart = new CanvasJS.Chart("chartContainer",
        //         {
        //             title:{
        //                 text: "Test result"
        //             },
        //             data: [
        //                 {
        //                     type: "stackedColumn",
        //                     showInLegend: true,
        //                     name: "series1",
        //                     legendText: "Apples",
        //                     dataPoints: [
        //                         { x: 10, y: 71 },
        //                         { x: 20, y: 55},
        //                         { x: 30, y: 50 },
        //                         { x: 40, y: 65 },
        //                         { x: 50, y: 95 },
        //                         { x: 60, y: 68 },
        //                         { x: 70, y: 28 },
        //                         { x: 80, y: 34 },
        //                         { x: 90, y: 14}
        //
        //                     ]
        //                 },
        //                 {
        //                     type: "stackedColumn",
        //                     legendText: "Oranges",
        //                     name: "series2",
        //                     showInLegend: true,
        //                     dataPoints: [
        //                         { x: 10, y: 7 },
        //                         { x: 20, y: 5},
        //                         { x: 30, y: 5 },
        //                         { x: 40, y: 16 },
        //                         { x: 50, y: 9 },
        //                         { x: 60, y: 61 },
        //                         { x: 70, y: 18 },
        //                         { x: 80, y: 14 },
        //                         { x: 90, y: 24}
        //
        //                     ]
        //                 }
        //             ]
        //         });
        //
        //     chart.render();
        //    // $("#chartContainer").width(800);
        //
        // })
        window.onload = function () {
            $("#chartContainer").width(800);
            var chart = new CanvasJS.Chart("chartContainer",
                {
                    title:{
                        text: "Report test result"
                    },
                        data: [
                            {
                                type: "stackedColumn",
                                showInLegend: true,
                                name: "iq_score",
                                legendText: "IQ",
                                dataPoints: [
                                        @foreach($list_candidate_score AS $candidate_score)
                                            @php
                                            var_dump($list_candidate_score);die;
                                                $iq_score = $candidate_score->iq_score;
                                                $skill_score = $candidate_score->tech_score;
                                                $data = '{x:'.$iq_score.',y:'.$skill_score.'}';
                                           echo $data;
                                            @endphp

                                        @endforeach
                                    // { x: 10, y: 71 },
                                    // { x: 20, y: 55},
                                    // { x: 30, y: 50 },
                                    // { x: 40, y: 65 },
                                    // { x: 50, y: 95 },
                                    // { x: 60, y: 68 },
                                    // { x: 70, y: 28 },
                                    // { x: 80, y: 34 },
                                    // { x: 90, y: 14}

                                ]
                            },
                            {
                                type: "stackedColumn",
                                legendText: "Skill",
                                name: "skill_score",
                                showInLegend: true,
                                dataPoints: [
                                    { x: 10, y: 7 },
                                    { x: 20, y: 5},
                                    { x: 30, y: 5 },
                                    { x: 40, y: 16 },
                                    { x: 50, y: 9 },
                                    { x: 60, y: 61 },
                                    { x: 70, y: 18 },
                                    { x: 80, y: 14 },
                                    { x: 90, y: 24}

                                ]
                            }
                        ]

                });

            chart.render();

        }
    </script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection