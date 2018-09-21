@extends('layouts.app')

@section('title','記事編集')

@section('content')

<div align="center">
<h2>記事を編集する</h2>
<br>
{{ Form::open(['route'=>['posts.update',$post->id], 'method'=>'put']) }}
{{ csrf_field() }}
<p>
  タイトル<br>
  {{ Form::text('title',$post->title) }}
</p>
<p>
  本文<br>
  {{ Form::textarea('content',$post->content) }}
</p>
{{ Form::submit('更 新',['class'=>'btn btn-primary btn-sm']) }}
{{ Form::close() }}
<br><br>

      <form action="{{action('PostsController@index')}}">
      <button class="btn">記事一覧へ戻る</button>
      </form>
</div>
@endsection