<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Micropost;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザーを取得
            $user = \Auth::user();
            // ユーザーの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザーの投稿も取得するように変更しますが、現時点ではこのユーザーの投稿のみ取得します）
            $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }
        
        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }
    
    public function store(Request $request){
        //validation
        $request->validate([
            'content' => 'required | max:255',
        ]);
        
        //リクエストをもとに認証済みユーザの投稿として作成
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);
        
        return back();
    }
    public function destroy(string $id){
        //idの値で投稿を検索、取得
        $micropost = Micropost::findOrFail($id);
        
        //認証済みユーザ自身の投稿であれば削除
        if (\Auth::id() === $micropost->user_id){
            $micropost->delete();
            return back()
                ->with('success','Delete Successful');
        }
        
        return back()
            ->with('Delte Failed');
    }
}