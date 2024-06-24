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
        
        //ユーザ詳細ビューを表示
        return view('users.show',[
            'user' => $user,
            ]);
        
    }
}
