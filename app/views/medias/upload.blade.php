@extends('backend/layouts/medias')

{{-- Page title --}}
@section('title')
Tải tệp tin ::
@parent
@stop

{{-- Page content --}}
@section('content')
<link href="{{ asset('assets/css/dropzone.css?v='.Config::get('app.css_ver')) }}" rel="stylesheet">
<script src="{{ asset('assets/js/dropzone.min.js') }}"></script>
<div>
	<div id="media-upload-notice"></div>
	<div id="media-upload-error"></div>
	<div id="media-container" style="border: 4px dashed #DDD; min-height: 335px;">
        <form action="/medias/upload" class="dropzone" id="media-upload">
            <input class="" type="hidden" name="env" id="env" value="{{ Input::old('env', $env) }}">
        </form>
  	</div>
</div>
<script type="text/javascript">
	$(function() {
		Dropzone.options.mediaUpload = {
		  paramName: "picture", // The name that will be used to transfer the file
		  maxFilesize: 5, // MB
		  acceptedFiles: 'image/*',
		  dictDefaultMessage: 'Kéo thả tệp tin cần tải lên tại đây! ( hoặc Click )'
		  // accept: function(file, done) {
		  //   if (file.name == "justinbieber.jpg") {
		  //     done("Naha, you don't.");
		  //   }
		  //   else { done(); }
		  // }
		};
	});
</script>
@stop
