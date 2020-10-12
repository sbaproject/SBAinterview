@extends('master')
@section('title','Interview Management')
@section('menu')
@parent
@endsection
@section('content')
    <div class="p-0 p-md-3">
        <div class="header-index d-block d-md-flex">
            <div class="header-title">
                        <span>Interview Management</span>
            </div>
                <a class="btn btn-primary add-new-btn d-none d-md-block" href="{{url('interview-management/new')}}" role="button">Create new</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary  d-none d-md-block" data-toggle="modal" data-target=".bd-example-modal-lg">Report test result</button>
                <div class=" d-block d-md-none mt-2">
                    <a class="btn btn-primary add-new-btn" href="{{url('interview-management/new')}}" role="button">Create new</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Report test result</button>
                </div>
                @if (\Session::has('success'))
                    <div class=" alert alert-success alert-dismissible fade show mt-2 mt-md-0">
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
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="inid">Candidate_id</label>
                                        <input type="text" class="form-control" id="in_id"  name="in_id" value="{{old('in_id',$req_arr['in_id'])}}" placeholder="Candidate_id">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
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
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="firstname">First name</label>
                                        <input type="text" class="form-control" id="in_firstname"  name="in_firstname" value="{{old('in_firstname',$req_arr['in_firstname'])}}" placeholder="First name">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="lastname">Last name</label>
                                        <input type="text" class="form-control" id="in_lastname"  name="in_lastname" value="{{old('in_lastname',$req_arr['in_lastname'])}}" placeholder="Last name">
                                    </div>
                                </div>
                                {{--<div class="col-12 col-md-4">--}}
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
                                <div class="col-12 col-md-4">
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
                                <div class="col-12 col-md-4">
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
                                <div class="col-12 col-md-4">
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
                                <div class="col-12 col-md-4">
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
                                <div class="col-12 col-md-4">
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
                        <table id ="table_interview" class="table table-bordered table-hover ">
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
                <div>{{ $list_interviewers->appends(Request::except('page'))->links() }}</div>
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
    <div class="modal fade bd-example-modal-lg"  id="chartModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Report test result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="app">
                  <div id="chart">
                      <apexchart type="bar" height="" id="chart_report" :options="chartOptions" :series="series"></apexchart>
                    </div>
                </div>

            </div>
        </div>
    </div>


    
    
    <!-- Modal -->
    <script type="text/javascript">
  window.onload = function () {
    new Vue({
        el: '#app',
        components: {
          apexchart: VueApexCharts,
        },
        data: {
          
          series: [{
            name: 'IQ',
            data: [
            @foreach($list_candidate_score AS $candidate_score)
                @php
                    $iq_score = $candidate_score->iq_score;                   
                    echo $iq_score.',';
                @endphp
            @endforeach

            ]
          }, {
            name: 'Skill',
            data: [
                @foreach($list_candidate_score AS $candidate_score)
                    @php
                        $skill_score = $candidate_score->tech_score;
                        echo $skill_score.',';
                    @endphp
                @endforeach

            ]
          },
          
          ],
          chartOptions: {
            chart: {
              type: 'bar',
              height: 350,
              stacked: true,
              toolbar: {
                show: true
              },
                zoom: {
                    enabled: true,
                    type: 'x',
                    resetIcon: {
                        offsetX: -10,
                        offsetY: 0,
                        fillColor: '#fff',
                        strokeColor: '#37474F'
                    },
                    selection: {
                        background: '#90CAF9',
                        border: '#0D47A1'
                    }
                },
            },

            responsive: [{
             breakpoint: 480,
              options: {
                legend: {
                  position: 'bottom',
                  offsetX: -10,
                  offsetY: 0
                }
              }
            }],
            plotOptions: {
              bar: {
                horizontal: false,
              },
            },
            colors: ['#4F81BC', '#C0504E'
        ],
            xaxis: {
              //stype: 'category',
            labels: {
                        rotate: -45
                      },
              categories: [
                @foreach($list_candidate_score AS $candidate_score)
                    @php
                        $xaxis_name = '"'.$candidate_score->in_lastname.' '.$candidate_score->in_firstname.'"';
                        echo $xaxis_name.',';
                    @endphp
                @endforeach

              ],
                tickPlacement: 'on'
            },
            
            legend: {
              position: 'right',
              offsetY: 40
            },
            fill: {
              opacity: 1
            }
          },
          
          
        },
        
      })

  }
       
    </script>
    <script>
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
        )
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-apexcharts"></script>
    {{--<link href="assets/styles.css" rel="stylesheet" />--}}
     <style>

        #chart {
            /*max-width: 100%;*/
            position: relative;
          margin: 35px auto;
          /*overflow-x: auto;*/
    }
         #chart_report{
             /*width: 2200px;*/
             width: 100%;
             height: 100%;
             /*height: 350px;*/
         }

    </style>

@endsection