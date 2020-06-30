@extends('master')
@section('title','IQ option questions')
@section('menu')
@parent
@endsection
@section('content')
    <div class="">
        <div class="header-index">
        <div class="header-title option_header">
                    <span>IQ option questions</span>
                </div>
            <a class="btn btn-primary add-new-btn" href="{{url('iq-option/new/'.$iq_id)}}" role="button">Create new</a>
            <a class="btn btn-primary add-new-btn " style="margin-right: 0px;margin-left: auto;" href="{{url('iq-list')}}" role="button">Back to IQ question list</a>
            @if (\Session::has('success'))
                <div class=" alert alert-success alert-dismissible fade show mt-2 mt-md-0">
                    {{ \Session::get('success') }}
                </div>
            @endif
        </div>



        @if (isset($list_iq_option) && $list_iq_option_count > 0)
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id ="table_iq_option" class="table table-bordered table-hover">
                            <thead class="table-header">
                            <tr>
                                <th width="5%" scope="col">No.</th>
                                <th width="30%" scope="col">Content</th>
                                <th width="30%" scope="col">Is Correct</th>
                                <th width="30%" scope="col">Action</th>
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

                                function checkCorrect($correct_flg){
                                    $correct_txt = "";
                                    if($correct_flg == 1){
                                        $correct_txt = "<input type='checkbox' checked onclick='return false;'>";
                                    }else{
                                        $correct_txt = "<input type='checkbox' readonly  onclick='return false;'>";
                                    }
                                    return $correct_txt;
                                }

                            @endphp

                            @foreach($list_iq_option as $option)
                                <tr>
                                    <th width="5%">{{ $index < 10 ? '0' . $index : $index }}</th>
                                    <td width="10%">{{ $option->option_value }}</td>
                                    <td width="10%">{!! html_entity_decode(checkCorrect($option->correct_flg))  !!} </td>
                                    <td id="link" width="10%"><a href="{{ url('iq-option/edit/' . $option->id) }}">Edit  </a> /&nbsp;
                                        <a href="{{ url('iq-option/delete/' . $option->id) }}" style="color: red;" onclick="return confirm('Are you sure to delete this item?')">Delete</a>
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
                <div>{{ $list_iq_option->links() }}</div>
            </div>
        @else
            <div class="row">
                <div class="md-12">
                    <div class="padding-20">
                        There are no options
                    </div>

                </div>
            </div>
        @endif
    </div>
@endsection