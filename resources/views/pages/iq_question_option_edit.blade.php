@extends('master')
@section('title','IQ question option edit')
@section('menu')
    @parent
@endsection
@section('content')

    <div class="container padding-20">
        <div class="row">
            <div id="staff_new_edit_frm" class="col-xl-10 col-lg-10 col-md-10 col-sm-12">
                <h2 class="border-bottom">
                    IQ question option edit
                </h2>
                <form method="post">
                    @csrf
                    <input type="hidden"  class="form-control" name="id" value="{{ $option->id }}">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">IQ question option value</span>
                            </div>
                            <input type="text" maxlength="200" class="form-control {{ ($errors->first('option_value')) ? 'is-invalid'  :'' }}"
                                   name="option_value" value="{{ old('o_value',$option->option_value) }}" >
                            <div class="invalid-feedback">
                                @error('option_value')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check_correct" name="correct_flg"  {{old('correct_flg',$option->correct_flg) ? 'checked' : ''}}>

                            <label class="form-check-label" for="check_correct">Correct value</label>
                        </div>
                    </div>
                    <div class="form-group-button">
                        <button type="submit" class="btn btn-primary btn-form btn-left">Update</button>
                        <a role="button" href="{{url('iq-option-list/'.$option->iq_question_id)}}" class="btn btn-secondary btn-form" >Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection