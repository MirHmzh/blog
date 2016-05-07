@extends('index')
@section('title')
{{ $user->name }}
@endsection

@section('content')
<div>
	<ul class="list-group">
		<li class="list-group-item">
			Bergabung pada {{ $user->created_at->format('M d,Y \a\t h:i a') }}
		</li>
		<li class="list-group-item panel-body">
			<table class="table-padding">
				<style>
				.table-padding td{
					padding: 3px 8px;
				}
				</style>
				<tr>
					<td>Artikel Diterbitkan</td>
					<td><a href="{{ url('/user/'.$user->id.'/posts') }}">Tampilkan Semua</a></td>
				</tr>
			</table>
		</li>
	</ul>
</div>

<div>
	<div class="panel-heading"><h3>Artikel Terakhir</h3></div>
	<div class="panel-body">
		@if(!empty($latest_posts[0]))
		@foreach($latest_posts as $latest_post)
			<p>
				<strong>
					<a href="{{ url('/'.$latest_post->slug) }}">{{ $latest_post->title }}</a>
				</strong>
				<span class="well-sm">
					On {{ $latest_post->created_at->format('M d,Y \a\t h:i a') }}
				</span>
			</p>
		@endforeach
		@else
		<p>Anda tidak menulis artikel saat ini</p>
		@endif
	</div>
</div>
@endsection