@extends('index')

@section('title')
Tambah Artikel
@endsection

@section('content')

<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
	tinymce.init({
		selector : "textarea",
		images_upload_base_path: '/img/',
		plugins : ["advlist autolink lists link image charmap print preview anchor",
				   "searchreplace visualblocks code fullscreen",
				   "insertdatetime media table contextmenu paste jbimages"],
		toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	});
</script>

<form action="tambah-post" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group">
		<input type="text" name ="title" required="required" value="{{ old('title') }}"
		placeholder="Judul" class="form-control"/>
	</div>
	<div class="form-group">
		<textarea name='body' class="form-control">{{ old('body') }}</textarea>
	</div>
	<input type="submit" name='publish' class="btn btn-success" value = "Terbitkan"/>
</form>
@endsection
