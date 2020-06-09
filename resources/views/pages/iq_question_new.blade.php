@extends('master')
@section('title','IQ question registration')
@section('menu')
@parent
@endsection
@section('content')
    <div class="container padding-20">
        <div class="row">
            <div id="staff_new_edit_frm" class="col-xl-10 col-lg-10 col-md-10 col-sm-12">
                <h2 class="border-bottom">
                   IQ question registration
                </h2>
                <form method="post">
                    @csrf

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">IQ Question Content</span>
                            </div>
                            <textarea class="form-control {{ ($errors->first('content')) ? 'is-invalid'  :'' }}"  name="content" rows=4>{{ old('content') }}</textarea>
                            <div class="invalid-feedback">
                                @error('content')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group-button">
                        <button type="submit" class="btn btn-primary btn-form btn-left">Create new</button>
                        <a role="button" href="{{url('iq-option-list')}}" class="btn btn-secondary btn-form" >Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection