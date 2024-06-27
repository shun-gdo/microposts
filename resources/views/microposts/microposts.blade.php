<div class="mt-4">
    @if (isset($microposts))
        <ul class="list-none">
            @foreach ($microposts as $micropost)
                <li class="flex items-start gap-x-2 mb-4">
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    <div class="avatar">
                        <div class="w-12 rounded">
                            <img src="{{ Gravatar::get($user->email) }}" alt="" />
                        </div>
                    </div>
                    <div>
                        <div>
                            {{-- 投稿の所有者のユーザー詳細ページへのリンク --}}
                            <a class="link link-hover text-info" href="{{ route('users.show', $user->id) }}">{{ $micropost->name }}</a>
                            <span class="text-muted text-gray-500">posted at {{ $micropost->created_at }}</span>
                        </div>
                        <div>
                            {{-- 投稿内容 --}}
                            <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                        </div>
                        
                        <div>
                            @if (!$user->is_favorited($micropost->id))
                                {{-- 投稿お気に入りボタン --}}
                                <p>{{ $micropost->id }}</p>
                                <form method="POST" action="{{ route('favorites.store', $micropost->id) }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-success btn-sm normal-case">Favorite</button>
                                </form>
                            @else
                                {{-- 投稿お気に入りボタン --}}
                                <form method="POST" action="{{ route('favorites.destroy', $micropost->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-Error btn-sm normal-case" 
                                        onclick="return confirm('Unfavorite id = {{ $micropost->id }} ?')">Unfavorite</button>
                                </form>
                            @endif
                        </div>
                        
                        <div>
                            @if (Auth::id() == $micropost->user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm normal-case" 
                                        onclick="return confirm('Delete id = {{ $micropost->id }} ?')">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>

                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $microposts->links() }}
    @endif
</div>