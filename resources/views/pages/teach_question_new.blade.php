@extends('master')
@section('title','Technical question registration')
@section('menu')
@parent
@endsection
@section('content')
    <div class="container padding-20">
        <div class="row">
            <div id="staff_new_edit_frm" class="col-xl-10 col-lg-10 col-md-10 col-sm-12">
                <h2 class="border-bottom">
                   Technical question registration
                </h2>
                <form method="post">
                    @csrf

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Question Content</span>
                            </div>
                            <textarea class="form-control {{ ($errors->first('content')) ? 'is-invalid'  :'' }}"  name="content" rows=4>{{ old('content') }}</textarea>
                            <div class="invalid-feedback">
                                @error('content')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Language</span>
                            </div>
                            <div class="form-control wrapper-select">
                                <select class="select-language" name="type">
                                    @foreach($language as $key => $val)
                                        <option value="{{$key}}" {{ $key == old('type') ? 'selected' : '' }}>
                                           {{$val}}
                                        </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group-button">
                        <button type="submit" class="btn btn-primary btn-form btn-left">Create new</button>
                        <a role="button" href="{{url('tech-list')}}" class="btn btn-secondary btn-form" >Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection