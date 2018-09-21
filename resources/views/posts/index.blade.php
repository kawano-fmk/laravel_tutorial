@extends('layouts.app')

@section('title','記事一覧')

@section('content')

@if(Session::has('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif


<div align="center">
  {{ Form::open(['route'=> 'posts.index', 'method' => 'get']) }}
      <div class="form-inline">
             {{-- {{ Form::checkbox('dateCheck', 'true', false, ['id'=> 'date_check']) }} --}}
             {{ Form::date('fromDate', $fromDate, ['class' => 'form-control','placeholder' => 'YYYY/MM/DD']) }}
                <span>〜</span>  {{ Form::date('toDate', $toDate, ['class' => 'form-control','placeholder' => 'YYYY/MM/DD']) }}
                　{{ Form::text('keywords', '', ['type' => 'search', 'class' => 'form-control', 'placeholder' => 'タイトル・内容']) }}
                　{{ Form::submit('検索', ['class' => 'btn']) }}
      </div>
  {{ Form::close() }}
  <br>
  <form action="{{action('PostsController@create')}}">
    <button class="btn btn-primary">記事の新規作成</button>
  </form>
  <table style="border:none; width:960px; padding:20px 0">
    <tr bgcolor="#b8d5f1" style="font-size:14px; height:40px">
      <th width="150px">タイトル</th>
      <th width="500px">記事</th>
      <th width="200px">投稿時間</th>
      <th width="55px"></th>
      <th width="55px"></th>
  </tr>

  @foreach($posts as $post)
  <tr style="border-bottom-style:solid;border-width:thin">
    <td>{{ link_to_route('posts.show',$post->title,$post->id) }}</td>
    <td>{{ $post->content }}</td>
    <td>{{ $post->created_at }}</td>
    <td>{{ link_to_route('posts.edit','編 集',[$post->id],['class'=>'btn btn-primary btn-sm']) }}
    </td>
      <td>
        {{ Form::open(['route'=>['posts.destroy',$post->id],'onSubmit'=>'return delPostConfirm();','method'=>'delete']) }}
        {{ Form::submit('削 除',['class'=>'btn btn-danger btn-sm']) }}
        {{ Form::close() }}
      </td>
  </tr>
  @endforeach

<div class="paginate">
{{ $posts->appends(Request::only('keywords','fromDate','toDate'))->links() }} 
</div>

  </table>
      <br><br>
          <form action="{{action('PostsController@index')}}">
            <button class="btn">１ページ目へ戻る</button>
          </form>
</div>
@endsection

