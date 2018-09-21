@extends('layouts.app')

@section('title','記事の新規作成')

@section('content')

@if($errors->has('title'))
<span class="text-danger">{{ $errors->first('title') }}</span>
@endif
<br>
@if($errors->has('content'))
<span class="text-danger">{{ $errors->first('content') }}</span>
@endif

@if(Session::has('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

<div align="center">
<h2>記事を新規作成</h2>
<br>
{{ Form::open(['route'=>'posts.store']) }}
{{ csrf_field() }}　{{-- セキュリティのコード（無いと動かない）--}}
<p>
  タイトル<br>
  {{ Form::text('title',$post->title) }}
</p>
<br>
<p>
  本文<br>
  {{ Form::textarea('content',$post->content) }}
</p>
{{ Form::submit('作成',['class'=>'btn btn-primary btn-sm']) }}
{{ Form::close() }}
<br><br>
      <form action="{{action('PostsController@index')}}">
      <button class="btn">記事一覧へ戻る</button>
      </form>
</div>
@endsection