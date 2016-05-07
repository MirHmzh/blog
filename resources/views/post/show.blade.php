@extends('index')


@section('title')
	@if($post)
		{{ $post->title }}
		@if(!Auth::guest() && ($post->author_id == Auth::user() -> id || Auth::user()->is_admin()))
		<button class="btn" style="float: right">
			<a href="{{ url('edit/'.$post->slug) }}">Edit Artikel</a>
		</button>
		@endif
	@else
		Halaman Tidak Ditemukan
	@endif
@endsection

@section('title-meta')
	<p>{{ $post->created_at->format('M d,Y \a\t h:i a') }}<a href="{{ url('/user/'.$post->author_id) }}"></a></p>
@endsection

@section('content')

@if($post)
	<div>
		{!! $post->body !!}
	</div>
@else
404 Error
@endif

@endsection