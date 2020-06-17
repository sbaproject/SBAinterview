@extends('master')
@section('title','IQ question edit')
@section('menu')
    @parent
@endsection
@section('content')

    <div class="">
        <div class="row">
            <div id="staff_new_edit_frm" class="col-xl-10 col-lg-12 col-md-12 col-sm-12">
                <h2 class="border-bottom">
                    IQ question edit
                </h2>
                <form method="post">
                    @csrf
                    <input type="hidden"  class="form-control" name="id" value="{{ $iq->id }}">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">IQ Question Content</span>
                            </div>
                            <textarea class="form-control {{ ($errors->first('content')) ? 'is-invalid'  :'' }}"  name="content" id="question_content" rows=20>{{ old('content',$iq->content) }}</textarea>
                            <div class="invalid-feedback">
                                @error('content')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group-button">
                        <button type="submit" class="btn btn-primary btn-form btn-left">Update</button>
                        <a role="button" href="{{url('iq-list')}}" class="btn btn-secondary btn-form" >Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}',
            width: "100%",
            height: "500px"

        };
        CKEDITOR.replace( 'question_content', options);

    </script>
@endsection