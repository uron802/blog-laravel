@extends('layouts.app-admin')

@section('content')
<nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
        <li class="is-active"><a href="#" aria-current="page">ユーザー一覧</a></li>
    </ul>
</nav>
<section class='box'>
    <table class='table'>
        <tr>
            <th>メールアドレス</th>
            <th>ユーザー名</th>
            <th></th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->email }}</td>
            <td>{{ $user->name }}</td>
            @if ($user->active)
                <td><a href='#' class='button is-success'>有効</a></td>
            @else    
            <form action="{{ route('user.activate', ['user' => $user]) }}" method='post' id="user-form">
                @csrf
                <td><button class='button is-default'>有効化</button></td>
            </form>
            @endif
        </tr>
        @endforeach
    </table>
    {{ $users->links() }}
</section>
@endsection
