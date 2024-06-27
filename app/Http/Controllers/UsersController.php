<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Faacdes\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        
        //ユーザー一覧をid降順で取得
        $users = User::orderBy('id','desc')->paginate(10);
        
        //ユーザー一覧ビューで↑を表示
        return view('users.index',[
            'users' => $users
            ]);
    }
    
    public function show(string $id){
        
        //idでユーザ検索
        $user = User::findOrFail($id);
        
        //関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        //ユーザ投稿一覧を作成日時の降順で取得
        $microposts = $user->microposts()->orderBy('created_at','desc')->paginate(10);
        // dd($microposts);
        
        //ユーザ詳細ビューを表示
        return view('users.show',[
            'user' => $user,
            'microposts' => $microposts
            ]);
        
    }
    
    /**
     * ユーザーのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id){
        //idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        //関係するモデル件数をロード
        $user->loadRelationshipCounts();
        
        //ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);
        
        //フォロー一覧ビューで表示
        return view('users.followings',[
            'user' => $user,
            'users' => $followings,
        ]);
    }
    
    /**
     * ユーザーのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザーのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    
    public function favorites($id){
        
        $user = User::findOrFail($id);
        $user->loadRelationshipCounts();
        
        print_r($user->email);
        
        $microposts = $user->favorites()->paginate(10);
        // dd($microposts);
        
        return view('users.favorites',[
            'user' => $user,
            'microposts' => $microposts,
        ]);
        
    }
}
