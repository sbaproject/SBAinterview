@extends('master')
@section('title','Candidate Edit')
@section('menu')
@parent
@endsection
@section('content')

    <div class="container padding-20">
        <div class="row">
            <div id="staff_new_edit_frm" class="col-xl-10 col-lg-10 col-md-10 col-sm-12">
                <h2 class="border-bottom">
                    Candidate Edit
                </h2>
                <form method="post">
                    @csrf
                    <input type="hidden"  class="form-control" name="in_id" value="{{ $interviewer->in_id }}">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">CV No.<span class="text-danger"> *</span></span>
                            </div>

                            <input type="text"  class="form-control {{ ($errors->first('in_cvno')) ? 'is-invalid'  :'' }}" name="in_cvno" value="{{ old('in_cvno', $interviewer->in_cvno) }}">
                            <div class="invalid-feedback">
                                @error('in_cvno')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">CV channel</span>
                            </div>
                            <div class="form-control wrapper-select">
                                <select class="select-cvchannel" name="in_cvchannel">
                                    <option value="0">Please choose CV channel</option>
                                    @foreach($cst_cvchannel as $kcn => $vcn)
                                        <option value="{{$kcn}}" {{ $kcn == old('in_cvchannel',$interviewer->in_cvchannel) ? 'selected' : '' }}>
                                            {{$vcn}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">CV link</span>
                            </div>
                            <input type="text"  class="form-control" name="in_cvlink" value="{{ old('in_cvlink',$interviewer->in_cvlink)  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Last name<span class="text-danger"> *</span></span>
                            </div>
                            <input type="text" maxlength="200" class="form-control {{ ($errors->first('in_lastname')) ? 'is-invalid'  :'' }}"
                                   name="in_lastname" value="{{ old('in_lastname', $interviewer->in_lastname) }}" >

                            <div class="invalid-feedback">
                                @error('in_lastname')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">First name<span class="text-danger"> *</span></span>
                            </div>
                            <input type="text" maxlength="200" class="form-control {{ ($errors->first('in_firstname')) ? 'is-invalid'  :'' }}"
                                   name="in_firstname" value="{{ old('in_firstname', $interviewer->in_firstname) }}" >

                            <div class="invalid-feedback">
                                @error('in_firstname')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<div class="input-group mb-3">--}}
                            {{--<div class="input-group-prepend">--}}
                                {{--<span class="input-group-text">DOB</span>--}}
                            {{--</div>--}}
                            {{--<input type="text" maxlength="100" class="form-control "  name="in_dob" value="{{ old('in_dob', $interviewer->in_dob) }}" >--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">DOB</span>
                            </div>
                            @php
                                $date = date_format(date_create($interviewer->in_dob),'Y/m/d');
                            @endphp
                            {{--<input type="text"  class="form-control "  name="in_date" value="{{ old('in_date') }}" >--}}
                            <input id="in_dob" readonly type="text" class="form-control datetimepicker-input"
                                   name="in_dob" autocomplete="off" value="{{ old('in_dob', $date )}}">
                            <div class="input-group-append" data-target="#in_dob" onclick="$('#in_dob').focus();">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Salary(VNĐ/USD)</span>
                            </div>
                            <input type="text"  class="form-control {{ ($errors->first('in_salary')) ? 'is-invalid'  :'' }}"  name="in_salary" value="{{  old('in_salary',$interviewer->in_salary )}}" >
                            <div class="invalid-feedback">
                                @error('in_salary')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mail</span>
                            </div>
                            <input type="text"  class="form-control {{ ($errors->first('in_mail')) ? 'is-invalid'  :'' }} "  name="in_mail" value="{{ old('in_mail', $interviewer->in_mail)}}" >
                            <div class="invalid-feedback">
                                @error('in_mail')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Education</span>
                            </div>
                            <textarea class="form-control"  name="in_education" rows=4>{{ old('in_education', $interviewer->in_education) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Experience</span>
                            </div>
                            <textarea class="form-control"  name="in_experience" rows=4>{{ old('in_experience', $interviewer->in_experience )}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Skill<span class="text-danger"> *</span></span>
                            </div>
                            <div class="form-control wrapper-select">
                                <select class="select-language" name="in_language">
                                    @foreach($cst_lang as $klg => $vlg)
                                        <option value="{{$klg}}" {{ $klg == old('in_language',$interviewer->in_language) ? 'selected' : '' }} >
                                            {{$vlg}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">University</span>
                            </div>
                            <textarea class="form-control"  name="in_university" rows=4>{{ old('in_university', $interviewer->in_university) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tel</span>
                            </div>
                            <input type="text" maxlength="14" class="form-control {{ ($errors->first('in_tel')) ? 'is-invalid'  :'' }} "  name="in_tel" value="{{ old('in_tel', $interviewer->in_tel )}}" >
                            <div class="invalid-feedback">
                                @error('in_tel')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Address</span>
                            </div>
                            <input type="text"  class="form-control "  name="in_address" value="{{ old('in_address', $interviewer->in_address )}}" >

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Status</span>
                            </div>
                            <div class="form-control wrapper-select">
                                <select class="select-status" name="in_status">
                                    <option value="0">Please choose a status</option>
                                    @foreach($cst_status as $kst => $vst)
                                        <option value="{{$kst}}" {{ $kst == old('in_status',$interviewer->in_status ) ? 'selected' : '' }}>
                                            {{$vst}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Interview time</span>
                            </div>
                            <input type="text"  class="form-control "  name="in_time" value="{{ old('in_time', $interviewer->in_time)}}"  id='in_time'>
                            <div class="input-group-append" data-target="#in_time" onclick="$('#in_time').focus();">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Interview date</span>
                            </div>
                            @php
                                    $date = date_format(date_create($interviewer->in_date),'Y/m/d');
                            @endphp
                            {{--<input type="text"  class="form-control "  name="in_date" value="{{ old('in_date') }}" >--}}
                            <input id="in_date" readonly type="text" class="form-control datetimepicker-input"
                                   name="in_date" autocomplete="off" value="{{ old('in_date', $date )}}">
                            <div class="input-group-append" data-target="#in_date" onclick="$('#in_date').focus();">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Note</span>
                            </div>
                            <textarea class="form-control"  name="in_note" rows=4>{{ old('in_note', $interviewer->in_note) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Extra skill</span>
                            </div>
                            <textarea class="form-control"  name="in_extraskill" rows=4>{{ old('in_extraskill', $interviewer->in_extraskill) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Personality</span>
                            </div>
                            <textarea class="form-control"  name="in_personality" rows=4>{{ old('in_personality', $interviewer->in_personality) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group-button">
                        <button type="submit" class="btn btn-primary btn-form btn-left">Update</button>
                        <a role="button" href="{{url('interview-management')}}" class="btn btn-secondary btn-form" >Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection