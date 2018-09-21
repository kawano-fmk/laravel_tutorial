@extends('layouts.app')

@section('title','記事詳細')

@section('content')

@if(Session::has('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
<div align="center">
    <h1>{{ $post->title }}</h1>
    <div style="width:600px; padding:50px; border:solid 1px; background-color:white;">
        <div align="left">
            <p>{{ $post->content }}</p>
        </div>
        <hr>
        <p align="right">( {{ $post->created_at }} )</p>
    </div>
        <h3>コメント一覧</h3><br>
        @foreach ($post->comments as $comment ) {{--$post追加してリレーションできるようにした--}}
            <div class="comment" style="border:solid 1px; width:600px; background-color:white; padding:0 50px;">
                <div align="left" style="padding-top:20px">
                    <p>名前：{{ $comment->name }}</p>
                    <p>{{ $comment->comment}}</p>
                </div>
                    <hr style="margin-bottom:20px">
                    <p align="right">( {{ $comment->created_at->format('Y/m/d H:i') }} )</p>
                         <div align="right" style="margin-bottom:20px">
                            {{ Form::open(['route'=>['comment.destroy',$comment->id],'onSubmit'=>'return delPostConfirm();','method'=>'delete']) }}
                            {{ Form::submit('コメントを削除',['class'=>'btn btn-default btn-sm']) }}
                            {{ Form::close() }}
                        </div>
            </div>
    <br>
    @endforeach
    <br>
    {{ Form::open( ['url' => 'comment'] ) }}
        <div class="form-group" style="border:none; width:500px">
            {{Form::label('name')}}
            {{ Form::text('name', '' ,['class' => 'form-control', 'required']) }}
        </div>
            <div class="form-group" style="border:none; width:500px">
                {{Form::label('comment')}}
                {{ Form::textarea('comment', '', ['class' => 'form-control', 'required']) }}
            </div>
                <div class="form-group">
                    {{ Form::submit('投稿する' ,['class' => 'btn btn-primary'])}}
                    <input type="hidden" name="post_id" value="{{$post->id}}">　
                    {{ Form::close() }}         {{--↑画面に表示しないけど　postのidをコメントテーブルに保存--}}
                </div>
            
    <form action="{{action('PostsController@index')}}">
    <button class="btn">一覧へ戻る</button>
    </form>
</div>
<br>
@endsection