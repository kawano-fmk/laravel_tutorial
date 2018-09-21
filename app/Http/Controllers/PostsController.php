<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Session;
use App\Comment;
use Illuminate\ Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keywords = $request->get('keywords');
        $fromDate = $request->get('fromDate');
        $toDate = $request->get('toDate');

        $keywords = preg_split("/[\s+]/", str_replace('　', ' ', $keywords));
        $posts = Post::where(function ($query) use($keywords, $fromDate, $toDate) 
        {
            foreach($keywords as $word){
                if($word){
                    $query->where('content', 'like', "%{$word}%");
                }
                }
                if($fromDate){
                    $query->whereDate('created_at','>=' ,$fromDate);
                }
                if($toDate){
                    $query->whereDate('created_at', '<=', $toDate);
                }
            }
        
        )->latest('created_at')->paginate(20);
        return view('posts.index', compact('posts','fromDate', 'toDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        return view('posts.create',compact('post')); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        // $post = Post::create();

        // $post->title = $request->title;
        // $post->content = $request->content;
        // $post->save();
        
        $post = Post::create($request->all());
        $post ->save();
        $request->session()->flash('message','記事の登録が完了しました。');
        return redirect()->route('posts.show',[$post->id]);
        
        #$request->session()->flash('message','記事の登録が完了しました。');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //モデルのインスタンス化をする↓DBを全部取得する
        $comments = Comment::all(); //ビューとコントローラの変数合わせる（comments)
        return view('posts.show', compact('post','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        $request->session()->flash('message','記事の編集が完了しました。');
        return redirect()->route('posts.show',[$post->id]);
    }

    public function comment(Request $request)
    {
        Comment::create($request->all());
        $request->session()->flash('message', 'コメントが完了しました。');
        return redirect()->route('posts.show', [$request->input('post_id')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Comment::where('post_id',$post->id)->delete();
        $post->delete();
        return redirect('posts')->with('message', '削除が完了しました。');
    }

    public function comment_destroy(Request $request,$id)
    {
        $comment = Comment::findOrFail($id);
        $posts = $comment->post_id;
        $comment ->delete();
        $request->session()->flash('message', 'コメントを削除しました。');
        //return redirect()->route('posts.show', [$request->input('post_id')]);
        return redirect()->route('posts.show', ['posts' => $posts]);
    }       
        

}