@extends('layouts/app')

@section('content')

<div class="container">


    <div class="card">
      <h5 class="card-header">
        ホーム
      </h5>
      <div class="card-body">
        <form action="posts" method="POST" class="">
          @csrf
           {{-- エラー表示 --}}
          @error('body')
            <p class="alert alert-danger">{{$message}}</p>
          @enderror
        <input class="form-control mb-3" type="text" name="body" placeholder="いまどうしてる？">
        <div class="d-flex justify-content-end">
          <input type="submit" value="つぶやく" class="btn btn-secondary">
        </div>
        </form>
      </div>{{-- card-header --}}
    </div>{{-- card --}}
<br>
    <ol class="list-group">
    @foreach ($posts as $post)
        <li class="list-group-item d-flex justify-content-between p-4">
           <div class="align-content-between">{{-- left --}}
              <div class="blockquote">
                {{ Auth::user()::where('id', $post->user_id)->first()->name }}
              </div>
              <div class="blockquote m-0">{{$post->body}}</div>
           </div>{{-- left --}}

           <div class="align-content-between">{{-- right --}}
             <div class="blockquote">{{date("Y/m/d H:i",strtotime($post->created_at))}}</div>
             <div class="d-flex justify-content-end">
               <form action="posts/{{ $post->id }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                {{-- Postテーブルのuser_idとログインユーザーのidが同じなら --}}
                @if(( $post->user_id ) === ( auth()->user()->id ))
                <input type="submit" class="btn btn-danger p-1" value='削除' onclick="return confirm('本当に削除しますか？');">
               </form>
              @endif
            </div>
          </div>{{-- right --}}
        </li>
    @endforeach
    </ol>
</div><!-- /.container -->
@endsection