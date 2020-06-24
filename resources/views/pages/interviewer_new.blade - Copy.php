@extends('master')
@section('title','Candidate Registration')
@section('menu')
@parent
@endsection
@section('content')
    <div class="container padding-20">
        <div class="row">
            <div id="staff_new_edit_frm" class="col-xl-10 col-lg-12 col-md-12 col-sm-12">
                <h2 class="border-bottom">
                    Candidate Registration
                </h2>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">CV No.<span class="text-danger"> *</span></span>
                            </div>
                            <input type="text"  class="form-control form-control {{ ($errors->first('in_cvno')) ? 'is-invalid'  :'' }}" name="in_cvno" value="{{ old('in_cvno')  }}">
                            <div class="invalid-feedback">
                                @error('in_cvno')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">CV channel</span>
                            </div>
                            <div class="form-control wrapper-select">
                                <select class="select-cvchannel" name="in_cvchannel">
                                    <option value="0">Please choose CV channel</option>
                                    @foreach($cst_cvchannel as $kcn => $vcn)
                                        <option value="{{$kcn}}" {{ $kcn == old('in_cvchannel') ? 'selected' : '' }}>
                                            {{$vcn}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">CV link</span>
                            </div>
                            <input type="text"  class="form-control" name="in_cvlink" value="{{ old('in_cvlink')  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Last name<span class="text-danger"> *</span></span>
                            </div>
                            <input type="text" maxlength="200" class="form-control {{ ($errors->first('in_lastname')) ? 'is-invalid'  :'' }}"
                                   name="in_lastname" value="{{ old('in_lastname') }}" >
                            <div class="invalid-feedback">
                                @error('in_lastname')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">First name<span class="text-danger"> *</span></span>
                            </div>
                            <input type="text" maxlength="200" class="form-control {{ ($errors->first('in_firstname')) ? 'is-invalid'  :'' }}"
                                name="in_firstname" value="{{ old('in_firstname') }}" >
                            <div class="invalid-feedback">
                                @error('in_firstname')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<div class="input-group mb-3">--}}
                            {{--<div class="input-group-prepend w-25">--}}
                                {{--<span class="input-group-text">DOB</span>--}}
                            {{--</div>--}}
                            {{--<input type="text"  class="form-control datetimepicker-input" name="in_dob" value="{{ old('in_dob')  }}">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">DOB</span>
                            </div>
                            {{--<input type="text"  class="form-control "  name="in_date" value="{{ old('in_date') }}" >--}}
                            <input id="in_dob" readonly type="text" class="form-control datetimepicker-input"
                                   name="in_dob" autocomplete="off" value="{{ old('in_dob', $currentTime) }}">
                            <div class="input-group-append" data-target="#in_dob" onclick="$('#in_dob').focus();">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Salary(VNĐ/USD)</span>
                            </div>
                            <input type="text"  class="form-control {{ ($errors->first('in_salary')) ? 'is-invalid'  :'' }} "  name="in_salary" value="{{ old('in_salary') }}" >
                            <div class="invalid-feedback">
                                @error('in_salary')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Mail</span>
                            </div>
                            <input type="text"  class="form-control {{ ($errors->first('in_mail')) ? 'is-invalid'  :'' }} "  name="in_mail" value="{{ old('in_mail') }}" >
                            <div class="invalid-feedback">
                                @error('in_mail')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Education</span>
                            </div>
                            <textarea class="form-control"  name="in_education" rows=4>{{ old('in_education') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Experience</span>
                            </div>
                            <textarea class="form-control"  name="in_experience" rows=4>{{ old('in_experience') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Skill<span class="text-danger"> *</span></span>
                            </div>
                            <div class="form-control wrapper-select">
                                <select class="select-language" name="in_language">
                                    @foreach($cst_lang as $klg => $vlg)
                                        <option value="{{$klg}}" {{ $klg == old('in_language') ? 'selected' : '' }} >
                                            {{$vlg}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">University</span>
                            </div>
                            <textarea class="form-control"  name="in_university" rows=4>{{ old('in_university') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Tel</span>
                            </div>
                            <input type="text" maxlength="14" class="form-control  {{ ($errors->first('in_tel')) ? 'is-invalid'  :'' }} "  name="in_tel" value="{{ old('in_tel') }}" >
                            <div class="invalid-feedback">
                                @error('in_tel')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Address</span>
                            </div>
                            <input type="text"  class="form-control "  name="in_address" value="{{ old('in_address') }}" >

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Status</span>
                            </div>
                            <div class="form-control wrapper-select">
                                <select class="select-status" name="in_status">
                                    <option value="0">Please choose a status</option>
                                    @foreach($cst_status as $kst => $vst)
                                        <option value="{{$kst}}" {{ $kst == old('in_status') ? 'selected' : '' }}>
                                            {{$vst}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Interview time</span>
                            </div>
                            <input type="text"  class="form-control "  name="in_time" value="{{ old('in_time') }}"  id='in_time'>
                            <div class="input-group-append" data-target="#in_time" onclick="$('#in_time').focus();">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Interview date</span>
                            </div>
                            {{--<input type="text"  class="form-control "  name="in_date" value="{{ old('in_date') }}" >--}}
                            <input id="in_date" readonly type="text" class="form-control datetimepicker-input"
                                   name="in_date" autocomplete="off" value="{{ old('in_date', $currentTime) }}">
                            <div class="input-group-append" data-target="#in_date" onclick="$('#in_date').focus();">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Note</span>
                            </div>
                            <textarea class="form-control"  name="in_note" rows=4 >{{ old('in_note') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Extra skill</span>
                            </div>
                            <textarea class="form-control"  name="in_extraskill" rows=4>{{ old('in_extraskill') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Personality</span>
                            </div>
                            <textarea class="form-control"  name="in_personality" rows=4>{{ old('in_personality') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text">Attach CV file</span>
                            </div>
                            <div class=" pl-2 justify-content-center my-auto">
                                <div class="form-group">
                                    <label for="upload" class="btn btn-sm btn-primary">Upload file</label>
                                    <input type="file" class="text-center form-control-file custom_file" id="upload" name="in_file">
                                    <label for="file_default">No File Choosen </label>
                                    <label for="file_name"><b></b></label>
                                </div>
                                <input type="hidden" value="{{Session::get('file_data') ? Session::get('file_data') : '' }}" name="temp_file">
                                {{--<input id="upload" name="in_file" value="@isset($ifle_data) {{$file_data}} @endisset" type="file" class="file align-middle d-inline-block" data-show-preview="false">--}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group-button">
                        <button type="submit" class="btn btn-primary btn-form btn-left">Create new</button>
                        <button type="submit" name="continuos" class="btn btn-primary btn-form btn-left">Continuous Create New</button>
                        <a role="button" href="{{url('interview-management')}}" class="btn btn-secondary btn-form" >Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <style>
        .custom_file {
            margin: auto;
            opacity: 0;
            position: absolute;
            z-index: -1;
        }
    </style>
    <script>
        $(document).ready(function () {
            @php
                $file_name = Session::get('file_data');
            @endphp
            @if($file_name)
                $("label[for='file_name'] b").html('{{$file_name}}');
                $("label[for='file_default']").text('Selected File: ');
            @endif

        })
        $('#upload').change(function() {
            var filename = $('#upload').val();
            if (filename.substring(3,11) == 'fakepath') {
                filename = filename.substring(12);
            } // For Remove fakepath
            $("label[for='file_name'] b").html(filename);
            $("label[for='file_default']").text('Selected File: ');
            if (filename == "") {
                $("label[for='file_default']").text('No File Choosen');
            }
        });
    </script>
@endsection