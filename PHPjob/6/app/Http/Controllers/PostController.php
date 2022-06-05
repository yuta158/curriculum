<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     *　ログインしていないといけないページにべた打ち等で行こうとしたときに
     *「login」に飛ばす処理
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 一覧画面表示 posts @GET
    public function index()
    {
        // Postテーブルから全件取得
        $posts = Post::all();
        return view('posts.main', compact('posts'));
    }

    // 　フォームからの入力値をDBに登録 posts/{id} @POST
    public function store(Request $req)
    {
        // バリデーション
        $req->validate([
            'body' => 'required|max:255',
        ]);

        $post = new Post();
        // Postオブジェクトにデータを詰め替え
        $post->fill($req->all());
        // 現在認証しているユーザーを取得
        $user = auth()->user();
        // Postテーブルのuser_idに、ログインしているユーザーのidを格納
        $post->user_id = $user->id;
        // DBに保存
        $post->save();
        return back();
    }

    // destroy posts/{id} @DELETE
    public function destroy($id)
    {
        // 論理削除
        //削除対象レコードを検索
        $post = Post::find($id);
        $post->delete();
        return back();
    }
}
