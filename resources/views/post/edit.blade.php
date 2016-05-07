@extends('index')
@section('title')
Edit Artikel
@endsection

@section('content')
	<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
	<script type="text/javascript">
		tinymce.init({
		selector : "textarea",
		images_upload_base_path: 'http://localhost/Belajar%20Laravel/blog/public/img/',
		plugins : ["advlist autolink lists link image charmap print preview anchor",
				   "searchreplace visualblocks code fullscreen",
				   "insertdatetime media table contextmenu paste jbimages"],
		toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages"
	});
	</script>
	<form method="POST" action="{{ url('/perbarui') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
		<div class="form-group">
			<input required="required" placeholder="Judul disini" type="
			text" name="title" class="form-control"
			value="@if(!old('title')){{ $post->title }}@endif{{ old('title') }}">
		</div>
		<div class="form-group">
			<textarea name="body" class="form-control">
				@if(!old('body'))
				{!! $post->body !!}
				@endif
				{!! old('body') !!}
			</textarea>
		</div>
		@if($post->active == '1')
		<input type="submit" name="publish" class="btn btn-success" value="Perbarui">
		@else
		<input type="submit" name="publish" class="btn btn success" value="Terbitkan">
		@endif
		<a href="{{ url('hapus/'.$post->id.'/?_token='.csrf_token()) }}" class="btn btn-danger">Hapus</a>
	</form>
@endsection