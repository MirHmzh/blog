@extends('index')
@section('title')
{{$title}}
@endsection
@section('content')
@if ( !$posts->count() )
Tidak ada artikel untuk saat ini. Masuk dan tulis artikel
@else
<div class="">
  @foreach( $posts as $post )
  <div class="list-group">
    <div class="list-group-item">
      <h3><a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
        @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
          <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Artikel</a></button>
        @endif
      </h3>
      <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} Oleh
        <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
      </p>
    </div>
    <div class="list-group-item">
      <article>
        {!! str_limit($post->body, $limit = 750, $end = ' <a href='.url("/".$post->slug).'>[...]</a>') !!}
      </article>
    </div>
  </div>
  @endforeach
  {!! $posts->render() !!}
</div>
@endif
@endsection