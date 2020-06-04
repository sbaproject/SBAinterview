@extends('master')
@section('title','Interviewer Edit')
@section('menu')
@parent
@endsection
@section('content')

    <div class="container padding-20">
        <div class="row">
            <div id="staff_new_edit_frm" class="col-xl-10 col-lg-10 col-md-10 col-sm-12">
                <h2 class="border-bottom">
                    Interviewer Edit
                </h2>
                <form method="post">
                    @csrf
                    <input type="hidden"  class="form-control" name="in_id" value="{{ $interviewer->in_id }}">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">CV No.</span>
                            </div>

                            <input type="text"  class="form-control" name="in_cvno" value="{{ old('in_cvno', $interviewer->in_cvno) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Fullname</span>
                            </div>
                            <input type="text" maxlength="200" class="form-control {{ ($errors->first('in_name')) ? 'is-invalid'  :'' }}"
                                   name="in_name" value="{{ old('in_name', $interviewer->in_name) }}" >

                            <div class="invalid-feedback">
                                @error('in_name')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">DOB</span>
                            </div>
                            <input type="text" maxlength="100" class="form-control "  name="in_dob" value="{{ old('in_dob', $interviewer->in_dob) }}" >

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Salary(VNĐ/USD)</span>
                            </div>
                            <input type="text"  class="form-control "  name="in_salary" value="{{  old('in_salary',$interviewer->in_salary )}}" >

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mail</span>
                            </div>
                            <input type="text"  class="form-control "  name="in_mail" value="{{ old('in_mail', $interviewer->in_mail)}}" >
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
                                <span class="input-group-text">Language</span>
                            </div>
                            <div class="form-control wrapper-select">
                                <select class="select-language" name="in_language">
                                    <option value="1" {{ 1 == old('in_language', $interviewer->in_language) ? 'selected' : '' }}>
                                        PHP
                                    </option>
                                    <option value="2" {{ 2 == old('in_language',$interviewer->in_language) ? 'selected' : '' }}>
                                        C#/ASP.Net
                                    </option>
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
                            <input type="text" maxlength="14" class="form-control "  name="in_tel" value="{{ old('in_tel', $interviewer->in_tel )}}" >
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
                                    <option value="0">
                                        Please choose a status
                                    </option>
                                    <option value="1" {{ 1 == old('in_status',old('in_status',$interviewer->in_status)) ? 'selected' : '' }}>
                                        Phone&mail contacted
                                    </option>
                                    <option value="2" {{ 2 == old('in_status',$interviewer->in_status) ? 'selected' : '' }}>
                                        Interviewed
                                    </option>
                                    <option value="3" {{ 3 == old('in_status',$interviewer->in_status) ? 'selected' : '' }}>
                                        Cancelled interview
                                    </option>
                                    <option value="4" {{ 4 == old('in_status',$interviewer->in_status) ? 'selected' : '' }}>
                                        Not Pass contacted
                                    </option>
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
                            {{--<input type="text"  class="form-control "  name="in_date" value="{{ old('in_date') }}" >--}}
                            <input id="in_date" readonly type="text" class="form-control datetimepicker-input"
                                   name="in_date" autocomplete="off" value="{{ old('in_date', $currentTime )}}">
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
                            <textarea class="form-control"  name="in_university" rows=4>{{ old('in_note', $interviewer->in_note) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Extra skill</span>
                            </div>
                            <textarea class="form-control"  name="in_university" rows=4>{{ old('in_extraskill', $interviewer->in_extraskill) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Personality</span>
                            </div>
                            <textarea class="form-control"  name="in_university" rows=4>{{ old('in_personality', $interviewer->in_personality) }}</textarea>
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