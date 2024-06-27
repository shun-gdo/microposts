<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritePostsController extends Controller
{
    //
     public function store(Request $request)
    {
        // dd($request->all());
        // 認証済みユーザー（閲覧者）が、 idのユーザーをフォローする
        \Auth::user()->favorite($request->postId);
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * ユーザーをアンフォローするアクション。
     *
     * @param  $id  相手ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $postId)
    {
        // 認証済みユーザー（閲覧者）が、 idのユーザーをアンフォローする
        \Auth::user()->unfavorite(intval($postId));
        // 前のURLへリダイレクトさせる
        return back();
    }
}
