@extends('master')
@section('title','Skill questions')
@section('menu')
@parent
@endsection
@section('content')
    <div class="">
        <div class="header-index">
        <div class="header-title">
                    <span>Skill questions</span>
                </div>
            <a class="btn btn-primary add-new-btn d-none d-md-block" href="{{url('tech-list/new')}}" role="button">Create new</a>
            <div class=" d-block d-md-none mt-2">
                 <a class="btn btn-primary add-new-btn" href="{{url('tech-list/new')}}" role="button">Create new</a>  
            </div>
            @if (\Session::has('success'))
                <div class=" alert alert-success alert-dismissible fade show mt-2 mt-md-0 ">
                {{--<div class=" alert alert-success d-block">--}}
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
                                <div class="col-12">
                                    <div class="form-group ">
                                        <label for="type">SKill</label>
                                        <div class="d-block">
                                            <div class="d-inline-block align-middle"><select class="form-control" name="type" >
                                                    <option value="" >Please choose a skill</option>
                                                    @foreach($cst_lang As $k => $v){
                                                    <option value="{{$k}}" {{ old('type',$req_arr['type']) == $k ? "selected"  : "" }}>{{$v}}</option>
                                                    }
                                                    @endforeach
                                                </select></div>

                                            <div class="d-inline-block align-middle"> <button type="submit" name="submit" class="btn btn-primary">Search</button></div>
                                        </div>
                                        </div>

                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        @if (isset($list_tech) && $list_tech_count > 0)
        <div class="row">
            <div class="col-12">
        <div class="table-responsive ">
            <table id ="table_list_tech" class="table table-bordered table-hover ">
                <thead class="table-header">
                    <tr>
                        <th width="5%" scope="col">No.</th>
                        <th width="30%" scope="col">Content</th>
                        <th width="30%" scope="col">Skill</th>
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

                    @endphp



                    @foreach($list_tech as $tech)
                        <tr>
                            <th width="5%">{{ $index < 10 ? '0' . $index : $index }}</th>
                            <td width="10%" class="text-left pl-2 pr-2">{!! $tech->content !!}</td>
                            <td width="10%">{{ $tech->type }}</td>
                            <td id="link" width="10%"><a href="{{ url('tech-list/edit/' . $tech->id) }}">Edit  </a> /&nbsp;<a href="{{ url('tech-list/delete/' . $tech->id.'/'.$current_page) }}" style="color: red;"  onclick="return confirm('Are you sure to delete this item?')">Delete</a></td>
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
                <div>{{ $list_tech->appends(Request::except('page'))->links() }}</div>
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