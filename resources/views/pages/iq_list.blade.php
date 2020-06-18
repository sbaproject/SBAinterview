@extends('master')
@section('menu')
@section('title','IQ questions')
@parent
@endsection
@section('content')
    <div class="">
        <div class="header-index">
        <div class="header-title">
                    <span>IQ questions</span>
                </div>
            <a class="btn btn-primary add-new-btn" href="{{url('iq-list/new')}}" role="button">Create new</a>
            @if (\Session::has('success'))
                <div class=" alert alert-success alert-dismissible fade show mt-2 mt-md-0">
                    {{ \Session::get('success') }}
                </div>    
            @endif
        </div>



        @if (isset($list_iq) && $list_iq_count > 0)
        <div class="row">
            <div class="col-12">
        <div class="table-responsive">
            <table id ="table_list_iq" class="table table-bordered table-hover ">
                <thead class="table-header">
                    <tr>
                        <th width="5%" scope="col">No.</th>
                        <th width="30%" scope="col">Content</th>
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



                    @foreach($list_iq as $iq)
                        <tr>
                            <th width="5%">{{ $index < 10 ? '0' . $index : $index }}</th>
                            <td width="10%" class="iq_content_style text-left pl-2 pr-2">{!! html_entity_decode($iq->content) !!}</td>
                            <td id="link" width="10%"><a href="{{ url('iq-list/edit/' . $iq->id) }}">Edit  </a> /&nbsp;
                            <a href="{{url('iq-option-list/'.$iq->id)}}">Options management</a> /
                                <a href="{{ url('iq-list/delete/' . $iq->id.'/'.$current_page) }}" style="color: red;" onclick="return confirm('Are you sure to delete this item?')">Delete</a>
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
                <div>{{ $list_iq->links() }}</div>
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
    <style type="text/css">

        .iq_content_style img{
            max-width: 100%;
        }
    </style>
@endsection