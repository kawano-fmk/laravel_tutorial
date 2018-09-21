<?php

use Illuminate\Database\Seeder;
use App\Post;
Use App\Comment;

class UserCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = 'この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。';

        $commentdammy = 'コメントダミーです。ダミーコメントだよ。';
    
        for( $i = 1 ; $i <= 10 ; $i++) {
            $post = new Post;
            $post->title = "$i 番目の投稿";
            $post->content = $content;
            $post->save();
    
            $maxComments = mt_rand(3, 15);
            for ($j=0; $j <= $maxComments; $j++) {
            $comment = new Comment;
            $comment->commenter = '名無しさん';
            $comment->comment = $commentdammy;
    
            //モデル(Post.php)のCommentsメソッドを読み込み、post_idにデータを保存する
            $post->comments()->save($comment);
            $post->increment('comment_count');
            }
        }
       
    }   
}
