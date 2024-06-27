<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    use HasFactory;
    
    protected $fillable = ['content'];
    
     /*
      この投稿を所有するユーザー。（ Userモデルとの関係を定義）
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    //この投稿をfavoriteしているユーザー達
    public function favoirte_users(){
        
        echo 'called favorite_users';
        
        return $this->belongsToMany(User::class,'favorite_posts','post_id','user_id')->withTimestamps();
    }
}
