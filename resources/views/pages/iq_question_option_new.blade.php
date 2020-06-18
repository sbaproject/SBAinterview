@extends('master')
@section('title','IQ question option registration')
@section('menu')
@parent
@endsection
@section('content')
    <div class="container padding-20">
        <div class="row">
            <div id="staff_new_edit_frm" class="col-xl-10 col-lg-10 col-md-10 col-sm-12">
                <h2 class="border-bottom">
                   IQ question option registration
                </h2>
                @if (\Session::has('success'))
                    <div class=" alert alert-success alert-dismissible fade show mt-2 mt-md-0">
                        {{ \Session::get('success') }}
                    </div>
                @endif
                <form method="post">
                    @csrf

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">IQ question option value</span>
                            </div>
                            <input type="text" maxlength="200" class="form-control {{ ($errors->first('option_value')) ? 'is-invalid'  :'' }}"
                                   name="option_value" value="{{ old('option_value') }}" >
                            <div class="invalid-feedback">
                                @error('option_value')
                                {{ $message }}
                                @enderror
                            </div>

                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check_correct" name="correct_flg"  {{old('correct_flg') ? 'checked' : ''}}>

                            <label class="form-check-label" for="check_correct">Correct value</label>
                        </div>
                    </div>

                    <div class="form-group-button">
                        <button type="submit" class="btn btn-primary btn-form btn-left">Create new</button>
                        <button type="submit" name="continuos" class="btn btn-primary btn-form btn-left">Continuous Create New</button>
                        <a role="button" href="{{url('iq-option-list/'.$iq_id)}}" class="btn btn-secondary btn-form" >Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection